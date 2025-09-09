<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class MY_Model
 * @property CI_DB_query_builder $db
 * @property CI_DB_driver $db
 * @property CI_DB_forge $dbforge
 * @property CI_DB_utility $dbutil
 * @property CI_Session $session
 */
class MY_Model extends CI_Model
{
    protected $table = '';
    protected $searchable_columns = [];
    protected $detail_table = '';
    protected $foreign_key = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    protected function _build_search_query($search_term)
    {
        if (!empty($search_term) && !empty($this->searchable_columns)) {
            $search_term = strtolower($search_term);
            $this->db->group_start();
            foreach ($this->searchable_columns as $column) {
                $this->db->or_like("LOWER({$column})", $search_term, 'both');
            }
            $this->db->group_end();
        }
    }

    private function _add_is_deleted_filter()
    {
        if ($this->db->field_exists('is_deleted', $this->table)) {
            $this->db->where($this->table . '.is_deleted', 0);
        }
    }

    public function get_all($limit = 10, $offset = 0)
    {
        if (empty($this->table)) {
            return [];
        }
        $this->_add_is_deleted_filter();
        return $this->db->order_by('id', 'desc')->get($this->table, $limit, $offset)->result();
    }

    public function get_filtered($limit = 10, $offset = 0, $search_term = '')
    {
        if (empty($this->table)) {
            return [];
        }
        $this->_add_is_deleted_filter();
        $this->_build_search_query($search_term);
        return $this->db->order_by('id', 'desc')->get($this->table, $limit, $offset)->result();
    }

    public function count_all()
    {
        if (empty($this->table)) {
            return 0;
        }
        $this->_add_is_deleted_filter();
        return $this->db->count_all_results($this->table);
    }

    public function count_filtered($search_term = '')
    {
        if (empty($this->table)) {
            return 0;
        }
        $this->_add_is_deleted_filter();
        $this->_build_search_query($search_term);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get($id)
    {
        if (empty($this->table) || !is_numeric($id)) {
            return null;
        }
        $this->_add_is_deleted_filter();
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data)
    {
        if (empty($this->table) || empty($data)) {
            return false;
        }
        if ($this->session->userdata('user_id')) {
            $data['created_by'] = $this->session->userdata('user_id');
        }
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        if (empty($this->table) || !is_numeric($id) || empty($data)) {
            return false;
        }
        if ($this->session->userdata('user_id')) {
            $data['updated_by'] = $this->session->userdata('user_id');
            $data['updated_at'] = date('Y-m-d H:i:s');
        }
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        if (empty($this->table) || !is_numeric($id)) {
            return false;
        }
        if ($this->db->field_exists('is_deleted', $this->table)) {
            $data = ['is_deleted' => 1];
            if ($this->session->userdata('user_id')) {
                $data['deleted_by'] = $this->session->userdata('user_id');
                $data['deleted_at'] = date('Y-m-d H:i:s');
            }
            return $this->db->where('id', $id)->update($this->table, $data);
        } else {
            return $this->db->delete($this->table, ['id' => $id]);
        }
    }

    public function insert_with_details($header_data, $details_data)
    {
        if (empty($this->table) || empty($this->detail_table)) {
            return false;
        }

        $this->db->trans_begin();

        // 1. Insert data header
        $this->insert($header_data);
        // Pastikan Anda memanggil insert_id() pada objek database
        /** @var CI_DB_driver $db */
        $id = @$this->db->insert_id(); // <--- Ini yang benar

        // 2. Insert data detail
        if ($id && !empty($details_data)) {
            foreach ($details_data as &$row) {
                $row[$this->foreign_key] = $id;
                $row['created_by'] = $this->session->userdata('user_id');
            }
            $this->db->insert_batch($this->detail_table, $details_data);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function update_with_details($id, $header_data, $details_data)
    {
        if (empty($this->table) || empty($this->detail_table) || !is_numeric($id)) {
            return false;
        }
        $this->db->trans_begin();
        $this->update($id, $header_data);
        $this->db->where($this->foreign_key, $id)->update($this->detail_table, ['is_deleted' => 1]);
        if (!empty($details_data)) {
            foreach ($details_data as &$row) {
                $row[$this->foreign_key] = $id;
                $row['updated_by'] = $this->session->userdata('user_id');
                $row['updated_at'] = date('Y-m-d H:i:s');
            }
            $this->db->insert_batch($this->detail_table, $details_data);
        }
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }

    public function get_details($foreign_id)
    {
        if (empty($this->detail_table) || empty($this->foreign_key) || !is_numeric($foreign_id)) {
            return [];
        }
        $this->db->where($this->foreign_key, $foreign_id);
        if ($this->db->field_exists('is_deleted', $this->detail_table)) {
            $this->db->where('is_deleted', 0);
        }
        return $this->db->get($this->detail_table)->result();
    }
}

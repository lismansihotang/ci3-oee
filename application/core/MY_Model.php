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
    protected $group_by = null;
    protected $order_by = null;
    protected $group_mode = 'MIN';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function set_group_mode($mode = 'MIN')
    {
        $this->group_mode = strtoupper($mode) === 'MAX' ? 'MAX' : 'MIN';
        return $this;
    }

    public function set_group_by($group_by)
    {
        $this->group_by = $group_by;
        return $this;
    }

    public function set_order_by($field, $direction = 'DESC')
    {
        $this->order_by = [$field, strtoupper($direction)];
        return $this;
    }

    private function _apply_query($search_term = '')
    {
        // filter soft delete
        if ($this->db->field_exists('is_deleted', $this->table)) {
            $this->db->where($this->table . '.is_deleted', 0);
        }

        // select + group
        if ($this->group_by) {
            $fields = $this->db->list_fields($this->table);
            $selects = [];

            foreach ($fields as $field) {
                if ($field === 'id') {
                    $selects[] = "{$this->group_mode}({$this->table}.id) as id";
                } else {
                    $selects[] = "{$this->group_mode}({$this->table}.{$field}) as {$field}";
                }
            }

            $this->db->select(implode(", ", $selects), false);

            $group = is_array($this->group_by) ? $this->group_by : [$this->group_by];
            foreach ($group as $g) {
                $this->db->group_by($g);
            }

            // order
            if ($this->order_by) {
                $this->db->order_by($this->order_by[0], $this->order_by[1], false);
            } else {
                $this->db->order_by('id', 'DESC', false); // alias id
            }
        } else {
            $this->db->select($this->table . '.*');
            if ($this->order_by) {
                $this->db->order_by($this->order_by[0], $this->order_by[1], false);
            } else {
                $this->db->order_by($this->table . '.id', 'DESC');
            }
        }

        // search
        if ($search_term && $this->searchable_columns) {
            $search_term = strtolower($search_term);
            $this->db->group_start();
            foreach ($this->searchable_columns as $col) {
                $this->db->or_like("LOWER($col)", $search_term, 'both', false);
            }
            $this->db->group_end();
        }
    }

    public function get_all($limit = 10, $offset = 0)
    {
        $this->_apply_query();
        return $this->db->get($this->table, $limit, $offset)->result();
    }

    public function get_filtered($limit = 10, $offset = 0, $search_term = '')
    {
        $this->_apply_query($search_term);
        return $this->db->get($this->table, $limit, $offset)->result();
    }

    public function count_all()
    {
        $this->_apply_query();
        return $this->db->count_all_results($this->table);
    }

    public function count_filtered($search_term = '')
    {
        $this->_apply_query($search_term);
        return $this->db->count_all_results($this->table);
    }

    private function _add_is_deleted_filter()
    {
        if ($this->db->field_exists('is_deleted', $this->table)) {
            $this->db->where($this->table . '.is_deleted', 0);
        }
    }

    public function get($id)
    {
        if (empty($this->table) || !is_numeric($id)) {
            return null;
        }
        $this->_add_is_deleted_filter();
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_data($where = [], $where_in = [], $field_where_in = '', $single = false)
    {
        if (empty($this->table)) {
            return null;
        }

        // filter soft delete
        if ($this->db->field_exists('is_deleted', $this->table)) {
            $this->db->where($this->table . '.is_deleted', 0);
        }

        // where biasa
        if (!empty($where)) {
            $this->db->where($where);
        }

        // where_in
        if (!empty($where_in) && !empty($field_where_in)) {
            $this->db->where_in($field_where_in, $where_in);
        }

        $query = $this->db->get($this->table);

        return $single ? $query->row() : $query->result();
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

    public function delete_all($where = [])
    {
        if (empty($this->table) || empty($where)) {
            return false;
        }

        foreach ($where as $field => $val) {
            if (is_array($val)) {
                $this->db->where_in($field, $val); // support WHERE IN
            } else {
                $this->db->where($field, $val);   // WHERE biasa
            }
        }

        if ($this->db->field_exists('is_deleted', $this->table)) {
            // Soft delete
            $data = ['is_deleted' => 1];
            if ($this->session->userdata('user_id')) {
                $data['deleted_by'] = $this->session->userdata('user_id');
                $data['deleted_at'] = date('Y-m-d H:i:s');
            }
            return $this->db->update($this->table, $data);
        } else {
            // Hard delete
            return $this->db->delete($this->table);
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

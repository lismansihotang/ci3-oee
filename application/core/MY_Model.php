<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    // Nama tabel akan didefinisikan di model turunan
    protected $table = '';

    /**
     * Mengambil semua data dari tabel dengan limit dan offset.
     *
     * @param int $limit  Jumlah data yang akan diambil.
     * @param int $offset Data yang akan dilewati.
     * @return array
     */
    public function get_all($limit = 10, $offset = 0)
    {
        // Pastikan nama tabel tidak kosong
        if (empty($this->table)) {
            return [];
        }

        return $this->db->order_by('id', 'asc')->get($this->table, $limit, $offset)->result();
    }

    /**
     * Menghitung total data di tabel.
     *
     * @return int
     */
    public function count_all()
    {
        if (empty($this->table)) {
            return 0;
        }

        return $this->db->count_all($this->table);
    }

    /**
     * Mengambil satu baris data berdasarkan ID.
     *
     * @param int $id ID data yang akan diambil.
     * @return object|null
     */
    public function get($id)
    {
        if (empty($this->table) || !is_numeric($id)) {
            return null;
        }

        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    /**
     * Menyimpan data baru ke tabel.
     *
     * @param array $data Data yang akan disimpan.
     * @return bool
     */
    public function insert($data)
    {
        if (empty($this->table) || empty($data)) {
            return false;
        }

        // Tambahkan data log jika session tersedia
        if (isset($CI->session) && $CI->session->userdata('user_id')) {
            $data['created_by'] = $CI->session->userdata('user_id');
        }

        return $this->db->insert($this->table, $data);
    }

    /**
     * Memperbarui data berdasarkan ID.
     *
     * @param int $id ID data yang akan diperbarui.
     * @param array $data Data baru.
     * @return bool
     */
    public function update($id, $data)
    {
        if (empty($this->table) || !is_numeric($id) || empty($data)) {
            return false;
        }

        // Ambil CI instance untuk mengakses session
        $CI = &get_instance();

        // Tambahkan data log jika session tersedia
        if (isset($CI->session) && $CI->session->userdata('user_id')) {
            $data['updated_by'] = $CI->session->userdata('user_id');
            $data['updated_at'] = date('Y-m-d H:i:s');
        }

        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Menghapus data secara "soft delete" dengan mengubah status.
     *
     * @param int $id ID data yang akan dihapus.
     * @return bool
     */
    public function delete($id)
    {
        if (empty($this->table) || !is_numeric($id)) {
            return false;
        }

        $data = ['is_deleted' => 1];

        // Ambil CI instance untuk mengakses session
        $CI = &get_instance();

        // set status delete
        $data['is_deleted'] = 1;

        // Tambahkan data log jika session tersedia
        if (isset($CI->session) && $CI->session->userdata('user_id')) {
            $data['deleted_by'] = $CI->session->userdata('user_id');
            $data['deleted_at'] = date('Y-m-d H:i:s');
        }

        return $this->db->where('id', $id)->update($this->table, $data);
    }
}

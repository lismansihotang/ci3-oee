<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Jenis_downtimes_model $model
 */
class Jenis_downtimes extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_downtimes_model', 'model');
        $this->controller_name = 'jenis_downtimes';
    }

    public function index($view = '')
    {
        $this->setTitle('Jenis Downtimes');

        parent::index('jenis_downtimes/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Jenis Downtimes');
        parent::form(null, 'jenis_downtimes/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Jenis Downtimes');
        parent::form($id, 'jenis_downtimes/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Jenis Downtimes');
        parent::view($id, 'jenis_downtimes/view', $data = []);
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Materials_model $model
 */
class Materials extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Materials_model', 'model');
        $this->controller_name = 'materials';
    }

    public function index($view = '')
    {
        $this->setTitle('Materials');

        parent::index('materials/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Materials');
        parent::form(null, 'materials/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Materials');
        parent::form($id, 'materials/form');
    }

    public function view($id, $view = '', $data = [])
    {
        $this->setTitle('Detail Materials');
        parent::view($id, 'materials/view', $data = []);
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

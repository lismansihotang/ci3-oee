<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Spk_model $model
 */
class Spk extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Spk_model','model');
        $this->controller_name = 'spk';
    }

    public function index($view = '')
    {
        $this->setTitle('Spk');
        
        parent::index('spk/index');
    }

    public function create($id = null, $view = '')
    {
        $this->setTitle('Tambah Data Spk');
        parent::form(null, 'spk/form');
    }

    public function edit($id, $view = '')
    {
        $this->setTitle('Ubah Data Spk');
        parent::form($id, 'spk/form');
    }

    public function view($id, $view = '')
    {
        $this->setTitle('Detail Spk');
        parent::view($id, 'spk/view');
    }

    public function delete($id)
    {
        parent::delete($id);
    }
}

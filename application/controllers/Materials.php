<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Materials_model $model
 */
class Materials extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Materials_model','model');
        $this->load->helper(['table', 'pagination', 'card', 'bs_floating']);
    }

    public function index($page = 0)
    {
        $limit = 10;
        $total = $this->model->count_all();
        $rows  = $this->model->get_all($limit, $page);
        $data['rows'] = $rows;
        $data['pagination'] = build_pagination(site_url('materials/index'), $total, $limit, 3);
        $this->render('materials/index', $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            $this->model->insert($this->input->post());
            redirect('materials');
        }
        $this->render('materials/form');
    }

    public function edit($id)
    {
        if ($this->input->post()) {
            $this->model->update($id, $this->input->post());
            redirect('materials');
        }
        $data['row'] = $this->model->get($id);
        $this->render('materials/form', $data);
    }

    public function view($id)
    {
        $data['row'] = $this->model->get($id);
        $this->render('materials/view', $data);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        redirect('materials');
    }
}

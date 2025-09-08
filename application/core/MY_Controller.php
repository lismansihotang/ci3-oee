<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class MY_Controller
 * @property MY_Model $model
 */
class MY_Controller extends CI_Controller
{
    protected $layout = 'layouts/main';
    protected $data = [];
    public $model = null;
    protected $controller_name = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper([
            'url',
            'form',
            'assets',
            'breadcrumb',
            'menu',
            'search_and_pagination',
            'index_header',
            'table',
            'card',
            'bs_floating',
            'table_form_detail_generic'
        ]);
        $this->load->library(['session']);

        $this->data['title'] = 'Dashboard';
        $this->data['menu'] = [
            [
                'label' => 'Dashboard',
                'url' => 'dashboard',
                'type' => 'link'
            ],
            [
                'label' => 'Purchase Orders',
                'url' => 'purchase_orders',
                'type' => 'link'
            ],
            [
                'label' => 'Components',
                'type' => 'nav-title'
            ],
            [
                'label' => 'Materials',
                'url' => 'materials',
                'type' => 'link'
            ],
            [
                'label' => 'Machines',
                'url' => 'machines',
                'type' => 'link'
            ],
            [
                'label' => 'Customers',
                'url' => 'customers',
                'type' => 'link'
            ],
            [
                'label' => 'Jenis Downtimes',
                'url' => 'jenis_downtimes',
                'type' => 'link'
            ],
            [
                'label' => 'Products',
                'url' => 'products',
                'type' => 'link'
            ],
        ];

        if (!$this->session->userdata('logged_in') && $this->router->fetch_class() != 'auth') {
            redirect('auth/login');
        }
    }

    protected function render($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        $data['content'] = $this->load->view($view, $data, true);
        $this->load->view($this->layout, $data);
    }

    protected function setTitle($title)
    {
        $this->data['title'] = $title;
    }

    public function index($view = '')
    {
        $search_term = $this->input->get('q', true) ?? '';
        $total_rows = $this->model->count_filtered($search_term);

        $config = prepare_search_and_pagination($this, site_url($this->controller_name), $total_rows, 10);

        $data['rows'] = $this->model->get_filtered($config['per_page'], $config['offset'], $search_term);
        $data['pagination'] = $config['pagination'];
        $this->data['search_term'] = $search_term;
        $this->data['offset'] = $config['offset'];
        $this->data['total_rows'] = $total_rows;
        $this->data['from_rows'] = ($total_rows > 0) ? $config['offset'] + 1 : 0;
        $this->data['to_rows'] = $config['offset'] + count($data['rows']);

        $this->render($view, $data);
    }

    public function form($id = null, $view = '')
    {
        if ($this->input->post()) {
            if ($id) {
                $this->model->update($id, $this->input->post());
            } else {
                $this->model->insert($this->input->post());
            }
            redirect($this->controller_name);
        }

        $data = [];
        if ($id) {
            $data['row'] = $this->model->get($id);
            if (!$data['row']) {
                show_404();
            }
        }
        $this->render($view, $data);
    }

    public function form_with_details($id = null, $view = '', $extra_data = [])
    {
        if ($this->input->post()) {
            $post_data = $this->input->post();

            $header_data = [];
            $details_data_raw = [];

            foreach ($post_data as $key => $value) {
                // Check if the value is an array, this is the most reliable check for detail data.
                if (is_array($value)) {
                    $details_data_raw[$key] = $value;
                } else {
                    $header_data[$key] = $value;
                }
            }

            $details_data = $this->_extract_details($details_data_raw);
            unset($header_data['submit']);

            if ($id) {
                $result = $this->model->update_with_details($id, $header_data, $details_data);
            } else {
                $result = $this->model->insert_with_details($header_data, $details_data);
            }

            if ($result) {
                redirect($this->controller_name);
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data.');
                redirect(current_url());
            }
        }

        $data = [];
        if ($id) {
            $data['row'] = $this->model->get($id);
            if (!$data['row']) {
                show_404();
            }
            $data['details'] = $this->model->get_details($id);
        }

        $data = array_merge($data, $extra_data);
        $this->render($view, $data);
    }

    protected function _extract_details($details_data_raw)
    {
        $details = [];

        // Temukan nama kolom detail secara dinamis
        $detail_columns = [];
        if (is_array($details_data_raw) && !empty($details_data_raw)) {
            $detail_columns = array_keys($details_data_raw);
        }

        // Jika tidak ada kolom detail, kembalikan array kosong
        if (empty($detail_columns) || !isset($details_data_raw[$detail_columns[0]])) {
            return $details;
        }

        // Dapatkan hitungan baris
        $count = count($details_data_raw[$detail_columns[0]]);

        for ($i = 0; $i < $count; $i++) {
            $row_data = [];
            $is_empty_row = true;
            foreach ($detail_columns as $column) {
                $value = isset($details_data_raw[$column][$i]) ? $details_data_raw[$column][$i] : null;
                $row_data[$column] = $value;
                if (!empty($value)) {
                    $is_empty_row = false;
                }
            }
            if (!$is_empty_row) {
                $details[] = $row_data;
            }
        }
        return $details;
    }

    public function view($id, $view = '')
    {
        $data['row'] = $this->model->get($id);
        if (!$data['row']) {
            show_404();
        }
        $data['details'] = $this->model->get_details($id);
        $this->render($view, $data);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        redirect($this->controller_name);
    }
}

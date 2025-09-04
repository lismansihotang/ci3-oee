<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Form_validation $form_validation
 * @property CI_DB_forge $dbforge
 * @property CI_DB_utility $dbutil
 */
class GeneratorTool extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
        $this->load->dbutil();
        $this->load->helper(['form', 'url', 'file', 'inflector']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $tables = $this->db->list_tables();
        $this->load->view('generator/form', ['tables' => $tables]);
    }

    public function create()
    {
        $this->form_validation->set_rules('table', 'Table Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->index();
            return;
        }

        $table = $this->input->post('table');
        $module = ucfirst($table);

        $fields = $this->db->field_data($table);
        $viewPath = APPPATH . "views/{$table}/";

        if (!is_dir($viewPath)) {
            mkdir($viewPath, 0755, true);
        }

        // Fungsi bantu untuk tulis file dengan replace
        $writeReplace = function ($filePath, $content) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            write_file($filePath, $content);
        };

        // ==== MODEL ====
        $modelCode = $this->generate_model($module, $table);
        $writeReplace(APPPATH . "models/{$module}_model.php", $modelCode);

        // ==== CONTROLLER ====
        $controllerCode = $this->generate_controller($module, $table);
        $writeReplace(APPPATH . "controllers/{$module}.php", $controllerCode);

        // ==== VIEWS ====
        $this->generate_views($fields, $table, $module, $viewPath, $writeReplace);

        echo "<h3>Generate berhasil untuk tabel <b>{$table}</b></h3>";
        echo "<a href='" . site_url(strtolower($module)) . "' target='_blank'>Lihat hasil di controller {$module}</a>";
    }

    /**
     * Generate Model
     */
    private function generate_model($module, $table)
    {
        return "<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class {$module}_model extends MY_Model
{
    protected \$table = '{$table}';
}
";
    }

    /**
     * Generate Controller
     */
    private function generate_controller($module, $table)
    {
        return "<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property {$module}_model \$model
 */
class {$module} extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        \$this->load->model('{$module}_model','model');
        \$this->load->helper(['table', 'pagination', 'card', 'bs_floating']);
    }

    public function index(\$page = 0)
    {
        \$limit = 10;
        \$total = \$this->model->count_all();
        \$rows  = \$this->model->get_all(\$limit, \$page);
        \$data['rows'] = \$rows;
        \$data['pagination'] = build_pagination(site_url('{$table}/index'), \$total, \$limit, 3);
        \$this->render('{$table}/index', \$data);
    }

    public function create()
    {
        if (\$this->input->post()) {
            \$this->model->insert(\$this->input->post());
            redirect('{$table}');
        }
        \$this->render('{$table}/form');
    }

    public function edit(\$id)
    {
        if (\$this->input->post()) {
            \$this->model->update(\$id, \$this->input->post());
            redirect('{$table}');
        }
        \$data['row'] = \$this->model->get(\$id);
        \$this->render('{$table}/form', \$data);
    }

    public function view(\$id)
    {
        \$data['row'] = \$this->model->get(\$id);
        \$this->render('{$table}/view', \$data);
    }

    public function delete(\$id)
    {
        \$this->model->delete(\$id);
        redirect('{$table}');
    }
}
";
    }

    /**
     * Generate Views (index, form, view)
     */
    private function generate_views($fields, $table, $module, $viewPath, $writeReplace)
    {
        // INDEX
        $headers = [];
        foreach ($fields as $f) {
            $headers[] = ucfirst($f->name);
        }

        $indexView = "<?= card_open('<i class=\"icon cil-list\"></i> List of {$module}') ?>
    <div class=\"mb-3\">
        <div class=\"btn-group\" role=\"group\" aria-label=\"HomeAdd\">
            <a href=\"<?= site_url('{$table}/create') ?>\" class=\"btn btn-primary btn-sm\" data-coreui-placement=\"top\" title=\"Tambah Data Baru\"><i class=\"icon cil-plus\"></i> Tambah Data</a>
            <a href=\"<?= site_url('/') ?>\" class=\"btn btn-outline-primary btn-sm\" data-coreui-toggle=\"tooltip\" data-coreui-placement=\"top\" title=\"< Kembali ke Halaman Utama\"><i class=\"icon cil-home\"></i></a>
        </div>
    </div>
    <?= build_table([
        'headers' => " . var_export($headers, true) . ",
        'rows' => \$rows,
        'actions' => [
            'view' => '{$table}/view',
            'edit' => '{$table}/edit',
            'delete' => '{$table}/delete'
        ]
    ]) ?>
    <?= \$pagination ?>
<?= card_close() ?>";

        $writeReplace($viewPath . "index.php", $indexView);

        // FORM (CREATE / EDIT)
        $formFields = "";
        foreach ($fields as $f) {
            $isPK = property_exists($f, 'primary_key') && $f->primary_key == 1;
            if ($isPK) continue;

            $formFields .= "<?= bs_floating_input('{$f->name}', 'text', (isset(\$row) ? \$row->{$f->name} : '')); ?>";
        }

        $formView = "<?= card_open(isset(\$row) ? '<i class=\"icon cil-window\"></i> Edit {$module}' : '<i class=\"icon cil-window\"></i> Tambah {$module}') ?>
    <form method=\"post\">
        $formFields
        <div class=\"mt-3\">
            <div class=\"btn-group\" role=\"group\" aria-label=\"FormCreateUpdate\">
                <button type=\"submit\" class=\"btn btn-success\" data-coreui-toggle=\"tooltip\" data-coreui-placement=\"top\" title=\"Simpan Data Sekarang\"><i class=\"icon cil-save\"></i> Simpan</button>
                <a href=\"<?= site_url('{$table}') ?>\" class=\"btn btn-secondary\" data-coreui-toggle=\"tooltip\" data-coreui-placement=\"top\" title=\"< Kembali ke List Data\"><i class=\"icon cil-reload\"></i> Kembali</a>
                <a href=\"<?= site_url('/') ?>\" class=\"btn btn-outline-dark\" data-coreui-toggle=\"tooltip\" data-coreui-placement=\"top\" title=\"< Kembali ke Halaman Utama\"><i class=\"icon cil-home\"></i></a>
            </div>
        </div>
    </form>
<?= card_close() ?>";

        $writeReplace($viewPath . "form.php", $formView);

        // VIEW DETAIL
        $detailFields = "";
        foreach ($fields as $f) {
            $detailFields .= "
    <tr>
        <th>{$f->name}</th>
        <td><?= \$row->{$f->name} ?></td>
    </tr>";
        }

        $viewDetail = "<?= card_open('<i class=\"icon cil-spreadsheet\"></i> Detail {$module}') ?>
    <table class=\"table table-bordered\">
        $detailFields
    </table>
    <div class=\"mt-3\">
        <div class=\"btn-group\" role=\"group\" aria-label=\"FormCreateUpdate\">
            <a href=\"<?= site_url('{$table}/edit/'.\$row->id) ?>\" class=\"btn btn-warning\" data-coreui-toggle=\"tooltip\" data-coreui-placement\"top\" title=\"Edit Data Ini\"><i class=\"icon cil-pencil\"></i> Edit</a>
            <a href=\"<?= site_url('{$table}/delete/'.\$row->id) ?>\" class=\"btn btn-danger\" onclick=\"return confirm('Hapus data ini?')\" data-coreui-toggle=\"tooltip\" data-coreui-placement=\"top\" title=\"Hapus Data Ini\"><i class=\"icon cil-trash\"></i> Delete</a>
            <a href=\"<?= site_url('{$table}') ?>\" class=\"btn btn-secondary\" data-coreui-toggle=\"tooltip\" data-coreui-placement=\"top\" title=\"< Kembali ke List Data\"><i class=\"icon cil-reload\"></i> Kembali</a>
            <a href=\"<?= site_url('/') ?>\" class=\"btn btn-outline-dark\" data-coreui-toggle=\"tooltip\" data-coreui-placement=\"top\" title=\"< Kembali ke Halaman Utama\"><i class=\"icon cil-home\"></i> </a>
        </div>
    </div>
<?= card_close() ?>";

        $writeReplace($viewPath . "view.php", $viewDetail);
    }
}

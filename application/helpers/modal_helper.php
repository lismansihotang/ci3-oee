<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('modal_template')) {
    /**
     * Generate template modal (hidden) untuk cloning di JS
     *
     * @param string $id        ID modal template
     * @param string $title     Judul modal
     * @param string $body      Konten modal (HTML string)
     * @param string $footer    Tombol footer (HTML string)
     * @param string $formClass Class form dalam modal
     * @return string
     */
    function modal_template($id, $title = 'Modal Title', $body = '', $footer = '', $formClass = 'generic-form')
    {
        return '
        <div id="' . $id . '" class="modal fade d-none" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form class="' . $formClass . '">
                        <div class="modal-header">
                            <h5 class="modal-title">' . $title . '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            ' . $body . '
                        </div>
                        <div class="modal-footer">
                            ' . $footer . '
                        </div>
                    </form>
                </div>
            </div>
        </div>';
    }
}

<?php

/**
 * Created by SD.
 * Date: 25/06/2017
 */
class Log extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');
            $this->lang->load('admin/setting/log_lang');
        } else {
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }

    public function index()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array('text' => 'home', 'href' => 'index.php/admin/common/dashboard');

        $data['breadcrumbs'][] = array('text' => $this->lang->line('heading_title'), 'href' => 'index.php/admin/setting/log');
        $data['log'] = "";

        $file = $this->config->item('log_path').$this->config->item('log_name');

        if (file_exists($file)) {
            $size = filesize($file);

            if ($size >= 5242880) {
                $suffix = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

                $i = 0;

                while (($size / 1024) > 1) {
                    $size = $size / 1024;
                    $i++;
                }

                $data['error_warning'] = sprintf($this->lang->line('error_warning'), basename($file), round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i]);
            } else {
                $data['log'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, NULL);
            }
        }

        $data['clear'] = "index.php/admin/setting/log/clear";
        $data['download'] = "index.php/admin/setting/log/download";

        $data['heading_title'] = $this->lang->line('heading_title');
        $data['text_confirm'] = $this->lang->line('text_confirm');
        $data['text_list'] = $this->lang->line('text_list');
        $data['button_clear'] = $this->lang->line('button_clear');
        $data['button_download'] = $this->lang->line('button_download');

        if ($this->input->get('clear') == 'success') {
            $data['success'] = $this->lang->line('text_success');
        } else if ($this->input->get('clear') == 'fail') {
            $data['error_warning'] = $this->lang->line('error_permission');
        }

        if ($this->input->get('download') == 'fail') {
            $data['error_warning'] = sprintf($this->lang->line('error_warning'), basename($file), '0KB');
        }

        $this->load->view('admin/setting/log', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function clear()
    {
        if (!$this->_checkAuthentication()) {
            redirect('admin/setting/log?clear=fail');
        } else {
            $file = $this->config->item('log_path').$this->config->item('log_name');
            if (file_exists($file)) {
                $handle = fopen($file, 'w+');
                fclose($handle);
                redirect('admin/setting/log?clear=success');
            }
        }
    }

    public function download() {

        $file = $this->config->item('log_path').$this->config->item('log_name');

        if (file_exists($file) && filesize($file) > 0) {
            $this->output->set_header('Pragma: public');
            $this->output->set_header('Expires: 0');
            $this->output->set_header('Content-Description: File Transfer');
            $this->output->set_header('Content-Type: application/octet-stream');
            date_default_timezone_set("Asia/Shanghai");
            $this->output->set_header('Content-Disposition: attachment; filename="' . date('Y-m-d', time()). '_' . $this->config->item('log_name'));
            $this->output->set_header('Content-Transfer-Encoding: binary');

            $this->output->set_output(file_get_contents($file, FILE_USE_INCLUDE_PATH, null));
        } else {
            redirect('admin/setting/log?download=fail');
        }
    }

    private function _checkAuthentication()
    {
        if ($this->session->usergroup == 1) {
            return true;
        }

        return false;
    }
}
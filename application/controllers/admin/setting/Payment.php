<?php
/**
 * Created by SD.
 * Date: 27/06/2017
 */

class Payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');
            $this->load->model('admin/setting/model_payment');
            $this->lang->load('admin/setting/payment_lang');
        } else {
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }

    public function index() {

        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'));

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data = $this->_getList();

        $this->load->view('admin/setting/payment', $data);
        // set footer
        $this->model_footer->loadFooter();
        
    }

    private function _getList() {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'admin/common/dashboard'
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'admin/setting/payment'
        );

        $data['heading_title'] = $this->lang->line('heading_title');

        $data['text_list'] = $this->lang->line('text_list');
        $data['text_no_results'] = $this->lang->line('text_no_results');
        $data['text_confirm'] = $this->lang->line('text_confirm');

        $data['column_name'] = $this->lang->line('column_name');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_sort_order'] = $this->lang->line('column_sort_order');
        $data['column_action'] = $this->lang->line('column_action');

        $data['button_edit'] = $this->lang->line('button_edit');
        $data['button_install'] = $this->lang->line('button_install');
        $data['button_uninstall'] = $this->lang->line('button_uninstall');
// TODO: error reporting structure
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
// TODO: error reporting structure
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        // check payments that are already installed
        $extensions = $this->model_payment->getInstalled('payment');

        // uninstall any payment that doesn't have a corresponding controller
        // this is used to prevent from loading a payment from db, but the actual payment method doesn't exist
        foreach ($extensions as $key => $value) {
            if (!file_exists($this->config->item('admin_path') . 'payment/' . $value . '.php')) {
                $this->model_payment->uninstall('payment', $value);

                unset($extensions[$key]);
            }
        }

        $data['extensions'] = array();

        // grab all the payment methods inside the payment folder
        $files = glob($this->config->item('admin_path') . 'payment/*.php');

        $this->load->model('admin/setting/model_setting');

        // load payment language files & organize payment setting
        if ($files) {
            foreach ($files as $file) {
                $extension = strtolower(basename($file, '.php'));

                $this->lang->load('admin/payment/' . $extension . '_lang');
                
                $status = $this->model_setting->get($extension . '_status');

                // $this->load->model('admin/payment/model_' . $extension);

                $data['extensions'][] = array(
                    'name'      => $this->lang->line('text_title'),
                    'image'     => 'image/payment/' . $extension . '.png',
                    'status'    => $status ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                    'install'   => 'index.php/admin/setting/payment/install?extension=' . $extension,
                    'uninstall' => 'index.php/admin/setting/payment/uninstall?extension=' . $extension,
                    'installed' => in_array($extension, $extensions),
                    'edit'      => 'admin/payment/' . $extension . '/edit'
                );
            }
        }
        return $data;
    }
// TODO: return msg
    public function install()
    {
        $extension = $this->input->get('extension');
        $model = 'model_'. $extension;
        $this->load->model('admin/payment/' . $model);
        if ($this->$model->install()) {

        }
    }
// TODO: return msg
    public function uninstall()
    {
        $extension = $this->input->get('extension');
        $model = 'model_'. $extension;
        $this->load->model('admin/payment/' . $model);
        $this->$model->uninstall();
    }
}
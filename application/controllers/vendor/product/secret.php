<?php

/**
 * Created by SD.
 * Date: 13/07/2017
 */
class Secret extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->vendor) {
            $this->load->model('vendor/common/model_header');
            $this->load->model('vendor/common/model_footer');
            $this->load->model('vendor/common/model_column_left');
            $this->load->model('vendor/product/model_secret');
            $this->lang->load('vendor/product/secret_lang');
            $this->load->library('form_validation');
        } else {
            $this->load->helper('url');
            redirect('vendor/common/login');
        }
    }
// TODO: add filters => 1. filt by product_id, 2. filt by status, 3. search by secret
    public function index()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/product/secret',
        );

        $data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : NULL;
        $data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : NULL;
        $data['error_alert'] = $this->input->get('success') == 3 ? $this->lang->line('text_warning') : NULL;

        $data['add'] = 'index.php/vendor/product/secret/add';
        $data['delete'] = 'index.php/vendor/product/secret/delete';

        $data['heading_title'] = $this->lang->line('heading_title');

        // form title
        $data['text_list'] = $this->lang->line('text_list');
        $data['text_confirm'] = $this->lang->line('text_confirm');
        $data['text_no_results'] = $this->lang->line('text_no_results');

        // column names
        $data['column_name'] = $this->lang->line('column_name');
        $data['column_secret'] = $this->lang->line('column_secret');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_action'] = $this->lang->line('column_action');

        $data['button_add'] = $this->lang->line('button_add');
        $data['button_edit'] = $this->lang->line('button_edit');
        $data['button_delete'] = $this->lang->line('button_delete');

        $data['selected'] = array();

        // set pagination
        $setting = array(
            'base_url' => 'index.php/vendor/product/secret/index/',
            'total'    => $this->model_secret->getSecretTotal(),
            'per_page' => 20,
        );

        $this->load->model('model_common');
        $config = $this->model_common->setPagination($setting);
        $this->pagination->initialize($config);


        // $this->uri->segment(5, 1) get the current page number,
        // if current page number cannot found, set page number as 1
        // use current page number to calculate "start" index
        $secrets = $this->model_secret->getSecrets(($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page'], $this->session->vendor['vendor_id']);

        $this->load->model('vendor/product/model_product');
        foreach ($secrets as $secret) {
            $data['secrets'][] = array(
                'id'      => $secret['id'],
                'name'    => $this->model_product->getProduct($secret['product_id'], $this->session->vendor['vendor_id'])->name,
                'secret'  => $secret['secret'],
                'is_used' => $secret['is_used'] ? $this->lang->line('text_used') : $this->lang->line('text_not_used'),
                'edit'    => 'index.php/vendor/product/secret/edit?id=' . $secret['id'],
            );
        }


        $this->load->view('vendor/product/secret', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function upload()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_upload'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $this->form_validation->set_rules('product', '商品', 'trim|required');
        $this->form_validation->set_rules('secret', '卡密', 'trim|required|callback_secretLineCheck');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information

            $post = $this->input->post();

            if ($this->model_secret->uploadSecret($post['product'], $post['secret'], $this->session->vendor['vendor_id'])) {
                redirect('vendor/product/secret/upload?success=4');
            } else {
                redirect('vendor/product/secret/upload?success=5');
            }

        } else { // render the form

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => 'home',
                'href' => 'index.php/vendor/common/dashboard',
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->lang->line('heading_title'),
                'href' => 'index.php/vendor/product/secret/upload',
            );

            $data['success'] = $this->input->get('success') == 4 ? $this->lang->line('text_upload_success') : NULL;
            $data['error_warning'] = $this->input->get('success') == 5 ? $this->lang->line('text_upload_error') : NULL;

            $data['heading_title'] = $this->lang->line('heading_title_upload');

            // form title
            $data['text_list'] = $this->lang->line('text_list');
            $data['text_form'] = $this->lang->line('text_form_upload');

            // column names
            $data['column_product'] = $this->lang->line('column_product');
            $data['column_secret'] = $this->lang->line('column_secret');

            // help
            $data['help_secret'] = $this->lang->line('help_secret');

            // buttons
            $data['button_save'] = $this->lang->line('button_save');
            $data['button_clear'] = $this->lang->line('button_clear');

            $data['action'] = 'index.php/vendor/product/secret/upload';

            $this->load->model('vendor/product/model_product');
            $data['products'] = $this->model_product->getProducts('', '', $this->session->vendor['vendor_id']);

            $this->load->view('vendor/product/upload', $data);
            // set footer
            $this->model_footer->loadFooter();
        }
    }

    public function add()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_add'), '');
        // set sidebar
        $this->model_column_left->loadSidebar();

        $this->form_validation->set_rules('product', '商品', 'trim|required');
        $this->form_validation->set_rules('secret', '卡密', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('status', '状态', 'trim|required|integer');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information
            $post = $this->input->post();
            if ($this->model_secret->addSecret($post, $this->session->vendor['vendor_id'])) {
                redirect('vendor/product/secret?success=1');
            } else {
                redirect('vendor/product/secret/add');
            }
        } else { // render the form
            $data = $this->_form('add', '');

            $this->load->model('vendor/product/model_product');
            $data['products'] = $this->model_product->getProducts('', '', $this->session->vendor['vendor_id']);
            $data['id'] = '';
            $data['myproduct'] = '';
            $data['secret'] = '';
            $data['status'] = '';

            $this->load->view('vendor/product/secret_form', $data);
            // set footer
            $this->model_footer->loadFooter();
        }
    }

    public function edit()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_add'), '');
        // set sidebar
        $this->model_column_left->loadSidebar();

        $this->form_validation->set_rules('product', '商品', 'trim|required');
        $this->form_validation->set_rules('secret', '卡密', 'trim|required|alpha_numeric');
        $this->form_validation->set_rules('status', '状态', 'trim|required|integer');
        
        $id = $this->input->get('id');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information
            $post = $this->input->post();
            if ($this->model_secret->editSecret($post, $this->session->vendor['vendor_id'])) {
                redirect('vendor/product/secret?success=1');
            } else {
                redirect('vendor/product/secret/edit?id=' . $id);
            }
        } else { // render the form
            $data = $this->_form('edit', $id);
            
            $secret = $this->model_secret->getSecret($id);
            $data['id'] = $secret->id;
            $data['myproduct'] = $secret->product_id;
            $data['secret'] = $secret->secret;
            $data['status'] = $secret->is_used;
            
            $this->load->model('vendor/product/model_product');
            $data['products'] = $this->model_product->getProducts('', '', $this->session->vendor['vendor_id']);

            $this->load->view('vendor/product/secret_form', $data);
            // set footer
            $this->model_footer->loadFooter();
        }
    }

    public function delete()
    {
        foreach ($this->input->post('selected') as $id) {
            $this->model_secret->deleteSecret($id, $this->session->vendor['vendor_id']);
        }
        redirect('vendor/product/secret?success=1');
    }

    private function _form($action, $secret_id)
    {
        $data['button_save'] = $this->lang->line('button_save');
        $data['button_cancel'] = $this->lang->line('button_cancel');
        $data['action'] = 'index.php/vendor/product/secret/' . $action . '?id=' . $secret_id;
        $data['cancel'] = 'index.php/vendor/product/secret/';

        $data['heading_title'] = $this->lang->line('heading_title_' . $action);
        $data['text_form'] = $this->lang->line('text_form_' . $action);
        $data['text_used'] = $this->lang->line('text_used');
        $data['text_not_used'] = $this->lang->line('text_not_used');

        $data['column_product'] = $this->lang->line('column_product');
        $data['column_secret'] = $this->lang->line('column_secret');
        $data['column_status'] = $this->lang->line('column_status');

        $data['entry_secret'] = $this->lang->line('entry_secret');
        $data['entry_status'] = $this->lang->line('entry_status');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/product/secret',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_' . $action),
            'href' => 'index.php/vendor/product/secret/' . $action . '?id=' . $secret_id,
        );

        return $data;
    }

    public function secretLineCheck($text = NULL)
    {
        isset($text) OR show_404();

        $secrets = explode("\n", trim($text));

        if (count($secrets) >= 500) {
            $this->form_validation->set_message('secretLineCheck', ' 一次性上传的{field}数量不能超过500条');

            return false;
        }

        foreach ($secrets as $secret) {
            if (!preg_match('/^[A-Za-z0-9]+$/', trim($secret))) {
                $this->form_validation->set_message('secretLineCheck', ' {field}只能包含字母和数字');

                return false;
            }
        }

        return true;
    }
}
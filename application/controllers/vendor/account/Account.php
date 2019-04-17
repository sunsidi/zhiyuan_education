<?php

/**
 * Created by SD.
 * Date: 27/08/2017
 */
class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->vendor) {
            $this->load->model('vendor/common/model_header');
            $this->load->model('vendor/common/model_footer');
            $this->load->model('vendor/common/model_column_left');
            $this->load->model('vendor/account/model_account');
            $this->lang->load('vendor/account/account_lang');
            $this->load->library('form_validation');
        } else {
            $this->load->helper('url');
            redirect('vendor/common/login');
        }
    }

    public function index()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_account'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $vendor_id = $this->session->vendor['vendor_id'];

        $this->form_validation->set_rules('email', '邮箱', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', '电话', 'trim|required|numeric');
        $this->form_validation->set_rules('qq', 'QQ', 'trim|required|integer');
        $this->form_validation->set_rules('bank', '开户行', 'trim|required');
        $this->form_validation->set_rules('bank_city', '开户行城市', 'trim|required');
        $this->form_validation->set_rules('bank_address', '开户行地址', 'trim|required');
        $this->form_validation->set_rules('account', '收款账号', 'trim|required|numeric');
        $this->form_validation->set_rules('realname', '真实姓名', 'trim|required');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information
            $post = $this->input->post(NULL, true);
            if ($this->model_account->editAccount($post, $vendor_id)) {
                redirect('vendor/account/account?status=success');
            }
        } else {
            $vendor = $this->model_account->getVendor($vendor_id);
            $account = $this->model_account->getAccount($vendor_id);

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => 'home',
                'href' => 'index.php/vendor/common/dashboard',
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->lang->line('heading_title_account'),
                'href' => 'index.php/vendor/account/account',
            );

            $data['id'] = $vendor->vendor_id;
            $data['email'] = $vendor->email;
            $data['qq'] = $vendor->qq;
            $data['phone'] = $vendor->phone;
            $data['status'] = $vendor->status;
            $data['account'] = $account->account;
            $data['realname'] = $account->realname;
            $data['bank'] = $account->bank;
            $data['bank_city'] = $account->bank_city;
            $data['bank_address'] = $account->bank_address;


            $data['heading_title'] = $this->lang->line('heading_title_account');

            $data['column_email'] = $this->lang->line('column_email');
            $data['column_telephone'] = $this->lang->line('column_telephone');
            $data['column_qq'] = $this->lang->line('column_qq');
            $data['column_bank'] = $this->lang->line('column_bank');
            $data['column_bank_city'] = $this->lang->line('column_bank_city');
            $data['column_bank_address'] = $this->lang->line('column_bank_address');
            $data['column_account'] = $this->lang->line('column_account');
            $data['column_realname'] = $this->lang->line('column_realname');

            $data['text_form'] = $this->lang->line('text_form_account');
            $data['text_success'] = $this->lang->line('text_success');

            $data['button_save'] = $this->lang->line('button_save');
            $data['button_cancel'] = $this->lang->line('button_cancel');

            $data['action'] = 'index.php/vendor/account/account/';
            $data['cancel'] = 'index.php/vendor/common/dashboard';

            $this->load->view('vendor/account/account', $data);
            // set footer
            $this->model_footer->loadFooter();
        }
    }

    public function password()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_password'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $vendor_id = $this->session->vendor['vendor_id'];

        $this->form_validation->set_message('matches', ' 两次输入的密码不一致');
        $this->form_validation->set_rules('old_password', '旧的密码', 'trim|required|min_length[6]|max_length[16]|callback_checkPassword');
        $this->form_validation->set_rules('new_password', '新的密码', 'trim|required|min_length[6]|max_length[16]|matches[confirm]');
        $this->form_validation->set_rules('confirm', '确认密码', 'trim|required|min_length[6]');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information
            $post = $this->input->post(NULL, true);
            if ($this->model_account->resetPassword($post, $vendor_id)) {
                redirect('vendor/account/account/password?status=success');
            }
        } else {

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => 'home',
                'href' => 'index.php/vendor/common/dashboard',
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->lang->line('heading_title_account'),
                'href' => 'index.php/vendor/account/password',
            );

            $data['old_password'] = '';
            $data['new_password'] = '';
            $data['confirm'] = '';


            $data['heading_title'] = $this->lang->line('heading_title_password');

            $data['column_old_password'] = $this->lang->line('column_old_password');
            $data['column_new_password'] = $this->lang->line('column_new_password');
            $data['column_confirm'] = $this->lang->line('column_confirm');

            $data['text_form'] = $this->lang->line('text_form_password');
            $data['text_success'] = $this->lang->line('text_success');

            $data['button_save'] = $this->lang->line('button_save');
            $data['button_cancel'] = $this->lang->line('button_cancel');

            $data['action'] = 'index.php/vendor/account/account/password/';
            $data['cancel'] = 'index.php/vendor/common/dashboard';

            $this->load->view('vendor/account/password', $data);
            // set footer
            $this->model_footer->loadFooter();
        }
    }

    public function checkPassword($password)
    {
        $vendor_id = $this->session->vendor['vendor_id'];
        if (!$this->model_account->passwordVerification($password, $vendor_id)) {
            $this->form_validation->set_message('checkPassword', ' 密码输入错误');
            return false;
        } else {
            return true;
        }
    }
}
<?php

/**
 * Created by SD.
 * Date: 29/08/2017
 */
class Cash extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->vendor) {
            $this->load->model('vendor/common/model_header');
            $this->load->model('vendor/common/model_footer');
            $this->load->model('vendor/common/model_column_left');
            $this->load->model('vendor/account/model_cash');
            $this->lang->load('vendor/account/cash_lang');
            $this->load->library('form_validation');
        } else {
            $this->load->helper('url');
            redirect('vendor/common/login');
        }
    }

    public function index()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $this->form_validation->set_rules('withdraw', '提现金额', 'trim|required|numeric|callback_checkBalance');

        if ($this->form_validation->run() && $this->input->post()) {
            $post = $this->input->post(NULL, true);
            $this->model_cash->createWithdrawPurpose($post, $this->session->vendor['username']);
            redirect('vendor/account/cash?status=success');
        } else {
            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => 'home',
                'href' => 'index.php/vendor/common/dashboard',
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->lang->line('heading_title'),
                'href' => 'index.php/vendor/account/cash',
            );

            $data['column_cash'] = $this->lang->line('column_cash');
            $data['column_time'] = $this->lang->line('column_time');
            $data['column_review_time'] = $this->lang->line('column_review_time');
            $data['column_msg'] = $this->lang->line('column_msg');
            $data['column_withdraw'] = $this->lang->line('column_withdraw');
            $data['column_balance'] = $this->lang->line('column_balance');

            $data['text_no_results'] = $this->lang->line('text_no_results');
            $data['text_success'] = $this->lang->line('text_success');
            $data['heading_title'] = $this->lang->line('heading_title');
            $data['button_cancel'] = $this->lang->line('button_cancel');

            $data['balance'] = $this->model_cash->getBalance($this->session->vendor['vendor_id']);

            // set pagination
            $setting = array(
                'base_url' => 'index.php/vendor/account/cash/index/',
                'total'    => $this->model_cash->getTotalWithdraw($this->session->vendor['username']),
                'per_page' => 10,
            );

            $this->load->model('model_common');
            $config = $this->model_common->setPagination($setting);
            $this->pagination->initialize($config);

            // $this->uri->segment(5, 1) get the current page number,
            // if current page number cannot found, set page number as 1
            // use current page number to calculate "start" index
            $withdraws = $this->model_cash->getWithdrawRecord($this->session->vendor['username'], ($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page']);
            $classes = array('warning', 'success', 'danger');
            foreach ($withdraws as $withdraw) {
                $data['withdraws'][] = array(
                    'cash'        => $withdraw['cash'],
                    'date_added'  => $withdraw['date_added'],
                    'msg'         => $withdraw['msg'],
                    'review_time' => $withdraw['review_time'],
                    'class'       => $classes[$withdraw['status']],
                );
            }

            $data['cancel'] = 'index.php/vendor/common/dashboard';
            $data['action'] = 'index.php/vendor/account/cash';

            $this->load->view('vendor/account/cash', $data);
        }
        // set footer
        $this->model_footer->loadFooter();
    }

    public function checkBalance($withdraw)
    {
        $balance = $this->model_cash->getBalance($this->session->vendor['vendor_id']);

        if ($withdraw <= $balance && $withdraw > 0) {
            return true;
        } else if ($withdraw == 0) {
            $this->form_validation->set_message('checkBalance', ' 提现金额必须大于0');

            return false;
        } else {
            $this->form_validation->set_message('checkBalance', ' 余额不足');

            return false;
        }
    }
}
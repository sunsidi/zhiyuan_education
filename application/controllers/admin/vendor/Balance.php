<?php

/**
 * Created by SD.
 * Date: 31/08/2017
 */
class Balance extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');

            $this->load->model('admin/vendor/model_balance');
            $this->lang->load('admin/vendor/balance_lang');
            $this->load->library('form_validation');
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

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/admin/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/admin/vendor/balance',
        );

        // set pagination
        $setting = array(
            'base_url' => 'index.php/admin/vendor/balance/index/',
            'total'    => $this->model_balance->getBalanceNum(),
            'per_page' => 10,
        );

        $this->load->model('model_common');
        $config = $this->model_common->setPagination($setting);
        $this->pagination->initialize($config);


        // $this->uri->segment(5, 1) get the current page number,
        // if current page number cannot found, set page number as 1
        // use current page number to calculate "start" index
        $balances = $this->model_balance->getBalances(($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page']);

        foreach ($balances as $balance) {
            $data['balances'][] = array(
                'vendor_id' => $balance['vendor_id'],
                'username'  => $this->model_balance->getVendorUsername($balance['vendor_id']),
                'balance'   => $balance['balance'],
            );
        }

        $data['column_username'] = $this->lang->line('column_username');
        $data['column_balance'] = $this->lang->line('column_balance');
        $data['heading_title'] = $this->lang->line('heading_title');
        $data['button_cancel']= $this->lang->line('button_cancel');
        
        $data['cancel'] = 'index.php/admin/common/dashboard';

        $this->load->view('admin/vendor/balance', $data);
        // set footer
        $this->model_footer->loadFooter();
    }
}
<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/common/model_login');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');
            $this->load->model('admin/common/model_dashboard');
            $this->lang->load('admin/common/dashboard_lang');
        } else {
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }

    public function index()
    {
        // set header
        $this->model_header->loadHeader();

        // set sidebar
        $this->model_column_left->loadSidebar();

        $this->lang->load('admin/common/dashboard_lang');

        $data['heading_title'] = $this->lang->line('heading_title');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/admin/common/dashboard'
        );

        $data['breadcrumbs'][] = array(
            'text' => 'dashboard',
            'href' => 'index.php/admin/common/dashboard'
        );
        
        $data['announcement'] = $this->lang->line("announcement");
        
//        $data['registers'] = $this->model_dashboard->getNewRegisters(date('Y-M-D'));
        
//        $data['total_sales'] = $this->model_dashboard->getTotalSales();
//
//        $data['withdraw'] = $this->model_dashboard->getWithdraw(date('Y-M-D'));
//
//        $data['revenue'] = $this->model_dashboard->calculateRevenue();
//
//        $data['heading_title'] = $this->lang->line('heading_title');

//        $purposes = $this->model_dashboard->getRegisterDetails(0, 10);

//        $classes = array('warning', 'success', 'danger');
//
//        foreach ($purposes as $purpose) {
//            $data['register_purposes'][] = array(
//                'id'            => $purpose['vendor_id'],
//                'username'      => $purpose['username'],
//                'status'        => $this->model_dashboard->getVendorStatus($purpose['status'])->name,
//                'register_time' => $purpose['register_time'],
//                'review_time'   => $purpose['review_time'],
//                'class'         => $classes[$purpose['status']],
//                'approve'       => 'index.php/admin/vendor/review/approve?type=register&id=' . $purpose['vendor_id'],
//                'reject'        => 'index.php/admin/vendor/review/reject?type=register&id=' . $purpose['vendor_id'],
//            );
//        }
//
//        $purposes = $this->model_dashboard->getWithdrawDetails(0, 10);
//
//        foreach ($purposes as $purpose) {
//            $data['withdraw_purposes'][] = array(
//                'id'          => $purpose['id'],
//                'username'    => $purpose['username'],
//                'cash'        => $purpose['cash'],
//                'date_added'  => $purpose['date_added'],
//                'status'      => $purpose['status'],
//                'msg'         => $purpose['msg'],
//                'review_time' => $purpose['review_time'],
//                'class'       => $classes[$purpose['status']],
//                'approve'     => 'index.php/admin/vendor/review/approve?type=withdraw&id=' . $purpose['id'],
//                'reject'      => 'index.php/admin/vendor/review/reject?type=withdraw&id=' . $purpose['id'],
//            );
//        }

        $data['text_daily_register'] = $this->lang->line('text_daily_register');
        $data['text_total_sales'] = $this->lang->line('text_total_sales');
        $data['text_daily_withdraw'] = $this->lang->line('text_daily_withdraw');
        $data['text_total_revenue'] = $this->lang->line('text_total_revenue');
        $data['text_no_register'] = $this->lang->line('text_no_register');
        $data['text_no_withdraw'] = $this->lang->line('text_no_withdraw');

        $data['heading_title_register'] = $this->lang->line('heading_title_register');
        $data['heading_title_withdraw'] = $this->lang->line('heading_title_withdraw');

        $data['column_username'] = $this->lang->line('column_username');
        $data['column_register_time'] = $this->lang->line('column_register_time');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_review_time'] = $this->lang->line('column_review_time');
        $data['column_review'] = $this->lang->line('column_review');
        $data['column_cash'] = $this->lang->line('column_cash');
        $data['column_purpose_time'] = $this->lang->line('column_purpose_time');

        $this->load->view('admin/common/dashboard', $data);

        // set footer
        $this->model_footer->loadFooter();
    }
}
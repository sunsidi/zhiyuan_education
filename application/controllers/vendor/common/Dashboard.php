<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('vendor/common/model_login');
        if ($this->session->vendor) {
            $this->load->model('vendor/common/model_header');
            $this->load->model('vendor/common/model_footer');
            $this->load->model('vendor/common/model_column_left');
            $this->load->model('vendor/common/model_dashboard');
            $this->load->model('vendor/information/model_announcement');
            $this->lang->load('vendor/common/dashboard_lang');
        } else {
            $this->load->helper('url');
            redirect('vendor/common/login');
        }
    }

    public function index()
    {
        // set header
        $this->model_header->loadHeader();

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['heading_title'] = $this->lang->line('heading_title');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['announcement'] = $this->lang->line("announcement");

        $vendor_id = $this->session->vendor['vendor_id'];
        $group_id = $this->session->vendor['group_id'];

        $token = $this->model_dashboard->getVendorToken($vendor_id);

        $data['vendor_url'] = base_url() . 'index.php/mall/vendor?token=' . $token;

        $data['orders'] = $this->model_dashboard->getOrderNumbers($vendor_id);
        $data['daily_orders'] = $this->model_dashboard->getDailyOrders(date('Y-m-d'), $vendor_id);
        $data['sales'] = $this->model_dashboard->getTotalSales($vendor_id);
        $data['daily_sales'] = $this->model_dashboard->getDailySales(date('Y-m-d'), $vendor_id);

        $data['messages'] = $this->model_dashboard->getUnreadMessages($vendor_id, $group_id, 10, 0);
        $wikis = $this->model_dashboard->getWikis(10, 0);
        foreach ($wikis as $wiki) {
            $data['wikis'][] = array(
                'title' => $wiki['title'],
                'class' => $this->model_announcement->getPriority($wiki['priority'])->code,
                'link' => 'index.php/vendor/information/announcement/content?id=' . $wiki['id']
            );
        }


        $data['heading_title'] = $this->lang->line('heading_title');
        $data['heading_title_wiki'] = $this->lang->line('heading_title_wiki');
        $data['heading_title_message'] = $this->lang->line('heading_title_message');

        $data['text_vendor_url'] = $this->lang->line('text_vendor_url');
        $data['text_orders'] = $this->lang->line('text_orders');
        $data['text_sales'] = $this->lang->line('text_sales');
        $data['text_daily_orders'] = $this->lang->line('text_daily_orders');
        $data['text_daily_sales'] = $this->lang->line('text_daily_sales');
        $data['text_no_messages'] = $this->lang->line('text_no_messages');
        $data['text_no_wikis'] = $this->lang->line('text_no_wikis');

        $data['column_message'] = $this->lang->line('column_message');
        $data['column_date'] = $this->lang->line('column_date');
        $data['column_title'] = $this->lang->line('column_title');

        $this->load->view('vendor/common/dashboard', $data);

        // set footer
        $this->model_footer->loadFooter();
    }
}
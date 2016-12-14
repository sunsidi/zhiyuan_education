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

        $this->load->view('admin/common/dashboard', $data);

        // set footer
        $this->model_footer->loadFooter();
    }
}
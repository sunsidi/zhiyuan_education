<?php

/**
 * Created by SD.
 * Date: 25/07/2017
 */
class Review extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');

            $this->load->model('admin/vendor/model_review');
            $this->lang->load('admin/vendor/review_lang');
            $this->load->library('form_validation');
        } else {
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }

    // 用户名,注册时间,是否已审核,查看基本信息
    public function register()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_register'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/admin/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_register'),
            'href' => 'index.php/admin/vendor/review/register',
        );

        $data['column_username'] = $this->lang->line('column_username');
        $data['column_register_time'] = $this->lang->line('column_register_time');
        $data['column_review_time'] = $this->lang->line('column_review_time');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_review'] = $this->lang->line('column_review');

        $data['heading_title'] = $this->lang->line('heading_title_register');
        $data['text_no_results'] = $this->lang->line('text_no_results');
        $data['text_confirm'] = $this->lang->line('text_confirm');

        // set pagination
        $setting = array(
            'base_url' => 'index.php/admin/vendor/review/withdraw/',
            'total'    => $this->model_review->getRegisterTotal(),
            'per_page' => 10,
        );

        $this->load->model('model_common');
        $config = $this->model_common->setPagination($setting);
        $this->pagination->initialize($config);


        // $this->uri->segment(5, 1) get the current page number,
        // if current page number cannot found, set page number as 1
        // use current page number to calculate "start" index
        $purposes = $this->model_review->getRegister(($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page']);

        $classes = array('warning', 'success', 'danger');

        foreach ($purposes as $purpose) {
            $data['purposes'][] = array(
                'id'            => $purpose['vendor_id'],
                'username'      => $purpose['username'],
                'status'        => $this->model_review->getVendorStatus($purpose['status'])->name,
                'register_time' => $purpose['register_time'],
                'review_time'   => $purpose['review_time'],
                'class'         => $classes[$purpose['status']],
                'approve'       => 'index.php/admin/vendor/review/approve?type=register&id=' . $purpose['vendor_id'],
                'reject'        => 'index.php/admin/vendor/review/reject?type=register&id=' . $purpose['vendor_id'],
            );
        }

        $this->load->view('admin/vendor/register', $data);
        // set footer
        $this->model_footer->loadFooter();
    }


    // 用户名,金额,申请时间,是否已审核,拒绝原因,操作
    public function withdraw()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_withdraw'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array('text' => 'home', 'href' => 'index.php/admin/common/dashboard');

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_withdraw'),
            'href' => 'index.php/admin/vendor/review/withdraw',
        );

        $data['column_username'] = $this->lang->line('column_username');
        $data['column_cash'] = $this->lang->line('column_cash');
        $data['column_time'] = $this->lang->line('column_time');
        $data['column_review_time'] = $this->lang->line('column_review_time');
        $data['column_msg'] = $this->lang->line('column_msg');
        $data['column_review'] = $this->lang->line('column_review');

        $data['heading_title'] = $this->lang->line('heading_title_withdraw');
        $data['text_no_results'] = $this->lang->line('text_no_results');
        $data['text_confirm'] = $this->lang->line('text_confirm');

        // set pagination
        $setting = array(
            'base_url' => 'index.php/admin/vendor/review/withdraw/',
            'total'    => $this->model_review->getWithdrawTotal(),
            'per_page' => 10,
        );

        $this->load->model('model_common');
        $config = $this->model_common->setPagination($setting);
        $this->pagination->initialize($config);


        // $this->uri->segment(5, 1) get the current page number,
        // if current page number cannot found, set page number as 1
        // use current page number to calculate "start" index
        $purposes = $this->model_review->getWithdraw(($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page']);

        $classes = array('warning', 'success', 'danger');
        foreach ($purposes as $purpose) {
            $data['purposes'][] = array(
                'id'          => $purpose['id'],
                'username'    => $purpose['username'],
                'cash'        => $purpose['cash'],
                'date_added'  => $purpose['date_added'],
                'status'      => $purpose['status'],
                'msg'         => $purpose['msg'],
                'review_time' => $purpose['review_time'],
                'class'       => $classes[$purpose['status']],
                'approve'     => 'index.php/admin/vendor/review/approve?type=withdraw&id=' . $purpose['id'],
                'reject'      => 'index.php/admin/vendor/review/reject?type=withdraw&id=' . $purpose['id'],
            );
        }

        $this->load->view('admin/vendor/withdraw', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    // Do the approve action based on the different types of purposes
    // Register or Withdraw
    public function approve()
    {
        $type = $this->input->get('type');
        $id = $this->input->get('id');

        $this->model_review->approve($type, $id);

        redirect($_SERVER['HTTP_REFERER']);
    }

    // Do the reject action based on the different types of purposes
    // Register or Withdraw
    public function reject()
    {
        $type = $this->input->get('type');
        $id = $this->input->get('id');

        $this->model_review->reject($type, $id);

        redirect($_SERVER['HTTP_REFERER']);
    }
}
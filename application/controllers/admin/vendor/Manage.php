<?php

/**
 * Created by SD.
 * Date: 25/07/2017
 */
class Manage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');

            $this->load->model('admin/vendor/model_manage');
            $this->lang->load('admin/vendor/manage_lang');
            $this->load->library('form_validation');
            $this->load->helper('url');
        } else {
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }

    public function group()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_group'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/admin/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_group'),
            'href' => 'index.php/admin/vendor/manage/group',
        );

        $groups = $this->model_manage->getGroups();

        foreach ($groups as $group) {
            $data['groups'][] = array(
                'id'   => $group['id'],
                'name' => $group['name'],
                'edit' => 'index.php/admin/vendor/manage/edit_group?group_id=' . $group['id'],
            );
        }

        $data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : NULL;
        $data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : NULL;
        $data['error_alert'] = $this->input->get('success') == 3 ? $this->lang->line('text_warning') : NULL;

        $data['column_name'] = $this->lang->line('column_name');
        $data['column_edit'] = $this->lang->line('column_edit');

        $data['heading_title'] = $this->lang->line('heading_title_group');
        $data['text_no_results'] = $this->lang->line('text_no_results');
        $data['text_confirm'] = $this->lang->line('text_confirm');

        $data['button_add'] = $this->lang->line('button_add');
        $data['button_delete'] = $this->lang->line('button_delete');

        $data['add'] = 'index.php/admin/vendor/manage/add_group';
        $data['delete'] = 'index.php/admin/vendor/manage/delete_group';

        $data['selected'] = array();

        $this->load->view('admin/vendor/group', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function edit_group()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_group'), '');
        // set sidebar
        $this->model_column_left->loadSidebar();

        $this->form_validation->set_rules('name', '分组名称', 'trim|required');
        $this->form_validation->set_rules('rate', '分组费率', 'trim|required|less_than[1]|greater_than_equal_to[0]');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information
            $post = $this->input->post();
            if ($this->model_manage->editGroup($post)) {
                redirect('admin/vendor/manage/group?success=1');
            } else {
                redirect('admin/vendor/manage/group?success=2');
            }
        } else { // render the form
            $group_id = $this->input->get('group_id');
            $data = $this->_group_form('edit', $group_id);
            $group = $this->model_manage->getGroup($group_id);

            if (isset($group)) {
                $data['id'] = $group->id;
                $data['name'] = $group->name;
                $data['rate'] = $group->rate;
            }

            $this->load->view('admin/vendor/group_form', $data);
        }
    }

    public function add_group()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_group'), '');
        // set sidebar
        $this->model_column_left->loadSidebar();

        $this->form_validation->set_rules('name', '分组名称', 'trim|required');
        $this->form_validation->set_rules('rate', '分组费率', 'trim|required|less_than[1]|greater_than_equal_to[0]');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information
            $post = $this->input->post();
            if ($this->model_manage->addGroup($post)) {
                redirect('admin/vendor/manage/group?success=1');
            } else {
                redirect('admin/vendor/manage/group?success=2');
            }
        } else { // render the form
            $data = $this->_group_form('add');

            $data['id'] = '';
            $data['name'] = '';
            $data['rate'] = '';

            $this->load->view('admin/vendor/group_form', $data);
        }
    }

    public function delete_group()
    {
        foreach ($this->input->post('selected') as $id) {
            $this->model_manage->deleteGroup($id);
        }
        redirect('admin/vendor/manage/group?success=1');
    }

    private function _group_form($action, $id = "")
    {
        $data['button_save'] = $this->lang->line('button_save');
        $data['button_cancel'] = $this->lang->line('button_cancel');
        $data['action'] = 'index.php/admin/vendor/manage/' . $action . '_group?group_id=' . $id;
        $data['cancel'] = 'index.php/admin/vendor/manage/group';

        $data['heading_title'] = $this->lang->line('heading_title_group');
        $data['text_form'] = $this->lang->line('text_form_group');
        $data['text_enable'] = $this->lang->line('text_enable');
        $data['text_disable'] = $this->lang->line('text_disable');

        $data['column_name'] = $this->lang->line('column_name');
        $data['column_rate'] = $this->lang->line('column_rate');

        $data['entry_name'] = $this->lang->line('entry_name');
        $data['entry_rate'] = $this->lang->line('entry_rate');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/admin/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_group'),
            'href' => 'index.php/admin/vendor/manage/group',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('text_' . $action),
            'href' => 'index.php/admin/vendor/manage/' . $action . '_group',
        );

        return $data;
    }

    public function vendor()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_vendor'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/admin/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_vendor'),
            'href' => 'index.php/admin/vendor/manage/vendor',
        );

        // set pagination
        $setting = array(
            'base_url' => 'index.php/admin/vendor/manage/vendor/',
            'total'    => $this->model_manage->getTotalVendors(),
            'per_page' => 10,
        );

        $this->load->model('model_common');
        $config = $this->model_common->setPagination($setting);
        $this->pagination->initialize($config);


        // $this->uri->segment(5, 1) get the current page number,
        // if current page number cannot found, set page number as 1
        // use current page number to calculate "start" index
        $vendors = $this->model_manage->getVendors(($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page']);
        $classes = array('warning', 'success', 'danger');

        foreach ($vendors as $vendor) {
            $data['vendors'][] = array(
                'id'       => $vendor['vendor_id'],
                'username' => $vendor['username'],
                'phone'    => $vendor['phone'],
                'email'    => $vendor['email'],
                'qq'       => $vendor['qq'],
                'status'   => $this->model_manage->getVendorStatus($vendor['status'])->name,
                'account'  => $this->model_manage->getVendorAccount($vendor['vendor_id'])->account,
                'class'    => $classes[$vendor['status']],
                'edit'     => 'index.php/admin/vendor/manage/edit_vendor?vendor_id=' . $vendor['vendor_id'],
            );
        }

        $data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : NULL;
        $data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : NULL;
        $data['error_alert'] = $this->input->get('success') == 3 ? $this->lang->line('text_warning') : NULL;

        $data['column_username'] = $this->lang->line('column_username');
        $data['column_telephone'] = $this->lang->line('column_telephone');
        $data['column_email'] = $this->lang->line('column_email');
        $data['column_qq'] = $this->lang->line('column_qq');
        $data['column_account'] = $this->lang->line('column_account');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_edit'] = $this->lang->line('column_edit');
        $data['column_password'] = $this->lang->line('column_password');
        $data['column_confirm'] = $this->lang->line('column_confirm');

        $data['entry_password'] = $this->lang->line('entry_password');
        $data['entry_confirm'] = $this->lang->line('entry_confirm');

        $data['heading_title'] = $this->lang->line('heading_title_vendor');
        $data['text_no_results'] = $this->lang->line('text_no_user');
        $data['text_confirm'] = $this->lang->line('text_confirm');

        $data['reset'] = 'index.php/admin/vendor/manage/reset_password';

        $this->load->view('admin/vendor/vendor', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function edit_vendor()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_vendor'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $vendor_id = $this->input->get('vendor_id');

        $this->form_validation->set_rules('email', '邮箱', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', '电话', 'trim|required|numeric');
        $this->form_validation->set_rules('qq', 'QQ', 'trim|required|integer');
        $this->form_validation->set_rules('bank', '开户行', 'trim|required');
        $this->form_validation->set_rules('bank_city', '开户行城市', 'trim|required');
        $this->form_validation->set_rules('bank_address', '开户行地址', 'trim|required');
        $this->form_validation->set_rules('account', '收款账号', 'trim|required|numeric');
        $this->form_validation->set_rules('realname', '真实姓名', 'trim|required');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information
            $post = $this->input->post();
            if ($this->model_manage->editVendor($post)) {
                redirect('admin/vendor/manage/vendor?success=1');
            } else {
                redirect('admin/vendor/manage/edit_vendor?vendor_id=' . $vendor_id);
            }
        } else {
            $vendor = $this->model_manage->getVendor($vendor_id);
            $account = $this->model_manage->getAccount($vendor_id);
            $groups = $this->model_manage->getGroups();

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => 'home',
                'href' => 'index.php/admin/common/dashboard',
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->lang->line('heading_title_vendor'),
                'href' => 'index.php/admin/vendor/manage/vendor',
            );

            $data['breadcrumbs'][] = array(
                'text' => $vendor->username,
                'href' => 'index.php/admin/vendor/manage/edit_vendor?vendor_id=' . $vendor_id,
            );

            $data['id'] = $vendor->vendor_id;
            $data['email'] = $vendor->email;
            $data['qq'] = $vendor->qq;
            $data['phone'] = $vendor->phone;
            $data['group_id'] = $vendor->group_id;
            $data['status'] = $vendor->status;
            $data['account'] = $account->account;
            $data['realname'] = $account->realname;
            $data['bank'] = $account->bank;
            $data['bank_city'] = $account->bank_city;
            $data['bank_address'] = $account->bank_address;


            $data['heading_title'] = $this->lang->line('heading_title_vendor') . '-' . $vendor->username;

            $data['column_email'] = $this->lang->line('column_email');
            $data['column_telephone'] = $this->lang->line('column_telephone');
            $data['column_qq'] = $this->lang->line('column_qq');
            $data['column_bank'] = $this->lang->line('column_bank');
            $data['column_bank_city'] = $this->lang->line('column_bank_city');
            $data['column_bank_address'] = $this->lang->line('column_bank_address');
            $data['column_account'] = $this->lang->line('column_account');
            $data['column_realname'] = $this->lang->line('column_realname');
            $data['column_group'] = $this->lang->line('column_group');

            $data['text_form'] = '商户: ' . $vendor->username;
            $data['text_default_group'] = $this->lang->line('text_default_group');

            $data['button_save'] = $this->lang->line('button_save');
            $data['button_cancel'] = $this->lang->line('button_cancel');

            $data['groups'] = $groups;

            $data['action'] = 'index.php/admin/vendor/manage/edit_vendor?vendor_id=' . $vendor_id;
            $data['cancel'] = 'index.php/admin/vendor/manage/vendor';

            $this->load->view('admin/vendor/vendor_form', $data);
            // set footer
            $this->model_footer->loadFooter();
        }
    }

    public function reset_password()
    {
        $this->form_validation->set_message('matches', ' 两次输入的密码不一致');

        $this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|max_length[16]|matches[confirm]');
        $this->form_validation->set_rules('confirm', '确认密码', 'trim|min_length[6]');

        if ($this->form_validation->run()) {
            $post = $this->input->post(null, true);

            if ($this->model_manage->reset_password($post)) {
                $json['error'] = false;
                $json['msg'] = '密码修改成功';
            } else {
                $json['error'] = true;
                $json['msg'][] = '密码修改失败';
            }
        } else {
            $errors = $this->form_validation->error_array();
            $json['error'] = true;
            foreach ($errors as $error) {
                $json['msg'][] = $error;
            }
        }

        echo json_encode($json);
    }
}
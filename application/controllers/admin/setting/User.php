<?php
/**
 * Created by SD.
 * Date: 03/12/2016
 */

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');
            $this->load->model('admin/setting/model_user');
            $this->lang->load('admin/setting/user_lang');
            $this->load->library('form_validation');
        } else {
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }
    // show the user list
    public function index()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/admin/common/dashboard'
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/admin/setting/user'
        );

        $users = $this->model_user->getUsers();

        foreach ($users as $user) {
            $data['users'][] = array(
                'id' => $user['user_id'],
                'name' => $user['username'],
                'user_group' => $user['status'],
                'edit' => 'index.php/admin/setting/user/edit?user_id=' . $user['user_id']
            );
        }
        $data['selected'] = array();
        $data['add'] = 'index.php/admin/setting/user/add';
        $data['delete'] = 'index.php/admin/setting/user/delete';
        
        $data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : null;
        $data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : null;
        $data['error_alert'] = $this->input->get('success') == 3 ? $this->lang->line('text_warning') : null;

        $data['heading_title'] = $this->lang->line('heading_title');
        $data['text_schools'] = $this->lang->line('text_schools');
        $data['text_no_results'] = $this->lang->line('text_no_results');
        $data['text_confirm'] = $this->lang->line('text_confirm');
        
        $data['column_username'] = $this->lang->line('column_username');
        $data['column_group'] = $this->lang->line('column_group');
        $data['column_edit'] = $this->lang->line('column_edit');

        $data['button_add'] = $this->lang->line('button_add');
        $data['button_delete'] = $this->lang->line('button_delete');
        
        $this->load->view('admin/setting/user', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function add()
    {
        if ($this->_checkAuthentication()) {
            // set header
            $this->model_header->loadHeader($this->lang->line('heading_title'), '');
            // set sidebar
            $this->model_column_left->loadSidebar();

            $user_id = $this->input->post('user_id', true);
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|callback_username_unique['.$user_id.']');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Your Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
//            $this->form_validation->set_rules('image', 'Image', 'trim|required');
            $this->form_validation->set_rules('user_group', 'User Group', 'trim|required');

            $this->form_validation->set_message('username_unique','Username already exists, please re-enter your username');

            if($this->form_validation->run() && $this->input->post()) { //post the changed information
                $post = $this->input->post();
                if ($this->model_user->addUser($post)) {
                    redirect('admin/setting/user?success=1');
                } else {
                    redirect('admin/setting/user/add');
                }
            } else { // render the form
                $data = $this->_form('add');

                $data['user_id'] = '';
                $data['username'] = '';
                $data['fullname'] = '';
                $data['email'] = '';
                $data['image'] = '';
                $data['user_group'] = '';
                $data['new_password'] = '';
                $data['confirm_password'] = '';

                $this->load->view('admin/setting/user_form', $data);
            }
        } else {
            redirect('admin/setting/user?success=3');
        }
    }

    private function _checkAuthentication()
    {
        if ($this->session->usergroup == 1) {
            return true;
        }
        if ($this->session->usergroup == $this->input->get('user_id')) {
            return true;
        }
        return false;
    }
    // set the form content
    private function _form($action, $user_id = '')
    {
        $data['button_save'] = $this->lang->line('button_save');
        $data['button_cancel'] = $this->lang->line('button_cancel');
        $data['action'] = 'index.php/admin/setting/user/' . $action . '?user_id=' . $user_id;
        $data['cancel'] = 'index.php/admin/setting/user';

        $data['heading_title'] = $this->lang->line('heading_title');
        $data['text_form'] = $this->lang->line('text_form_' . $action);
        $data['text_wizard'] = $this->lang->line('text_wizard');
        $data['text_muggle'] = $this->lang->line('text_muggle');

        $data['column_username'] = $this->lang->line('column_username');
        $data['column_new_password'] = $this->lang->line('column_new_password');
        $data['column_confirm_password'] = $this->lang->line('column_confirm_password');
        $data['column_fullname'] = $this->lang->line('column_fullname');
        $data['column_image'] = $this->lang->line('column_image');
        $data['column_group'] = $this->lang->line('column_group');
        $data['column_email'] = $this->lang->line('column_email');

        $data['entry_username'] = $this->lang->line('entry_username');
        $data['entry_new_password'] = $this->lang->line('entry_new_password');
        $data['entry_confirm_password'] = $this->lang->line('entry_confirm_password');
        $data['entry_fullname'] = $this->lang->line('entry_fullname');
        $data['entry_image'] = $this->lang->line('entry_image');
        $data['entry_group'] = $this->lang->line('entry_group');
        $data['entry_email'] = $this->lang->line('entry_email');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/admin/common/dashboard'
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/admin/setting/user'
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('text_' . $action),
            'href' => 'index.php/admin/setting/user/' . $action
        );

        return $data;
    }

    public function edit()
    {
        if ($this->_checkAuthentication()) {
            // set header
            $this->model_header->loadHeader($this->lang->line('heading_title'), '');
            // set sidebar
            $this->model_column_left->loadSidebar();

            $user_id = $this->input->post('user_id', true);
            $this->form_validation->set_rules('username', '用户名', 'trim|required|min_length[5]|callback_username_unique['.$user_id.']');
            $this->form_validation->set_rules('new_password', '新的密码', 'trim|required|min_length[6]|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password', '确认密码', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('fullname', '姓名', 'trim|required');
            $this->form_validation->set_rules('email', '邮件', 'trim|required|valid_email');
//            $this->form_validation->set_rules('image', 'Image', 'trim|required');
            $this->form_validation->set_rules('user_group', '用户分组', 'trim|required');

            $this->form_validation->set_message('username_unique',' 用户名已存在，请重新输入用户名');

            if($this->form_validation->run() && $this->input->post()) { //post the changed information
                $post = $this->input->post();
                if ($this->model_user->editUser($post)){
                    redirect('admin/setting/user?success=1');
                } else {
                    redirect('admin/setting/user/edit?user_id='.$user_id);
                }
            } else { // render the form
                $user_id = $this->input->get('user_id');
                $data = $this->_form('edit',$user_id);
                $user = $this->model_user->getUser($user_id);

                if (isset($user)) {
                    $data['user_id'] = $user->user_id;
                    $data['username'] = $user->username;
                    $data['fullname'] = $user->fullname;
                    $data['email'] = $user->email;
                    $data['image'] = $user->image;
                    $data['user_group'] = $user->status;
                    $data['new_password'] = '';
                    $data['confirm_password'] = '';
                }

                $this->load->view('admin/setting/user_form', $data);
            }
        } else {
            redirect('admin/setting/user?success=3');
        }
    }

    public function delete()
    {
        if ($this->_checkAuthentication()) {
            if($this->_validateDelete() && $this->input->post('selected')){
                foreach ($this->input->post('selected') as $user_id) {
                    $this->model_user->deleteUser($user_id);
                }
                redirect('admin/setting/user?success=1');
            }else{
                redirect('admin/setting/user?success=2');
            }
        } else {
            redirect('admin/setting/user?success=3');
        }
    }

    /*
     * check user group &
     * make sure the current user can not be deleted
     */
    private function _validateDelete()
    {
        if ($this->session->usergroup == 2) {
            return false;
        }
        foreach ($this->input->post('selected') as $user_id) {
            if ($this->session->user_id == $user_id) {
                return false;
            }
        }

        return true;
    }

    public function username_unique($username, $user_id)
    {
        return $this->model_user->uniqueUsername($username, $user_id);
    }
}
<?php

/**
 * Created by SD.
 * Date: 09/07/2017
 */
class Message extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');
            $this->load->model('admin/setting/model_message');
            $this->lang->load('admin/setting/message_lang');
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
        
// TODO: 短信息内容长度限制仍待确定
        $this->form_validation->set_rules('content', '内容', 'trim|required|max_length[128]');
        $this->form_validation->set_rules('user', '发送对象', 'trim|required');


        if ($this->form_validation->run() && $this->input->post()) {
            $post = $this->input->post();
            if ($this->_checkAuthentication()) {
                if ($this->model_message->sendMessage($post)) {
                    redirect('admin/setting/message?success=1');
                } else {
                    redirect('admin/setting/message?success=2');
                }
            } else {
                redirect('admin/setting/message?success=3');
            }
        } else {
            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array('text' => 'home', 'href' => 'index.php/admin/common/dashboard');

            $data['breadcrumbs'][] = array(
                'text' => $this->lang->line('heading_title'),
                'href' => 'index.php/admin/setting/message',
            );

            $data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : NULL;
            $data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : NULL;
            $data['error_alert'] = $this->input->get('success') == 3 ? $this->lang->line('text_warning') : NULL;

            $data['button_send'] = $this->lang->line('button_send');
            $data['action'] = 'index.php/admin/setting/message';

            $data['heading_title'] = $this->lang->line('heading_title');
            $data['text_form'] = $this->lang->line('text_form');
            $data['text_users'] = $this->lang->line('text_users');
            $data['text_group'] = $this->lang->line('text_group');

            $data['column_user'] = $this->lang->line('column_user');
            $data['column_content'] = $this->lang->line('column_content');
            $data['column_mode'] = $this->lang->line('column_mode');

            $data['entry_user'] = $this->lang->line('entry_user');
            $data['entry_content'] = $this->lang->line('entry_content');

            $data['tooltip_user'] = $this->lang->line('tooltip_user');

            $data['content'] = '';
            $data['mode'] = '';
            $data['user'] = '';
            
            $this->load->model('admin/vendor/model_manage');
            $data['user_groups'] = $this->model_manage->getGroups();

            $this->load->view('admin/setting/message', $data);
            // set footer
            $this->model_footer->loadFooter();
        }
    }

    private function _checkAuthentication()
    {
        if ($this->session->usergroup == 1) {
            return true;
        }

        return false;
    }
}
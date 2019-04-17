<?php

class Forgotten extends CI_Controller
{
    /**
     * 1. 检查是否已经登录，是：直接跳转到dashboard
     * 2. 获取email地址
     * 3. 验证email地址+成功\错误提醒，设置email发送内容+密码重设连接
     * 4. 返回登录页面
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('model_common');
        $this->load->model('admin/common/model_header');
        $this->load->model('admin/common/model_footer');
        $this->load->model('admin/common/model_forgotten');
        $this->load->model('admin/setting/model_setting');
        $this->lang->load('admin/common/forgotten_lang');
        $this->load->helper('url');

        if ($this->session->isLoggedIn) {
            redirect('admin/common/dashboard');
        }
    }

    public function index()
    {
        // set heaer
        $this->model_header->loadHeader();

        $this->form_validation->set_rules('email', '用户名', 'trim|required|callback_validate_email');
        $this->form_validation->set_rules('captcha', '验证码', 'trim|required|callback_check_captcha');

        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $token = $this->createToken($email);
            $url = site_url() . '/admin/common/reset?token=';
            $subject = sprintf($this->lang->line('text_subject'), $this->model_setting->get('config_name'));
            $message = sprintf($this->lang->line('text_message'), $url . $token, $url . $token);

            if ($this->model_common->email($email, $subject, $message)) {
                redirect('admin/common/login?success=1');
            } else {
                redirect('admin/common/login?success=2');
            }
        } else {
            // set content
            $data['action'] = 'index.php/admin/common/forgotten';
            $data['cancel'] = 'index.php/admin/common/login';
            
            $data['heading_title'] = $this->lang->line('heading_title');
            $data['entry_email'] = $this->lang->line('entry_email');
            $data['entry_captcha'] = $this->lang->line('entry_captcha');
            $data['button_reset'] = $this->lang->line('button_reset');
            $data['button_cancel'] = $this->lang->line('button_cancel');
            
            $this->load->view('admin/common/forgotten', $data);
        }
        // set footer
        $this->model_footer->loadFooter();
    }

    public function check_captcha($captcha)
    {
        if (isset($this->session->captcha)) {
            if (strtolower($captcha) == strtolower($this->session->captcha)) {
                return true;
            } else {
                $this->form_validation->set_message('check_captcha', $this->lang->line('error_captcha'));

                return false;
            }
        } else {
            $this->form_validation->set_message('check_captcha', $this->lang->line('error_expired_captcha'));

            return false;
        }
    }

    public function validate_email($email)
    {
        $this->form_validation->set_message('validate_email', $this->lang->line('error_no_email'));

        return $this->model_forgotten->validateEmail($email);
    }

    protected function createToken($username)
    {
        $token = md5($username . time()) . '_' . time();
        // save token in session, and set the expired time to be 1 day
        $this->session->set_tempdata($username, $token, 86400);

        return $token;
    }
}
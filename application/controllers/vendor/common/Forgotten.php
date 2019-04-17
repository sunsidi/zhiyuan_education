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
        $this->load->model('vendor/common/model_forgotten');
        $this->lang->load('vendor/common/forgotten_lang');
        $this->load->model('model_common');
        $this->load->model('admin/setting/model_setting');
        $this->load->helper('url');

        if ($this->session->vendor) {
            redirect('vendor/common/dashboard');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('username', '用户名', 'trim|required|callback_validate_username');
        $this->form_validation->set_rules('captcha', '验证码', 'trim|required|callback_check_captcha');

        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $to = $this->model_forgotten->getUserEmail($username);
            $token = $this->createToken($username);
            $url = site_url() . '/vendor/common/reset?token=';
            $subject = sprintf($this->lang->line('text_subject'), $this->model_setting->get('config_name'));
            $message = sprintf($this->lang->line('text_message'), $url.$token, $url.$token);

            if ($this->model_common->email($to, $subject, $message)) {
                $json['error'] = false;
                $json['msg'] = $this->lang->line('text_send_email');
            } else {
                $json['error'] = true;
                $json['msg'][] = $this->lang->line('text_send_fail');
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

    public function validate_username($username)
    {
        $this->form_validation->set_message('validate_username', $this->lang->line('error_no_username'));
        return $this->model_forgotten->validateUsername($username);
    }

    protected function createToken($username)
    {
        $token = md5($username.time()).'_'.time();
        // save token in session, and set the expired time to be 1 day
        $this->session->set_tempdata($username, $token, 86400);
        return $token;
    }

}
<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('vendor/common/model_header');
        $this->load->model('vendor/common/model_footer');
    }

    public function index()
    {
        if ($this->session->vendor) {
            redirect('vendor/common/dashboard');
        } else {
            redirect('catalog/common/home');
        }
    }

    public function submit()
    {
        $this->load->library('form_validation');
        $this->lang->load('vendor/common/login_lang');
        $this->load->model('vendor/common/model_login');
        // set form validation rules
        $this->form_validation->set_rules('username', '用户名', 'trim|required');
        $this->form_validation->set_rules('password', '密码', 'trim|required');
        $this->form_validation->set_rules('captcha', '验证码', 'trim|required|callback_check_captcha');

        if ($this->form_validation->run()) {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            // check username & password
            if ($username && $password) {
                if (!$this->model_login->loginVerification($username, $password)) {
                    // username & password dismatch
                    $json['error'] = true;
                    $json['msg'][] = $this->lang->line('error_dismatch');
                } else if ($this->model_login->loginVerification($username, $password)['error']) {
                    $json['error'] = $this->model_login->loginVerification($username, $password)['error'];
                    $json['msg'][] = $this->model_login->loginVerification($username, $password)['msg'];
                } else {
                    $json['url'] = 'index.php/vendor/common/dashboard';
                }
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
                $this->form_validation->set_message('check_captcha', ' 验证码错误');
                return false;
            }
        } else {
            $this->form_validation->set_message('check_captcha', ' 验证码已过期');
            return false;
        }
    }
}
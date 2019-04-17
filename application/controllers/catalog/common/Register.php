<?php
/**
 * Created by SD.
 * Date: 20/07/2017
 */
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('catalog/common/model_register');
        $this->load->model('admin/setting/model_setting');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $this->form_validation->set_message('matches', ' 两次输入的密码不一致');

        $this->form_validation->set_rules('username', '用户名', 'trim|required|alpha_numeric|min_length[6]|max_length[16]|callback_username_unique');
        $this->form_validation->set_rules('email', '邮箱', 'trim|required|valid_email');
        $this->form_validation->set_rules('telephone', '电话', 'trim|required|numeric');
        $this->form_validation->set_rules('qq', 'QQ', 'trim|required|integer');
        $this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|max_length[16]|matches[confirm]');
        $this->form_validation->set_rules('confirm', '确认密码', 'trim|min_length[6]');
        $this->form_validation->set_rules('bank', '开户行', 'trim|required');
        $this->form_validation->set_rules('bank_city', '开户行城市', 'trim|required');
        $this->form_validation->set_rules('bank_address', '开户行地址', 'trim|required');
        $this->form_validation->set_rules('account', '收款账号', 'trim|required|numeric');
        $this->form_validation->set_rules('realname', '真实姓名', 'trim|required');
        $this->form_validation->set_rules('captcha', '验证码', 'trim|required|callback_check_captcha');

        if ($this->form_validation->run()) {
            $post = $this->input->post(null, true);
            $auto_register = $this->model_setting->get('config_auto_register');
            $this->model_register->register($post, $auto_register);
            $json['error'] = false;
            $json['msg'] = '您已成功注册，请返回首页登陆';
            $this->session->unset_tempdata('captcha');
        } else {
            $errors = $this->form_validation->error_array();
            $json['error'] = true;
            foreach ($errors as $error) {
                $json['msg'][] = $error;
            }
            $this->session->unset_tempdata('captcha');
        }

        echo json_encode($json);
    }

    public function username_unique($username)
    {
        if (!$this->model_register->usernameunique($username)) {
            $this->form_validation->set_message('username_unique', ' 用户名已存在');
            return false;
        } else {
            return true;
        }
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
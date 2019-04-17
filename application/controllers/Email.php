<?php
/**
 * Created by SD.
 * Date: 02/08/2017
 * Used for the following cases:
 * Forget password
 * Sending message after successfully bought a product
 */
class Email extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');
            $this->load->model('admin/setting/model_setting');
            $this->load->library('form_validation');
            $this->load->library('email');
            $this->load->helper('url');
        } else {
            redirect('admin/common/login');
        }
    }

    public function index()
    {
        //set email configs
        $config['protocol'] = $this->model_setting->get('config_mail_protocol');
        $config['smtp_host'] = $this->model_setting->get('config_mail_smtp_hostname');
        $config['smtp_user'] = $this->model_setting->get('config_mail_smtp_username');
        $config['smtp_pass'] = $this->model_setting->get('config_mail_smtp_password');
        $config['smtp_port'] = $this->model_setting->get('config_mail_smtp_port');
        $config['smtp_timeout'] = $this->model_setting->get('config_mail_smtp_timeout');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';

        $to = 'ssd0418@163.com';
        $subject = 'test';
        $message = '<a href="http://mail.163.com/">http://mail.163.com/</a>';

        if ($this->send($config, $to, $subject, $message)) { // sending successfully
            echo 'success';
        } else { // failed to send
            echo 'fail';
        }
    }

    public function send($config, $to, $subject, $message)
    {
        $this->email->initialize($config);

        //以下设置Email内容
        $this->email->from($this->model_setting->get('config_email'), $this->model_setting->get('config_name'));
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }
}
<?php
/**
 * Created by SD.
 * Date: 16/11/2016
 */

class Setting extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if($this->session->isLoggedIn){
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');
            $this->load->model('admin/setting/model_setting');
            $this->lang->load('admin/setting/setting_lang');
            $this->load->library('form_validation');
        }else{
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }

    public function index()
    {
        $header['js'][] = 'javascript/summernote/summernote.js';
        $header['js'][] = 'javascript/summernote/lang/summernote-zh-CN.js';
        $header['css'][] = 'javascript/summernote/summernote.css';
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), $header);

        // set sidebar
        $this->model_column_left->loadSidebar();
        
        $data = $this->_form();
        
        $this->load->view('admin/setting/setting', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function edit()
    {
        $header['js'][] = 'javascript/summernote/summernote.js';
        $header['js'][] = 'javascript/summernote/lang/summernote-zh-CN.js';
        $header['css'][] = 'javascript/summernote/summernote.css';
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), $header);
        // set sidebar
        $this->model_column_left->loadSidebar();
        
        $this->form_validation->set_rules('config_name', '网站名称', 'required');
        $this->form_validation->set_rules('config_address', '地址', 'required');
        $this->form_validation->set_rules('config_email', '邮箱', 'required|valid_email');
        $this->form_validation->set_rules('config_telephone', '电话', 'required');
        $this->form_validation->set_rules('config_meta_title', 'Meta 标题', 'required');
        $this->form_validation->set_rules('config_description', '网站简介', 'required');
        $this->form_validation->set_rules('config_about', '关于我们', 'required');
        
        if ($this->form_validation->run() && $this->input->post()) {
            if ($this->model_setting->editSetting($this->input->post())) {
                redirect('admin/setting/setting?status=success');
            }
        }

        $data = $this->_form();
        $this->load->view('admin/setting/setting', $data);
        // set footer
        $this->model_footer->loadFooter();
    }
    
    private function _form()
    {
        //breadcrumbs
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/admin/common/dashboard'
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/admin/setting/setting'
        );

        //get setting from database
//        $configs = $this->model_setting->getSettings();
        $data['config_name'] = $this->model_setting->get('config_name');
        $data['config_address'] = $this->model_setting->get('config_address');
        $data['config_email'] = $this->model_setting->get('config_email');
        $data['config_telephone'] = $this->model_setting->get('config_telephone');
        $data['config_rate'] = $this->model_setting->get('config_rate');
        $data['config_logo'] = $this->model_setting->get('config_logo');
        $data['config_description'] = $this->model_setting->get('config_description');
        $data['config_about'] = $this->model_setting->get('config_about');
        $data['config_image'] = $this->model_setting->get('config_image');
        $data['placeholder'] = 'image/placeholder.png';
        $data['config_meta_title'] = $this->model_setting->get('config_meta_title');
        $data['config_meta_keyword'] = $this->model_setting->get('config_meta_keyword');
        $data['config_meta_description'] = $this->model_setting->get('config_meta_description');
        $data['config_ftp_hostname'] = $this->model_setting->get('config_ftp_hostname');
        $data['config_ftp_port'] = $this->model_setting->get('config_ftp_port');
        $data['config_ftp_username'] = $this->model_setting->get('config_ftp_username');
        $data['config_ftp_password'] = $this->model_setting->get('config_ftp_password');
        $data['config_ftp_root'] = $this->model_setting->get('config_ftp_root');
        $data['config_ftp_status'] = $this->model_setting->get('config_ftp_status');
        $data['config_mail_protocol'] = $this->model_setting->get('config_mail_protocol');
        $data['config_mail_parameter'] = $this->model_setting->get('config_mail_parameter');
        $data['config_mail_smtp_hostname'] = $this->model_setting->get('config_mail_smtp_hostname');
        $data['config_mail_smtp_username'] = $this->model_setting->get('config_mail_smtp_username');
        $data['config_mail_smtp_password'] = $this->model_setting->get('config_mail_smtp_password');
        $data['config_mail_smtp_port'] = $this->model_setting->get('config_mail_smtp_port');
        $data['config_mail_smtp_timeout'] = $this->model_setting->get('config_mail_smtp_timeout');
        $data['config_mail_alert'] = $this->model_setting->get('config_mail_alert');
        $data['config_google_captcha_public'] = $this->model_setting->get('config_google_captcha_public');
        $data['config_google_captcha_secret'] = $this->model_setting->get('config_google_captcha_secret');
        $data['config_google_analytics'] = $this->model_setting->get('config_google_analytics');
        $data['config_auto_register'] = $this->model_setting->get('config_auto_register');

        $data['action'] = 'index.php/admin/setting/setting/edit';
        $data['error_warning'] = $this->lang->line('error_warning');
        $data['success'] = $this->lang->line('text_edit_success');
        $data['heading_title'] = $this->lang->line('heading_title');
        $data['button_save'] = $this->lang->line('button_save');

        $data['text_edit'] = $this->lang->line('text_edit');
        $data['text_no'] = $this->lang->line('text_no');
        $data['text_yes'] = $this->lang->line('text_yes');
        $data['text_mail'] = $this->lang->line('text_mail');
        $data['text_smtp'] = $this->lang->line('text_smtp');
        $data['text_google_analytics'] = $this->lang->line('text_google_analytics');
        $data['text_google_captcha'] = $this->lang->line('text_google_captcha');
        $data['text_enabled'] = $this->lang->line('text_enabled');
        $data['text_disabled'] = $this->lang->line('text_disabled');

        $data['tab_general'] = $this->lang->line('tab_general');
        $data['tab_meta'] = $this->lang->line('tab_meta');
        $data['tab_ftp'] = $this->lang->line('tab_ftp');
        $data['tab_mail'] = $this->lang->line('tab_mail');
        $data['tab_google'] = $this->lang->line('tab_google');
        // general
        $data['entry_name'] = $this->lang->line('entry_name');
        $data['entry_address'] = $this->lang->line('entry_address');
        $data['entry_email'] = $this->lang->line('entry_email');
        $data['entry_telephone'] = $this->lang->line('entry_telephone');
        $data['entry_rate'] = $this->lang->line('entry_rate');
        $data['entry_image'] = $this->lang->line('entry_image');
        $data['entry_about'] = $this->lang->line('entry_about');
        $data['entry_description'] = $this->lang->line('entry_description');
        $data['entry_auto_register'] = $this->lang->line('entry_auto_register');
        // meta
        $data['entry_meta_title'] = $this->lang->line('entry_meta_title');
        $data['entry_meta_keyword'] = $this->lang->line('entry_meta_keyword');
        $data['entry_meta_description'] = $this->lang->line('entry_meta_description');
        // mail
        $data['entry_mail_protocol'] = $this->lang->line('entry_mail_protocol');
        $data['entry_mail_parameter'] = $this->lang->line('entry_mail_parameter');
        $data['entry_mail_smtp_hostname'] = $this->lang->line('entry_mail_smtp_hostname');
        $data['entry_mail_smtp_username'] = $this->lang->line('entry_mail_smtp_username');
        $data['entry_mail_smtp_password'] = $this->lang->line('entry_mail_smtp_password');
        $data['entry_mail_smtp_port'] = $this->lang->line('entry_mail_smtp_port');
        $data['entry_mail_smtp_timeout'] = $this->lang->line('entry_mail_smtp_timeout');
        $data['entry_mail_alert'] = $this->lang->line('entry_mail_alert');
        $data['entry_status'] = $this->lang->line('entry_status');

        $data['help_mail_protocol'] = $this->lang->line('help_mail_protocol');
        $data['help_mail_parameter'] = $this->lang->line('help_mail_parameter');
        $data['help_mail_alert'] = $this->lang->line('help_mail_alert');

        return $data;
    }
    
}
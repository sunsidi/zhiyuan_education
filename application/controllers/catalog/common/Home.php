<?php

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('catalog/common/model_header');
        $this->load->model('catalog/common/model_footer');
        $this->load->model('admin/setting/model_setting');
        $this->load->model('admin/setting/model_announcement');
        $this->lang->load('catalog/common/home_lang');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = $this->model_setting->get('config_name');
        $data['base'] = base_url();
        // getFAQs($start, $limit, $show_on_index)
        $data['faqs'] = $this->model_announcement->getFAQs(0, 3, 1);

        $data['config_logo'] = $this->model_setting->get('config_logo');
        $data['config_fax'] = $this->model_setting->get('config_fax');
        $data['config_email'] = $this->model_setting->get('config_email');
        $data['config_telephone'] = $this->model_setting->get('config_telephone');
        $data['config_qq'] = $this->model_setting->get('config_qq');
        $data['config_address'] = $this->model_setting->get('config_address');
        $data['config_description'] = $this->model_setting->get('config_description');
        $data['config_about'] = $this->model_setting->get('config_about');

        // register
        $data['column_username'] = $this->lang->line('column_username');
        $data['column_email'] = $this->lang->line('column_email');
        $data['column_telephone'] = $this->lang->line('column_telephone');
        $data['column_qq'] = $this->lang->line('column_qq');
        $data['column_password'] = $this->lang->line('column_password');
        $data['column_confirm'] = $this->lang->line('column_confirm');
        $data['column_bank'] = $this->lang->line('column_bank');
        $data['column_bank_city'] = $this->lang->line('column_bank_city');
        $data['column_bank_address'] = $this->lang->line('column_bank_address');
        $data['column_account'] = $this->lang->line('column_account');
        $data['column_realname'] = $this->lang->line('column_realname');
        $data['column_captcha'] = $this->lang->line('column_captcha');

        $data['entry_username'] = $this->lang->line('entry_username');
        $data['entry_email'] = $this->lang->line('entry_email');
        $data['entry_telephone'] = $this->lang->line('entry_telephone');
        $data['entry_qq'] = $this->lang->line('entry_qq');
        $data['entry_password'] = $this->lang->line('entry_password');
        $data['entry_confirm'] = $this->lang->line('entry_confirm');
        $data['entry_bank'] = $this->lang->line('entry_bank');
        $data['entry_bank_city'] = $this->lang->line('entry_bank_city');
        $data['entry_bank_address'] = $this->lang->line('entry_bank_address');
        $data['entry_account'] = $this->lang->line('entry_account');
        $data['entry_realname'] = $this->lang->line('entry_realname');
        $data['entry_captcha'] = $this->lang->line('entry_captcha');


        $data['email'] = 'index.php/catalog/common/home/email';
        $data['register'] = 'index.php/catalog/common/register';
        $data['login'] = 'index.php/vendor/common/login/submit';
        $data['forgotten'] = 'index.php/vendor/common/forgotten';

        if ($this->session->vendor) {
            $data['logged_in'] = true;
            $data['fullname'] = $this->session->vendor['username'];
            $data['vendor_url'] = $this->config->item('vendor_url');
        } else {
            $data['logged_in'] = false;
        }

        $data['text_footer'] = sprintf($this->lang->line('text_footer'), base_url(), $this->model_setting->get('config_name'));

        $this->load->view('catalog/common/home', $data);
    }

    public function email()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', '姓名', 'trim|required');
        $this->form_validation->set_rules('email', '邮箱', 'trim|required');
        $this->form_validation->set_rules('message', '内容', 'trim|required');

        if ($this->form_validation->run() && $this->input->post()) {
            $this->load->library('email');
            $post = $this->input->post();

            $this->email->from($post['email'], $post['name']);
            $this->email->to($this->model_setting->get('config_email'));

            $this->email->subject($post['subject']);
            $this->email->message($post['message']);

            $this->email->send();
        }

    }

    public function captcha()
    {
        $this->load->helper('captcha');

        $vals = array(
            'word_length' => 4,
            'img_width' => 100,
            'img_height' => 30,
        );

        $captcha = create_captcha($vals);
        $this->session->set_tempdata('captcha', $captcha, 120);
    }
}
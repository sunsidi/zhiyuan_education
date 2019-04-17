<?php

/**
 * Created by SD.
 * Date: 11/07/2017
 */
class Model_common extends CI_Model
{
    // this is used to set the default bootstrap pagination css style
    public function setPagination($setting)
    {
        $this->load->library('pagination');

        $config['base_url'] = $setting['base_url'];
        $config['total_rows'] = $setting['total'];
        $config['per_page'] = $setting['per_page'];
        // $config['uri_segment'] = 5;
        $config['num_links'] = 2;
        $config['use_page_numbers'] = true;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['next_link'] = '下一页';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '上一页';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_link'] = '首页';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '尾页';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        return $config;
    }

    public function email($to, $subject, $message)
    {
        $this->load->model('admin/setting/model_setting');
        $this->load->library('email');
        
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

        $this->email->initialize($config);

        //set the email content
        $this->email->from($this->model_setting->get('config_email'), $this->model_setting->get('config_name'));
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }
}
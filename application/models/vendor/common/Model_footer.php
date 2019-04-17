<?php

class Model_footer extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('admin/setting/model_setting');
        $this->lang->load('admin/common/footer_lang');
    }

    public function loadFooter()
    {
        $data['text_footer'] = sprintf($this->lang->line('text_footer'), base_url() . "index.php/admin/common/dashboard", $this->model_setting->get('config_name'));
        $data['text_version'] = $this->config->item('version');
        $this->load->view('admin/common/footer', $data);
    }
}
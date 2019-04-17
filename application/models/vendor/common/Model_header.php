<?php

class Model_header extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function getHeader($title, $data)
    {
        $header['title'] = $title;
        $header['base'] = base_url();
        $header['home'] = $this->config->item('catalog_url');
        $header['logged'] = $this->session->vendor ? true : false;
        $header['logout'] = 'index.php/vendor/common/logout';
        $header['new_resume'] = '';
        $header['alerts'] = 0;

        if (isset($data['description'])) {
            $header['description'] = $data['description'];
        } else {
            $header['description'] = '';
        }
        if (isset($data['keywords'])) {
            $header['keywords'] = $data['keywords'];
        } else {
            $header['keywords'] = '';
        }
        if (isset($data['js'])) {
            foreach ($data['js'] as $script) {
                $header['scripts'][] = $script;
            }
        } else {
            $header['scripts'] = '';
        }
        if (isset($data['css'])) {
            foreach ($data['css'] as $style) {
                $header['styles'][] = $style;
            }
        } else {
            $header['styles'] = '';
        }

        return $header;
    }

    public function loadHeader($title = '', $data = array())
    {
        // set header
        $header = $this->getHeader($title, $data);
        $this->load->view('vendor/common/header', $header);
    }
}
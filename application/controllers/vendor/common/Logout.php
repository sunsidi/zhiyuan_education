<?php

/**
 * Created by SD.
 * Date: 11/11/2016
 */
class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index()
    {
        unset($_SESSION['vendor']);
        $this->session->unset_tempdata('vendor');
        redirect('catalog/common/home');
    }
}
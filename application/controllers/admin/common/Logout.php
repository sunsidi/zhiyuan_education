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
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['usergroup']);
        unset($_SESSION['image']);
        unset($_SESSION['fullname']);
        unset($_SESSION['isLoggedIn']);

        $this->session->unset_tempdata('user_id');
        $this->session->unset_tempdata('username');
        $this->session->unset_tempdata('usergroup');
        $this->session->unset_tempdata('image');
        $this->session->unset_tempdata('fullname');
        $this->session->unset_tempdata('isLoggedIn');
        
        redirect('admin/common/login');
    }
}
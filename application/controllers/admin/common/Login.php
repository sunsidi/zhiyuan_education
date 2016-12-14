<?php
class Login extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('admin/common/model_header');
		$this->load->model('admin/common/model_footer');
	}
	
	public function index($msg = null)
	{
		if($this->session->isLoggedIn){
			redirect('admin/common/dashboard');
		}else{
			// set heaer
			$this->model_header->loadHeader();

			// set content
			$data['action'] = 'index.php/admin/common/login/submit';
			$data['forgotten'] = 'index.php/admin/common/forgotten';
			$data['redirect'] = 'index.php/admin/common/Submit';

			$this->lang->load('admin/common/login_lang');
			$data['entry_username'] = $this->lang->line('entry_username');
			$data['entry_password'] = $this->lang->line('entry_password');
			$data['text_login'] = $this->lang->line('text_login');
			$data['text_forgotten'] = $this->lang->line('text_forgotten');
			$data['button_login'] = $this->lang->line('button_login');
			$data['error_warning'] = $msg['error_warning'];
			$this->load->view('admin/common/login', $data);

			// set footer
			$this->model_footer->loadFooter();
		}
	}

	public function submit()
	{
		$this->load->library('form_validation');
		$this->lang->load('admin/common/login_lang');
		$this->load->model('admin/common/model_login');
		// set form validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == false) {
			$error['error_warning'] = $this->lang->line('error_warning');
			$this->index($error);
		}else{
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);
			// check username&password
			if($username && $password){
				if($this->model_login->loginVerification($username, $password)){
					redirect('admin/common/dashboard');
				}else{
					$error['error_warning'] = $this->lang->line('error_dismatch');
					$this->index($error);
				}
			}
		}
	}
}
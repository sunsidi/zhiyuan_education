<?php
class School extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if($this->session->isLoggedIn){
			$this->load->model('admin/common/model_header');
			$this->load->model('admin/common/model_footer');
			$this->load->model('admin/common/model_column_left');
			$this->load->model('admin/recruitment/model_school');
			$this->lang->load('admin/recruitment/school_lang');
			$this->load->library('form_validation');
		}else{
			$this->load->helper('url');
			redirect('admin/common/login');
		}
	}

	public function index()
	{
		// set header
		$this->model_header->loadHeader();

		// set sidebar
		$this->model_column_left->loadSidebar();

		$order = $this->input->get('order');
		$schools = $this->model_school->getSchoolList($order);
		foreach($schools as $school){
			$data['schools'][]= array(
			'id' => $school['id'],
			'name' => $school['name'],
			'edit' => 'index.php/admin/recruitment/school/edit?school_id=' . $school['id']);
		}
		$data['selected'] = array();
		$data['order'] = $order;
		if($order == 'ASC'){
			$order = 'DESC';
		}else if($order == 'DESC'){
			$order = 'ASC';
		}else{
			$order = 'DESC';
		}
		$data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : null;
		$data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : null;
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['text_schools'] = $this->lang->line('text_schools');
		$data['text_no_results'] = $this->lang->line('text_no_results');
		$data['text_confirm'] = $this->lang->line('text_confirm');
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['column_school'] = $this->lang->line('column_school');
		$data['column_edit'] = $this->lang->line('column_edit');
		$data['button_add'] = $this->lang->line('button_add');
		$data['button_delete'] = $this->lang->line('button_delete');
		$data['add'] = 'index.php/admin/recruitment/school/add';
		$data['delete'] = 'index.php/admin/recruitment/school/delete';
		$data['sort_name'] = 'index.php/admin/recruitment/school?order='.$order;

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'home',
			'href' => 'index.php/admin/common/dashboard'
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => 'index.php/admin/recruitment/school'
		);

		$this->load->view('admin/recruitment/school', $data);

		// set footer
		$this->model_footer->loadFooter();
	}

	private function _form($action)
	{
		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['action'] = 'index.php/admin/recruitment/school/' . $action;
		$data['cancel'] = 'index.php/admin/recruitment/school';
		
		$data['text_add'] = $this->lang->line('heading_title');
		$data['text_form'] = $this->lang->line('text_'.$action);

		$data['column_name'] = $this->lang->line('column_name');
		$data['column_description'] = $this->lang->line('column_description');
		$data['column_address'] = $this->lang->line('column_address');
		$data['column_website'] = $this->lang->line('column_website');
		$data['column_tel'] = $this->lang->line('column_tel');
		$data['column_email'] = $this->lang->line('column_email');

		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_description'] = $this->lang->line('entry_description');
		$data['entry_address'] = $this->lang->line('entry_address');
		$data['entry_website'] = $this->lang->line('entry_website');
		$data['entry_tel'] = $this->lang->line('entry_tel');
		$data['entry_email'] = $this->lang->line('entry_email');

		$school_id = $this->input->get('school_id');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'home',
			'href' => 'index.php/admin/common/dashboard'
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => 'index.php/admin/recruitment/school'
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_' . $action),
			'href' => 'index.php/admin/recruitment/school/' . $action . '?school_id=' . $school_id
		);

		return $data;
	}

	public function add()
	{
		$header['js'][] = 'javascript/summernote/summernote.js';
		$header['css'][] = 'javascript/summernote/summernote.css';
		// set header
		$this->model_header->loadHeader('Zhiyuan Education', $header);
		// set sidebar
		$this->model_column_left->loadSidebar();

		$this->form_validation->set_rules('name', 'School Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');

		if($this->form_validation->run() && $this->input->post()){
			$post = $this->input->post();
			$this->model_school->addNewSchool($post);
			redirect('admin/recruitment/school?success=1');
		}else{
			$data = $this->_form('add');

			$data['school_id'] = '';
			$data['name'] = '';
			$data['description'] = '';
			$data['address'] = '';
			$data['website'] = '';
			$data['tel'] = '';
			$data['email'] = '';

			$this->load->view('admin/recruitment/school_form', $data);
		}

		// set footer
		$this->model_footer->loadFooter();
	}

	public function edit()
	{
		$header['js'][] = 'javascript/summernote/summernote.js';
		$header['css'][] = 'javascript/summernote/summernote.css';
		// set header
		$this->model_header->loadHeader('Zhiyuan Education', $header);
		// set sidebar
		$this->model_column_left->loadSidebar();

		$this->form_validation->set_rules('name', 'School Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');

		if($this->form_validation->run() && $this->input->post()) { //post the changed information
			$post = $this->input->post();
			$this->model_school->editSchool($post);
			redirect('admin/recruitment/school?success=1');
		} else { // redner the form
			$data = $this->_form('edit');

			$school_id = $this->input->get('school_id');
			$school = $this->model_school->getSchool($school_id);

			$data['school_id'] = $school_id;
			$data['name'] = $school['name'];
			$data['description'] = $school['description'];
			$data['address'] = $school['address'];
			$data['website'] = $school['website'];
			$data['tel'] = $school['tel'];
			$data['email'] = $school['email'];

			$this->load->view('admin/recruitment/school_form', $data);
		}
	}

	public function delete()
	{
		if($this->_validateDelete() && $this->input->post('selected')){
			foreach ($this->input->post('selected') as $school_id) {
				$this->model_school->deleteSchool($school_id);
			}
			redirect('admin/recruitment/school?success=1');
		}else{
			redirect('admin/recruitment/school?success=2');
		}
	}

	private function _validateDelete()
	{
		foreach ($this->input->post('selected') as $school_id) 
		{
			if(!$this->model_school->validateDelete($school_id)){
				return false;
			}
		}
		return true;
	}
}
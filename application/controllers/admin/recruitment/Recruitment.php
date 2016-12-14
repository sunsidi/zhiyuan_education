<?php
class Recruitment extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if($this->session->isLoggedIn){
			$this->load->model('admin/common/model_header');
			$this->load->model('admin/common/model_footer');
			$this->load->model('admin/common/model_column_left');
			$this->load->model('admin/recruitment/model_recruitment');
			$this->load->model('admin/recruitment/model_school');
			$this->lang->load('admin/recruitment/recruitment_lang');
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'home',
			'href' => 'index.php/admin/common/dashboard'
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => 'index.php/admin/recruitment/recruitment'
		);

		$order = $this->input->get('order');
		$schools = $this->model_school->getSchoolList($order);

		foreach($schools as $school){
			$data['schools'][]= array(
				'id' => $school['id'],
				'name' => $school['name'],
				'num' => $this->model_recruitment->getRecruitmentNum($school['id']),
				'view' => 'index.php/admin/recruitment/recruitment/view?school_id=' . $school['id']
			);
		}

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
		$data['column_school'] = $this->lang->line('column_school');
		$data['column_number'] = $this->lang->line('column_number');
		$data['column_view'] = $this->lang->line('column_view');

		$data['sort_name'] = 'index.php/admin/recruitment/recruitment?order='.$order;

		$this->load->view('admin/recruitment/recruitment', $data);

		// set footer
		$this->model_footer->loadFooter();
	}

	public function view()
	{
		// set header
		$this->model_header->loadHeader();
		// set sidebar
		$this->model_column_left->loadSidebar();
        // load the date helper
        $this->load->helper('date');

		$school_id = $this->input->get('school_id');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'home',
			'href' => 'index.php/admin/common/dashboard'
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => 'index.php/admin/recruitment/recruitment'
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_jobs'),
			'href' => 'index.php/admin/recruitment/recruitment/view?school_id=' . $school_id
		);

		$order = $this->input->get('order');
		$data['order'] = $order;

		$jobs = $this->model_recruitment->getJobs($school_id, $order);

		if($order == 'ASC'){
			$order = 'DESC';
		}else if($order == 'DESC'){
			$order = 'ASC';
		}else{
			$order = 'DESC';
		}

		foreach($jobs as $job){
			$data['jobs'][]= array(
				'id'    => $job['id'],
				'title' => $job['title'],
				'type'  => $job['type'] == 1 ? 'Full-time' : 'Part-time',
                'status'=> $job['status'] == 1 ? 'Enable' : 'Disabled',
				'edit'  => 'index.php/admin/recruitment/recruitment/edit?school_id=' .$school_id. '&id=' . $job['id'],
                'class' => $job['status'] == 1 ? 'success' : 'danger',
                'expired'  => strtotime($job['endtime']) <= now() ? false : true
			);
		}
        $data['selected'] = array();
		$data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : null;
		$data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : null;
		$data['heading_title'] = $this->lang->line('heading_title');
		$data['text_jobs'] = $this->lang->line('text_jobs');
		$data['text_no_results'] = $this->lang->line('text_no_results');
		$data['text_confirm'] = $this->lang->line('text_confirm');
		$data['column_job'] = $this->lang->line('column_job');
		$data['column_type'] = $this->lang->line('column_type');
        $data['column_status'] = $this->lang->line('column_status');
		$data['column_edit'] = $this->lang->line('column_edit');
        $data['column_expired'] = $this->lang->line('column_expired');
		$data['button_add'] = $this->lang->line('button_add');
		$data['button_delete'] = $this->lang->line('button_delete');

		$data['add'] = 'index.php/admin/recruitment/recruitment/add?school_id='.$school_id;
		$data['delete'] = 'index.php/admin/recruitment/recruitment/delete';
		$data['sort_name'] = 'index.php/admin/recruitment/recruitment/view?school_id='.$school_id.'&order='.$order;

		$this->load->view('admin/recruitment/recruitment_list', $data);

		// set footer
		$this->model_footer->loadFooter();
	}

	public function add()
	{
		$header['js'][] = 'javascript/summernote/summernote.js';
		$header['css'][] = 'javascript/summernote/summernote.css';
		// set header
		$this->model_header->loadHeader('Zhiyuan Education', $header);
		// set sidebar
		$this->model_column_left->loadSidebar();
        // set the form validation rules
		$this->form_validation->set_rules('title', 'Recruitment Title', 'required');
		$this->form_validation->set_rules('type', 'Recruitment Type', 'required');
		$this->form_validation->set_rules('description', 'Recruitment Description', 'required');
		$this->form_validation->set_rules('requirements', 'Recruitment Requirements', 'required');
		$this->form_validation->set_rules('benefits', 'Recruitment benefits', 'required');
        $this->form_validation->set_rules('contact', 'Contact Information', 'required');
        $this->form_validation->set_rules('endtime', 'End Time', 'required');

		if($this->form_validation->run() && $this->input->post()){//add new job
			$post = $this->input->post();
			$this->model_recruitment->addNewRecruitment($post);
			redirect('admin/recruitment/recruitment/view?school_id='.$post['school_id'].'success=1');
		}else{// render the form
			$data = $this->_form('add');

            $data['school_id'] = $this->input->get('school_id');
			$data['recruitment_id'] = '';
            $data['title'] = '';
			$data['type'] = '';
			$data['description'] = '';
			$data['requirements'] = '';
			$data['contact'] = '';
			$data['benefits'] = '';
            $data['endtime'] = '';
            $data['status'] = '';

			$this->load->view('admin/recruitment/recruitment_form', $data);
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

        $this->form_validation->set_rules('title', 'Recruitment Title', 'required');
        $this->form_validation->set_rules('type', 'Recruitment Type', 'required');
        $this->form_validation->set_rules('description', 'Recruitment Description', 'required');
        $this->form_validation->set_rules('requirements', 'Recruitment Requirements', 'required');
        $this->form_validation->set_rules('benefits', 'Recruitment benefits', 'required');
        $this->form_validation->set_rules('contact', 'Contact Information', 'required');
        $this->form_validation->set_rules('endtime', 'End Time', 'required');

		if($this->form_validation->run() && $this->input->post()) { //post the changed information
			$post = $this->input->post();
			$this->model_recruitment->editJob($post);
			redirect('admin/recruitment/recruitment/view?school_id='.$post['school_id'].'&success=1');
		} else { // render the form
			$data = $this->_form('edit');

			$job_id = $this->input->get('id');
			$job = $this->model_recruitment->getJob($job_id);

            $data['school_id'] = $job->school_id;
            $data['recruitment_id'] = $job->id;
            $data['title'] = $job->title;
            $data['type'] = $job->type;
            $data['description'] = $job->description;
            $data['requirements'] = $job->requirements;
            $data['contact'] = $job->contact;
            $data['benefits'] = $job->benefits;
            $data['endtime'] = date('Y-m-d',strtotime($job->endtime));
            $data['status'] = $job->status;

			$this->load->view('admin/recruitment/recruitment_form', $data);
		}
	}

	public function delete()
	{
		if($this->_validateDelete() && $this->input->post('selected')){
			foreach ($this->input->post('selected') as $job_id) {
				$this->model_recruitment->deleteJob($job_id);
			}
			redirect('admin/recruitment/recruitment/view?success=1');
		}else{
			redirect('admin/recruitment/recruitment/view?success=2');
		}
	}

	private function _form($action)
	{
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		if (isset($this->error['description'])) {
			$data['error_description'] = $this->error['description'];
		} else {
			$data['error_description'] = '';
		}
		if (isset($this->error['address'])) {
			$data['error_address'] = $this->error['address'];
		} else {
			$data['error_address'] = '';
		}

        $school_id = $this->input->get('school_id');

		$data['button_save'] = $this->lang->line('button_save');
		$data['button_cancel'] = $this->lang->line('button_cancel');
		$data['action'] = 'index.php/admin/recruitment/recruitment/' . $action;
		$data['cancel'] = 'index.php/admin/recruitment/recruitment/view?school_id=' . $school_id;
		
		$data['text_add'] = $this->lang->line('heading_title');
		$data['text_form'] = $this->lang->line('text_' . $action);

		$data['column_name'] = $this->lang->line('column_name');
		$data['column_description'] = $this->lang->line('column_description');
		$data['column_requirements'] = $this->lang->line('column_requirements');
		$data['column_benefits'] = $this->lang->line('column_benefits');
		$data['column_contact'] = $this->lang->line('column_contact');
		$data['column_type'] = $this->lang->line('column_type');
        $data['column_status'] = $this->lang->line('column_status');
		$data['column_full_time'] = $this->lang->line('column_full_time');
		$data['column_part_time'] = $this->lang->line('column_part_time');
        $data['column_active'] = $this->lang->line('column_active');
        $data['column_deactive'] = $this->lang->line('column_deactive');
        $data['column_time'] = $this->lang->line('column_time');

		$data['entry_name'] = $this->lang->line('entry_name');
		$data['entry_description'] = $this->lang->line('entry_description');
		$data['entry_requirements'] = $this->lang->line('entry_requirements');
		$data['entry_benefits'] = $this->lang->line('entry_benefits');
		$data['entry_contact'] = $this->lang->line('entry_contact');
		$data['entry_type'] = $this->lang->line('entry_type');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'home',
			'href' => 'index.php/admin/common/dashboard'
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('heading_title'),
			'href' => 'index.php/admin/recruitment/recruitment'
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_jobs'),
			'href' => 'index.php/admin/recruitment/recruitment/view?school_id=' . $school_id
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->lang->line('text_' . $action),
			'href' => 'index.php/admin/recruitment/recruitment/' . $action . '?school_id=' . $school_id . '&id=' . $this->input->get('id')
		);

		return $data;
	}
    // check if someone has already applied this job
    // if does, show the warning
	private function _validateDelete()
	{
//		foreach ($this->input->post('selected') as $school_id)
//		{
//			if(!$this->model_school->validateDelete($school_id)){
//				return false;
//			}
//		}
		return true;
	}
}
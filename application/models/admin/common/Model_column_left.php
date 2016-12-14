<?php
class Model_column_left extends CI_Model{
	public function __construct(){
		$this->load->model('admin/setting/model_user');
		$this->load->library('session');
		$this->lang->load('admin/common/column_left_lang');
	}
	public function loadSidebar(){

        $sidebar['image'] = $this->session->image;
        $sidebar['fullname'] = $this->session->fullname;
        if($this->session->usergroup == 1){
            $sidebar['user_group'] = 'Wizard!';
        }else{
            $sidebar['user_group'] = 'Muggle';
        }

		// root selections
		$sidebar['home'] = 'index.php/admin/common/dashboard';
		$sidebar['text_dashboard'] = $this->lang->line('text_dashboard');
		$sidebar['text_recruitment'] = $this->lang->line('text_recruitment');
		$sidebar['text_content_management'] = $this->lang->line('text_content_management');
		$sidebar['text_applications'] = $this->lang->line('text_applications');
		$sidebar['text_message'] = $this->lang->line('text_message');
		$sidebar['text_print'] = $this->lang->line('text_print');
		$sidebar['text_setting'] = $this->lang->line('text_setting');

		// sub selections
		$sidebar['text_add_school'] = $this->lang->line('text_add_school');
		$sidebar['text_add_job'] = $this->lang->line('text_add_job');
		$sidebar['text_job_list'] = $this->lang->line('text_job_list');
		$sidebar['text_website'] = $this->lang->line('text_website');
		$sidebar['text_user'] = $this->lang->line('text_user');
		$sidebar['text_faq'] = $this->lang->line('text_faq');
        $sidebar['text_slideshow'] = $this->lang->line('text_slideshow');

		$sidebar['add_job'] = 'index.php/admin/recruitment/recruitment';
		$sidebar['add_school'] = 'index.php/admin/recruitment/school';
		$sidebar['setting_edit'] = 'index.php/admin/setting/setting';
		$sidebar['user_edit'] = 'index.php/admin/setting/user';
        $sidebar['faq'] = 'index.php/admin/cms/faq';
        $sidebar['slideshow'] = 'index.php/admin/cms/slideshow';

		$this->load->view('admin/common/column_left', $sidebar);
	}
}
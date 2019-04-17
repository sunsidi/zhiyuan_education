<?php
class Model_column_left extends CI_Model{
	public function __construct(){
		$this->load->model('admin/rbac/model_user');
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

		// root menus
		$sidebar['home'] = 'index.php/admin/common/dashboard';
		$sidebar['text_dashboard'] = $this->lang->line('text_dashboard');
		$sidebar['text_stats'] = $this->lang->line('text_stats');
		$sidebar['text_company'] = $this->lang->line('text_company');
        $sidebar['text_server'] = $this->lang->line('text_server');
        $sidebar['text_rbac'] = $this->lang->line('text_rbac');
        $sidebar['text_log'] = $this->lang->line('text_log');

		// stats
        $sidebar['text_company_stats'] = $this->lang->line('text_company_stats');
        $sidebar['text_exchange_stats'] = $this->lang->line('text_exchange_stats');

        // rbac
        $sidebar['text_user'] = $this->lang->line('text_user');
        $sidebar['text_role'] = $this->lang->line('text_role');
		
		// stats link
		$sidebar['company_stats'] = 'index.php/admin/stats/company';
		$sidebar['exchange_stats'] = 'index.php/admin/stats/exchange';

		// rbac link
        $sidebar['user'] = 'index.php/admin/rbac/user';
        $sidebar['role'] = 'index.php/admin/rbac/role';

		// log link
        $sidebar['log'] = 'index.php/admin/log/log';

		$this->load->view('admin/common/column_left', $sidebar);
	}
}
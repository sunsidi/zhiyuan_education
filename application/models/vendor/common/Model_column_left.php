<?php
class Model_column_left extends CI_Model{
	public function __construct(){
		$this->load->library('session');
		$this->lang->load('vendor/common/column_left_lang');
	}
	public function loadSidebar(){

        $sidebar['image'] = $this->session->vendor['image'];
        $sidebar['fullname'] = $this->session->vendor['username'];
        if($this->session->verndor['usergroup'] == 1){
            $sidebar['user_group'] = $this->lang->line('text_super_admin');
        }else{
            $sidebar['user_group'] = $this->lang->line('text_admin');
        }

		// root menus
		$sidebar['home'] = 'index.php/vendor/common/dashboard';
		$sidebar['text_dashboard'] = $this->lang->line('text_dashboard');
		$sidebar['text_account'] = $this->lang->line('text_account');
		$sidebar['text_product'] = $this->lang->line('text_product');
		$sidebar['text_transaction'] = $this->lang->line('text_transaction');
		$sidebar['text_information'] = $this->lang->line('text_information');

		// account sub-menus
		$sidebar['text_account_setting'] = $this->lang->line('text_account_setting');
		$sidebar['text_account_password'] = $this->lang->line('text_account_password');
		$sidebar['text_cash'] = $this->lang->line('text_cash');

		// product sub-menus
		$sidebar['text_category'] = $this->lang->line('text_category');
		$sidebar['text_product'] = $this->lang->line('text_product');
		$sidebar['text_secret'] = $this->lang->line('text_secret');
		$sidebar['text_secret_upload'] = $this->lang->line('text_secret_upload');

		// transaction sub-menus
		$sidebar['text_order'] = $this->lang->line('text_order');
		$sidebar['text_statics'] = $this->lang->line('text_statics');

		// information sub-menus
		$sidebar['text_announcement'] = $this->lang->line('text_announcement');
		$sidebar['text_faq'] = $this->lang->line('text_faq');
		$sidebar['text_message'] = $this->lang->line('text_message');

		// account sub-menus links
		$sidebar['account_setting'] = 'index.php/vendor/account/account';
		$sidebar['account_password'] = 'index.php/vendor/account/account/password';
		$sidebar['cash'] = 'index.php/vendor/account/cash';

		// product sub-menus links
		$sidebar['category'] = 'index.php/vendor/product/category';
		$sidebar['product'] = 'index.php/vendor/product/product';
		$sidebar['secret'] = 'index.php/vendor/product/secret';
		$sidebar['secret_upload'] = 'index.php/vendor/product/secret/upload';

		// transaction sub-menus links
		$sidebar['order'] = 'index.php/vendor/transaction/order';
		$sidebar['statics'] = 'index.php/vendor/transaction/statics';

		// information sub-menus links
		$sidebar['announcement'] = 'index.php/vendor/information/announcement';
		$sidebar['faq'] = 'index.php/vendor/information/faq';
		$sidebar['message'] = 'index.php/vendor/information/message';

		$this->load->view('vendor/common/column_left', $sidebar);
	}
}
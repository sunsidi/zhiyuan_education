<?php 
class Model_footer extends CI_Model{

	 public function loadFooter()
	 {
		$this->lang->load('admin/common/footer_lang');
		$data['text_footer'] = $this->lang->line('text_footer');
		$data['text_version'] = $this->lang->line('text_version');
		$this->load->view('admin/common/footer', $data);
	 }
}
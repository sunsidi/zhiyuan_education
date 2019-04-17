<?php
/**
 * Created by SD.
 * Date: 07/12/2016
 */
class Model_footer extends CI_Model
{
    public function loadFooter()
    {
        $this->lang->load('catalog/common/footer_lang');
        
        $data['text_copyright'] = $this->lang->line('text_copyright');
        $data['text_privacy'] = $this->lang->line('text_privacy');
        $data['text_subscribe'] = $this->lang->line('text_subscribe');
        $data['text_term'] = $this->lang->line('text_term');

        $data['privacy'] = '';
        $data['subscribe'] = '';
        $data['term'] = '';
        $this->load->view('catalog/common/footer', $data);
    }
}
<?php
/*
 * Created by SSD
 * Date: 04/15/2019
 */
class Exchange extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');
            $this->load->model('admin/stats/model_exchange');
            $this->lang->load('admin/stats/exchange_lang');
            $this->load->library('form_validation');
        } else {
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }

    public function index()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data = $this->_getList('exchange');

        $this->load->view('admin/stats/exchange', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    private function _getList()
    {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array('text' => 'home', 'href' => 'index.php/admin/common/dashboard');

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/admin/stats/exchange',
        );

//        $list = $this->model_announcement->getAll($type);
//        $priorities = $this->model_announcement->getPriorities();
//
//        switch ($type) {
//            case 'wiki':
//                foreach ($list as $row) {
//                    $data['list'][] = array(
//                        'id'     => $row['id'],
//                        'title'  => $row['title'],
//                        'status' => $row['status'] == 1 ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
//                        'code'   => $priorities[$row['priority'] - 1]['code'],
//                        'edit'   => 'index.php/admin/setting/announcement/edit?id=' . $row['id'] . '&type=' . $type,
//                    );
//                }
//                break;
//            case 'faq':
//                foreach ($list as $row) {
//                    $data['list'][] = array(
//                        'id'     => $row['id'],
//                        'title'  => $row['question'],
//                        'status' => $row['status'] == 1 ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
//                        'code'   => '',
//                        'edit'   => 'index.php/admin/setting/announcement/edit?id=' . $row['id'] . '&type=' . $type,
//                    );
//                }
//                break;
//        }


        $data['selected'] = array();
        $data['query'] = 'index.php/admin/stats/exchange/query?';

        $data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : NULL;
        $data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : NULL;
        $data['error_alert'] = $this->input->get('success') == 3 ? $this->lang->line('text_warning') : NULL;
        $data['error_alert'] = $this->input->get('success') == 4 ? $this->lang->line('text_tag') : NULL;

        $data['heading_title'] = $this->lang->line('heading_title');
        $data['text_no_results'] = $this->lang->line('text_no_results');
        $data['text_confirm'] = $this->lang->line('text_confirm');

        $data['column_date'] = $this->lang->line('column_date');
        $data['column_name'] = $this->lang->line('column_name');
        $data['column_upload_time'] = $this->lang->line('column_upload_time');
        $data['column_decrypted_time'] = $this->lang->line('column_decrypted_time');
        $data['column_upload_status'] = $this->lang->line('column_upload_status');
        $data['column_filename'] = $this->lang->line('column_filename');
        $data['column_size'] = $this->lang->line('column_size');
        $data['column_upload_number'] = $this->lang->line('column_upload_number');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_error'] = $this->lang->line('column_error');

        $data['button_query'] = $this->lang->line('button_query');
        $data['button_export'] = $this->lang->line('button_export');

        return $data;
    }
}
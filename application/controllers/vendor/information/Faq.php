<?php
/**
 * Created by SD.
 * Date: 18/07/2017
 */
class Faq extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->vendor) {
            $this->load->model('vendor/common/model_header');
            $this->load->model('vendor/common/model_footer');
            $this->load->model('vendor/common/model_column_left');
            $this->load->model('admin/setting/model_announcement');
            $this->lang->load('vendor/information/faq_lang');
            $this->load->library('form_validation');
        } else {
            $this->load->helper('url');
            redirect('vendor/common/login');
        }
    }

    public function index()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/information/faq',
        );

        $data['heading_title'] = $this->lang->line('heading_title');

        // form title
        $data['text_list'] = $this->lang->line('text_list');
        $data['text_no_results'] = $this->lang->line('text_no_results');

        // column names
        $data['column_title'] = $this->lang->line('column_title');

        // set pagination
        $setting = array(
            'base_url' => 'index.php/vendor/information/announcement/index/',
            'total'    => $this->model_announcement->getTotal('faq'),
            'per_page' => 10,
        );

        $this->load->model('model_common');
        $config = $this->model_common->setPagination($setting);
        $this->pagination->initialize($config);


        // $this->uri->segment(5, 1) get the current page number,
        // if current page number cannot found, set page number as 1
        // use current page number to calculate "start" index
        $faqs = $this->model_announcement->getFAQs(($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page'], 0);

        foreach ($faqs as $faq) {
            $data['faqs'][] = array(
                'id' => $faq['id'],
                'title' => $faq['question'],
                'content' => $faq['answer'],
                'class' => '',
                'link' => 'index.php/vendor/information/faq/content?id=' . $faq['id']
            );
        }

        $this->load->view('vendor/information/faq', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function content()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $id = $this->input->get('id');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/information/faq',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/information/faq/content?id=' . $id,
        );

        $faq = $this->model_announcement->getAnnouncement($id, 'faq');

        $data['heading_title'] = $faq->question;
        $data['text_list'] = '';

        $data['faq'] = array(
            'title' => $faq->question,
            'content' => $faq->answer,
            'date' => $faq->date_modified
        );

        $this->load->view('vendor/information/faq_content', $data);
        // set footer
        $this->model_footer->loadFooter();
    }
}
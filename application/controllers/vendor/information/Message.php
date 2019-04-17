<?php
/**
 * Created by SD.
 * Date: 18/07/2017
 */
class Message extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->vendor) {
            $this->load->model('vendor/common/model_header');
            $this->load->model('vendor/common/model_footer');
            $this->load->model('vendor/common/model_column_left');
            $this->load->model('vendor/information/model_message');
            $this->lang->load('vendor/information/message_lang');
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
            'href' => 'index.php/vendor/information/message',
        );

        $data['heading_title'] = $this->lang->line('heading_title');

        // form title
        $data['text_list'] = $this->lang->line('text_list');
        $data['text_no_results'] = $this->lang->line('text_no_results');

        // column names
        $data['column_msg'] = $this->lang->line('column_msg');
        $data['column_date'] = $this->lang->line('column_date');

        // set pagination
        $setting = array(
            'base_url' => 'index.php/vendor/information/message/index/',
            'total'    => $this->model_message->getTotalMessage(),
            'per_page' => 10,
        );

        $this->load->model('model_common');
        $config = $this->model_common->setPagination($setting);
        $this->pagination->initialize($config);


        // $this->uri->segment(5, 1) get the current page number,
        // if current page number cannot found, set page number as 1
        // use current page number to calculate "start" index
        $msgs = $this->model_message->loadMessages(($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page']);

        foreach ($msgs as $msg) {
            $data['msgs'][] = array(
                'id' => $msg['id'],
                'content' => mb_substr($msg['content'],0,10,'UTF-8') . '...',
                'date_added' => explode(' ', $msg['date_added'])[0],
                'is_read' => $msg['is_read'],
            );
        }

        $this->load->view('vendor/information/message', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function content()
    {
        $msg_id = $this->input->post('id');
        $msg = $this->model_message->getMessage($msg_id);

        $json = array('id' => $msg->id, 'content' => $msg->content);

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($json))
            ->_display();
        exit;
    }

    public function isRead()
    {
        $msg_id = $this->input->post('id');
        $result = $this->model_message->markAsRead($msg_id);

        $json = array('success' => $result, 'id' => $msg_id);

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($json))
            ->_display();
        exit;
    }
}
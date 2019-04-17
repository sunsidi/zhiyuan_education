<?php

/**
 * Created by SD.
 * Date: 02/07/2017
 */
class Announcement extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_column_left');
            $this->load->model('admin/setting/model_announcement');
            $this->lang->load('admin/setting/announcement_lang');
            $this->load->library('form_validation');
        } else {
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }

    public function wiki()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_wiki'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data = $this->_getList('wiki');

        $this->load->view('admin/setting/announcement', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    private function _getList($type)
    {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array('text' => 'home', 'href' => 'index.php/admin/common/dashboard');

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_' . $type),
            'href' => 'index.php/admin/setting/announcement/' . $type,
        );

        $list = $this->model_announcement->getAll($type);
        $priorities = $this->model_announcement->getPriorities();

        switch ($type) {
            case 'wiki':
                foreach ($list as $row) {
                    $data['list'][] = array(
                        'id'     => $row['id'],
                        'title'  => $row['title'],
                        'status' => $row['status'] == 1 ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                        'code'   => $priorities[$row['priority'] - 1]['code'],
                        'edit'   => 'index.php/admin/setting/announcement/edit?id=' . $row['id'] . '&type=' . $type,
                    );
                }
                break;
            case 'faq':
                foreach ($list as $row) {
                    $data['list'][] = array(
                        'id'     => $row['id'],
                        'title'  => $row['question'],
                        'status' => $row['status'] == 1 ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                        'code'   => '',
                        'edit'   => 'index.php/admin/setting/announcement/edit?id=' . $row['id'] . '&type=' . $type,
                    );
                }
                break;
        }


        $data['selected'] = array();
        $data['add'] = 'index.php/admin/setting/announcement/add?type=' . $type;
        $data['delete'] = 'index.php/admin/setting/announcement/delete?type=' . $type;

        $data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : NULL;
        $data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : NULL;
        $data['error_alert'] = $this->input->get('success') == 3 ? $this->lang->line('text_warning') : NULL;
        $data['error_alert'] = $this->input->get('success') == 4 ? $this->lang->line('text_tag') : NULL;

        $data['heading_title'] = $this->lang->line('heading_title_' . $type);
        $data['text_no_results'] = $this->lang->line('text_no_results');
        $data['text_confirm'] = $this->lang->line('text_confirm');

        $data['column_title'] = $this->lang->line('column_title');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_edit'] = $this->lang->line('column_edit');

        $data['button_add'] = $this->lang->line('button_add');
        $data['button_delete'] = $this->lang->line('button_delete');

        return $data;
    }

    public function faq()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_faq'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data = $this->_getList('faq');

        $this->load->view('admin/setting/announcement', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function edit()
    {
        if ($this->_checkAuthentication()) {

            $header['js'][] = 'javascript/summernote/summernote.js';
            $header['js'][] = 'javascript/summernote/lang/summernote-zh-CN.js';
            $header['css'][] = 'javascript/summernote/summernote.css';
            $title = $this->lang->line('heading_title_' . $this->input->get('type'));

            // set header
            $this->model_header->loadHeader($title, $header);
            // set sidebar
            $this->model_column_left->loadSidebar();

            $id = $this->input->get('id');
            $type = $this->input->get('type');

            $this->form_validation->set_rules('title', '标题', 'trim|required');
            $this->form_validation->set_rules('content', '内容', 'trim|required');
            $this->form_validation->set_rules('status', '状态', 'trim|required');
            if ($type == 'wiki') {
                $this->form_validation->set_rules('priority', '优先级', 'trim|required');
            }

            if ($this->form_validation->run() && $this->input->post()) { //post the changed information
                $post = $this->input->post();
                if ($this->model_announcement->editAnnouncement($post, $type)) {
                    redirect('admin/setting/announcement/' . $type . '?success=1');
                } else {
                    redirect('admin/setting/announcement/edit?id=' . $id . '&type=' . $type);
                }
            } else { // render the form

                $data = $this->_form('edit', $type, $id);
                $announcement = $this->model_announcement->getAnnouncement($id, $type);
                $priorities = $this->model_announcement->getPriorities();

                if (isset($announcement)) {
                    $data['id'] = $announcement->id;
                    $data['title'] = isset($announcement->title) ? $announcement->title : $announcement->question;
                    $data['content'] = isset($announcement->content) ? $announcement->content : $announcement->answer;
                    $data['status'] = $announcement->status;
                    $data['show'] = isset($announcement->show) ? $announcement->show : '';
                    $data['mypriority'] = isset($announcement->priority) ? $announcement->priority : '';
                    $data['priorities'] = $priorities;
                }

                $this->load->view('admin/setting/announcement_form', $data);
            }
        } else {
            redirect('admin/setting/announcement/' . $type. '?success=3');
        }
    }

    private function _checkAuthentication()
    {
        if ($this->session->usergroup == 1) {
            return true;
        } else {
            return false;
        }
    }

    private function _form($action, $type, $id ='')
    {
        $data['button_save'] = $this->lang->line('button_save');
        $data['button_cancel'] = $this->lang->line('button_cancel');
        $data['action'] = 'index.php/admin/setting/announcement/' . $action . '?id=' . $id. '&type=' . $type;
        $data['cancel'] = 'index.php/admin/setting/announcement/' . $type;
        $data['type'] = $type;

        $data['heading_title'] = $this->lang->line('heading_title_' . $type);
        $data['text_form'] = $this->lang->line('text_form_' . $action);
        $data['text_enable'] = $this->lang->line('text_enable');
        $data['text_disable'] = $this->lang->line('text_disable');
        $data['text_show'] = $this->lang->line('text_show');
        $data['text_hidden'] = $this->lang->line('text_hidden');

        $data['column_title'] = $this->lang->line('column_title');
        $data['column_content'] = $this->lang->line('column_content');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_priority'] = $this->lang->line('column_priority');
        $data['column_show'] = $this->lang->line('column_show');

        $data['entry_title'] = $this->lang->line('entry_title');
        $data['entry_content'] = $this->lang->line('entry_content');
        $data['entry_priority'] = $this->lang->line('entry_priority');

        $data['tooltip_priority'] = $this->lang->line('tooltip_priority');
        $data['tooltip_show'] = $this->lang->line('tooltip_show');

        $data['default_priority'] = $this->lang->line('default_priority');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array('text' => 'home', 'href' => 'index.php/admin/common/dashboard');

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_' . $type),
            'href' => 'index.php/admin/setting/announcement',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('text_' . $action),
            'href' => 'index.php/admin/setting/announcement/' . $action,
        );

        return $data;
    }

    public function add()
    {
        if ($this->_checkAuthentication()) {

            $header['js'][] = 'javascript/summernote/summernote.js';
            $header['js'][] = 'javascript/summernote/lang/summernote-zh-CN.js';
            $header['css'][] = 'javascript/summernote/summernote.css';
            $title = $this->lang->line('heading_title_' . $this->input->get('type'));
            // set header
            $this->model_header->loadHeader($title, $header);
            // set sidebar
            $this->model_column_left->loadSidebar();

            $type = $this->input->get('type');

            $this->form_validation->set_rules('title', '标题', 'trim|required');
            $this->form_validation->set_rules('content', '内容', 'trim|required');
            $this->form_validation->set_rules('status', '状态', 'trim|required');
            if ($type == 'wiki') {
                $this->form_validation->set_rules('priority', '优先级', 'trim|required');
            }

            if ($this->form_validation->run() && $this->input->post()) { //post the changed information
                $post = $this->input->post();
                if ($this->model_announcement->addAnnouncement($post, $type)) {
                    redirect('admin/setting/announcement/' . $type . '?success=1');
                } else {
                    redirect('admin/setting/announcement/add?type=' . $type);
                }
            } else { // render the form

                $data = $this->_form('add', $type);

                $priorities = $this->model_announcement->getPriorities();

                $data['id'] = '';
                $data['title'] = '';
                $data['content'] = '';
                $data['status'] = '';
                $data['show'] = '';
                $data['priorities'] = $priorities;
                $data['mypriority'] = '';

                $this->load->view('admin/setting/announcement_form', $data);
            }
        } else {
            redirect('admin/setting/announcement/' . $type. '?success=3');
        }
    }

    public function delete()
    {
        if ($this->_checkAuthentication()) {
            $type = $this->input->get('type');
            foreach ($this->input->post('selected') as $id) {
                $tag = $this->model_announcement->getTag($id, $type);
                if (isset($tag)) {
                    redirect('admin/setting/announcement/' . $type. '?success=4');
                } else {
                    $this->model_announcement->deleteAnnouncement($id, $type);
                }
            }
            redirect('admin/setting/announcement/' . $type. '?success=1');
        } else {
            redirect('admin/setting/announcement/' . $type. '?success=3');
        }
    }
}
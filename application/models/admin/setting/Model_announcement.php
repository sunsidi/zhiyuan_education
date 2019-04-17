<?php

/**
 * Created by SD.
 * Date: 02/07/2017
 */
class Model_announcement extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getAll($type)
    {
        $query = $this->db->get($type);

        return $query->result_array();
    }

    public function getPriorities()
    {
        $query = $this->db->get('priority');

        return $query->result_array();
    }

    public function getPriority($priority)
    {
        $query = $this->db->get_where('priority', array('priority' => $priority));

        return $query->row();
    }

    public function getAnnouncement($id, $type)
    {
        $query = $this->db->get_where($type, array('id' => $id));

        return $query->row();
    }

    public function addAnnouncement($post, $type)
    {
        date_default_timezone_set('Asia/Shanghai');

        switch ($type) {
            case 'wiki':
                $data = array(
                    'title'         => $post['title'],
                    'content'       => $post['content'],
                    'status'        => $post['status'],
                    'priority'      => $post['priority'],
                    'date_added'    => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                );
                $this->db->insert($type, $data);

                return true;
                break;
            case 'faq':
                $data = array(
                    'question'      => $post['title'],
                    'answer'        => $post['content'],
                    'status'        => $post['status'],
                    'show'          => $post['show'],
                    'date_added'    => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                );
                $this->db->insert($type, $data);

                return true;
                break;
            default:
                return false;
                break;
        }
    }

    public function editAnnouncement($post, $type)
    {
        date_default_timezone_set('Asia/Shanghai');

        switch ($type) {
            case 'wiki':
                $data = array(
                    'title'         => $post['title'],
                    'content'       => $post['content'],
                    'status'        => $post['status'],
                    'priority'      => $post['priority'],
                    'date_modified' => date("Y-m-d H:i:s"),
                );
                $this->db->where('id', $post['id']);
                $this->db->update($type, $data);

                return true;
                break;
            case 'faq':
                $data = array(
                    'question'      => $post['title'],
                    'answer'        => $post['content'],
                    'status'        => $post['status'],
                    'show'          => $post['show'],
                    'date_modified' => date("Y-m-d H:i:s"),
                );
                $this->db->where('id', $post['id']);
                $this->db->update($type, $data);

                return true;
            default:
                return false;
                break;
        }
    }

    public function deleteAnnouncement($id, $type)
    {
        $this->db->delete($type, array('id' => $id));
    }

    public function getWikis($start, $limit)
    {
        $query = $this->db->select('*')->from('wiki')->limit($limit, $start)->order_by('priority', 'ASC')->order_by('date_modified', 'DESC')->get();

        return $query->result_array();
    }

    public function getFAQs($start, $limit, $show = NULL)
    {
        if (isset($show)) {
            $query = $this->db->get('faq', $limit, $start);
        } else {
            $query = $this->db->get('faq', array('show' => $show), $limit, $start);
        }

        return $query->result_array();
    }

    public function getTotal($type)
    {
        return $this->db->count_all($type);
    }

    public function getTag($id, $type)
    {
        if ($type == 'wiki') {
            $query = $this->db->get_where($type, array('id' => $id));
            return $query->row()->tag;
        } else {
            return null;
        }
    }
}
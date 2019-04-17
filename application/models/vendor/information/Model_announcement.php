<?php
/**
 * Created by SD.
 * Date: 08/08/2017
 */
class Model_announcement extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getPriority($priority)
    {
        $query = $this->db->get_where('priority', array('priority' => $priority));

        return $query->row();
    }

    public function getAnnouncement($id, $type)
    {
        $query = $this->db->get_where($type, array('id' => $id, 'tag' => ''));

        return $query->row();
    }

    public function getWikis($start, $limit)
    {
        $query = $this->db->select('*')
            ->from('wiki')
            ->where('tag', '')
            ->limit($limit, $start)
            ->order_by('priority', 'ASC')
            ->order_by('date_modified', 'DESC')
            ->get();

        return $query->result_array();
    }

    public function getTotal($type)
    {
        return $this->db->count_all($type);
    }

}
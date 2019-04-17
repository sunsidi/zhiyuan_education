<?php
/**
 * Created by SD.
 * Date: 18/07/2017
 */
class Model_message extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function loadMessages($start, $limit)
    {
        $query = $this->db->select('*')
            ->where('seller_id', $this->session->vendor['vendor_id'])
            ->or_where('group_id', $this->session->vendor['group_id'])
            ->limit($limit, $start)
            ->order_by('date_added', 'DESC')
            ->get('msg');
        return $query->result_array();
    }

    public function getTotalMessage()
    {
        $this->db->select('*')
            ->where('seller_id', $this->session->vendor['vendor_id'])
            ->or_where('group_id', $this->session->vendor['group_id'])
            ->get('msg');
        return $this->db->count_all_results();
    }

    public function getMessage($id)
    {
        $query = $this->db->get_where('msg', array('id' => $id));
        return $query->row();
    }

    public function markAsRead($id)
    {
        $data = array(
            'is_read' => 1,
        );

        $this->db->where('id', $id);
        $this->db->update('msg',$data);
        
        return true;
    }
}
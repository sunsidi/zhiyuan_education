<?php
/**
 * Created by SD.
 * Date: 30/08/2017
 */
class Model_dashboard extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getOrderNumbers($vendor_id)
    {
        $query = $this->db->select('*')
            ->where('vendor_id', $vendor_id)
            ->get('order');
        return count($query->result_array());
    }

    public function getDailyOrders($date, $vendor_id)
    {
        $query = $this->db->select('*')
            ->where('vendor_id', $vendor_id)
            ->like('date_added', $date, 'after')
            ->get('order');
        return count($query->result_array());
    }

    public function getTotalSales($vendor_id)
    {
        $query = $this->db->select_sum('total')
            ->where('vendor_id', $vendor_id)
            ->get('order');
        return isset($query->row()->total) ? $query->row()->total : 0;
    }

    public function getDailySales($date, $vendor_id)
    {
        $query = $this->db->select_sum('total')
            ->where('vendor_id', $vendor_id)
            ->like('date_added', $date, 'after')
            ->get('order');
        return isset($query->row()->total) ? $query->row()->total : 0;
    }

    public function getUnreadMessages($vendor_id, $group_id, $limit='', $start='')
    {
        $where = "is_read = 0 AND (seller_id = " .$vendor_id. " OR group_id = ". $group_id.")";
        $query = $this->db->select('*')
            ->where($where)
            ->limit($limit, $start)
            ->order_by('date_added', 'DESC')
            ->get('msg');
        return $query->result_array();
    }

    public function getWikis($limit='', $start='')
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

    public function getVendorToken($vendor_id)
    {
        $query = $this->db->get_where('vendor', array('vendor_id'=> $vendor_id));

        return $query->row()->token;
    }
}
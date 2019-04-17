<?php
/**
 * Created by SD.
 * Date: 31/08/2017
 */
class Model_balance extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getBalances($start, $limit)
    {
        $query = $this->db->select('*')
            ->limit($limit, $start)
            ->order_by('vendor_id', 'ASC')
            ->get('balance');
        return $query->result_array();
    }

    public function getVendorUsername($vendor_id)
    {
        $query = $this->db->get_where('vendor', array('vendor_id' => $vendor_id));

        return $query->row()->username;
    }

    public function getBalanceNum()
    {
        $query = $this->db->get('balance');

        return count($query->result_array());
    }
}
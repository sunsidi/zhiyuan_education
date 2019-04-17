<?php
/**
 * Created by SD.
 * Date: 01/09/2017
 */
class Model_dashboard extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getNewRegisters($date)
    {
        $query = $this->db->select('*')
            ->like('register_time', $date, 'after')
            ->get('vendor');
        return count($query->result_array());
    }

    public function getTotalSales()
    {
        $query = $this->db->select_sum('total')
            ->get('order');
        return isset($query->row()->total) ? $query->row()->total : 0;
    }

    public function getWithdraw($date)
    {
        $query = $this->db->select('*')
            ->like('date_added', $date, 'after')
            ->get('withdraw');
        return count($query->result_array());
    }

    public function calculateRevenue()
    {
        $query = $this->db->select_sum('revenue')
            ->get('order');
        return isset($query->row()->revenue) ? $query->row()->revenue : 0;
    }

    public function getRegisterDetails($start='', $limit='')
    {
        $query = $this->db->select('*')
            ->where('status', 0)
            ->limit($limit, $start)
            ->order_by('register_time', 'ASC')
            ->get('vendor');

        return $query->result_array();
    }

    public function getWithdrawDetails($start='', $limit='')
    {
        $query = $this->db->select('*')
            ->where('status', 0)
            ->limit($limit, $start)
            ->order_by('status', 'ASC')
            ->order_by('date_added', 'DESC')
            ->get('withdraw');

        return $query->result_array();
    }

    public function getVendorStatus($status)
    {
        $query = $this->db->get_where('vendor_status', array('status' => $status));

        return $query->row();
    }
}
<?php

/**
 * Created by SD.
 * Date: 26/07/2017
 */
class Model_review extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        date_default_timezone_set('Asia/Shanghai');
    }

    public function getWithdraw($start, $limit)
    {
        $query = $this->db->select('*')->limit($limit, $start)->order_by('status', 'ASC')->order_by('date_added', 'DESC')->get('withdraw');

        return $query->result_array();
    }

    public function getWithdrawTotal()
    {
        $query = $this->db->get('withdraw');

        return count($query->result_array());
    }

    public function getRegister($start, $limit)
    {
        $query = $this->db->select('*')
            ->limit($limit, $start)
            ->order_by('register_time', 'ASC')
            ->get('vendor');

        return $query->result_array();
    }

    public function getRegisterTotal()
    {
        $query = $this->db->get('vendor');

        return count($query->result_array());
    }

    public function getVendorStatus($status)
    {
        $query = $this->db->get_where('vendor_status', array('status' => $status));
        
        return $query->row();
    }

    public function approve($type, $id)
    {
        switch ($type) {
            case 'withdraw':
                $data = array(
                    'status'      => 1,
                    'msg'         => '已通过',
                    'review_time' => date("Y-m-d H:i:s"),
                );
                $this->db->where('id', $id);
                $this->db->update('withdraw', $data);
                break;

            case 'register':
                $data = array(
                    'status'      => 1,
                    'review_time' => date("Y-m-d H:i:s"),
                );
                $this->db->where('vendor_id', $id);
                $this->db->update('vendor', $data);
                break;
        }
    }

    public function reject($type, $id)
    {
        switch ($type) {
            case 'withdraw':
                $data = array(
                    'status'      => 2,
                    'msg'         => '已驳回',
                    'review_time' => date("Y-m-d H:i:s"),
                );
                $this->db->where('id', $id);
                $this->db->update('withdraw', $data);
                break;

            case 'register':
                $data = array(
                    'status'      => 2,
                    'review_time' => date("Y-m-d H:i:s"),
                );
                $this->db->where('vendor_id', $id);
                $this->db->update('vendor', $data);
                break;
        }
    }
}
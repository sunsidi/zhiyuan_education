<?php
/**
 * Created by SD.
 * Date: 29/08/2017
 */

class Model_cash extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getBalance($vendor_id)
    {
        $query = $this->db->get_where('balance', array('vendor_id' => $vendor_id));
        return $query->row()->balance;
    }

    public function getTotalWithdraw($username)
    {
        $query = $this->db->get_where('withdraw', array('username' => $username));

        return count($query->result_array());
    }

    public function getWithdrawRecord($username, $start = '', $limit='')
    {
        $query = $this->db->select('*')
            ->where('username', $username)
            ->limit($limit, $start)
            ->order_by('date_added', 'DESC')
            ->get('withdraw');
        return $query->result_array();
    }

    public function createWithdrawPurpose($post, $username)
    {
        $data = array(
            'username' => $username,
            'cash' => $post['withdraw'],
            'date_added' => date("Y-m-d H:i:s"),
            'status' => 0,
            'msg' => '待审核'
        );

        $this->db->insert('withdraw', $data);
    }
}
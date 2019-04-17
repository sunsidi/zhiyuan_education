<?php

/**
 * Created by SD.
 * Date: 27/07/2017
 */
class Model_manage extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getGroups()
    {
        $query = $this->db->get('vendor_group');

        return $query->result_array();
    }

    public function getGroup($id)
    {
        $query = $this->db->get_where('vendor_group', array('id' => $id));

        return $query->row();
    }

    public function editGroup($post)
    {
        $data = array(
            'name' => $post['name'],
            'rate' => $post['rate'],
        );

        $this->db->where('id', $post['id']);
        $this->db->update('vendor_group', $data);

        return true;
    }

    public function addGroup($post)
    {
        $data = array(
            'name' => $post['name'],
            'rate' => $post['rate'],
        );

        $this->db->insert('vendor_group', $data);

        return true;
    }

    public function deleteGroup($id)
    {
        $this->db->delete('vendor_group', array('id' => $id));

        $data = array(
            'group_id' => 0,
        );

        $this->db->where('group_id', $id);
        $this->db->update('vendor', $data);
    }

    public function getTotalVendors()
    {
        $query = $this->db->get('vendor');
        return count($query->result_array());
    }

    public function getVendors($start, $limit)
    {

        $query = $this->db->select('*')
            ->limit($limit, $start)
            ->order_by('vendor_id', 'ASC')
            ->get('vendor');

        return $query->result_array();
    }

    public function getVendorAccount($id)
    {
        $query = $this->db->get_where('vendor_account', array('id' => $id));

        return $query->row();
    }

    public function getVendorStatus($status)
    {
        $query = $this->db->get_where('vendor_status', array('status' => $status));

        return $query->row();
    }

    public function getVendor($vendor_id)
    {
        $query = $this->db->get_where('vendor', array('vendor_id' => $vendor_id));

        return $query->row();
    }

    public function getAccount($vendor_id)
    {
        $query = $this->db->get_where('vendor_account', array('id' => $vendor_id));

        return $query->row();
    }

    public function editVendor($post)
    {
        $data = array(
            'email'    => $post['email'],
            'qq'       => $post['qq'],
            'phone'    => $post['phone'],
            'group_id' => $post['group_id'],
        );
        $this->db->where('vendor_id', $post['id']);
        $this->db->update('vendor', $data);

        $data = array(
            'account'      => $post['account'],
            'bank'         => $post['bank'],
            'bank_city'    => $post['bank_city'],
            'bank_address' => $post['bank_address'],
            'realname'     => $post['realname'],
        );
        $this->db->where('id', $post['id']);
        $this->db->update('vendor_account', $data);
        
        return true;
    }

    public function reset_password($post)
    {
        $data = array(
            'password' => password_hash($post['password'], PASSWORD_DEFAULT),
        );

        $this->db->where('vendor_id', $post['id']);
        $this->db->update('vendor', $data);

        return true;
    }
}
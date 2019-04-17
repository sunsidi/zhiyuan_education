<?php
/**
 * Created by SD.
 * Date: 27/08/2017
 */
class Model_account extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function editAccount($post, $vendor_id)
    {
        $data = array(
            'email'    => $post['email'],
            'qq'       => $post['qq'],
            'phone'    => $post['phone'],
        );
        $this->db->where('vendor_id', $vendor_id);
        $this->db->update('vendor', $data);

        $data = array(
            'account'      => $post['account'],
            'bank'         => $post['bank'],
            'bank_city'    => $post['bank_city'],
            'bank_address' => $post['bank_address'],
            'realname'     => $post['realname'],
        );
        $this->db->where('id', $vendor_id);
        $this->db->update('vendor_account', $data);

        return true;
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

    public function resetPassword($post, $vendor_id)
    {
        $data = array(
            'password' => password_hash($post['new_password'], PASSWORD_DEFAULT),
        );

        $this->db->where('vendor_id', $vendor_id);
        $this->db->update('vendor', $data);

        return true;
    }

    public function passwordVerification($password, $vendor_id)
    {
        $query = $this->db->get_where('vendor', array('vendor_id' => $vendor_id));
        $vendor = $query->row();
        
        return password_verify($password, $vendor->password);
    }
}
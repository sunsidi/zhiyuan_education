<?php

/**
 * Created by SD.
 * Date: 20/07/2017
 */
class Model_register extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('string');
    }

    public function register($post, $auto_register)
    {
        $data = array(
            'username'      => $post['username'],
            'password'      => password_hash($post['password'], PASSWORD_DEFAULT),
            'token'         => md5($post['username'] . random_string('alnum', 6)),
            'email'         => $post['email'],
            'qq'            => $post['qq'],
            'phone'         => $post['telephone'],
            'group_id'      => 0,
            'status'        => $auto_register == 0 ? 0 : 1,
            // if auto register is enabled, set the status to be 1; else set to be 0
            'register_time' => date("Y-m-d H:i:s"),
        );

        $this->db->insert('vendor', $data);

        $id = $this->db->insert_id();
        $data = array(
            'id'           => $id,
            'account'      => $post['account'],
            'bank'         => $post['bank'],
            'bank_city'    => $post['bank_city'],
            'bank_address' => $post['bank_address'],
            'realname'     => $post['realname'],
        );

        $this->db->insert('vendor_account', $data);

        // create balance for the vendor
        $data = array(
            'vendor_id' => $id,
            'balance'   => 0.00,
        );

        $this->db->insert('balance', $data);
    }

    public function usernameUnique($username)
    {
        $query = $this->db->get_where('vendor', array('username' => $username));

        return count($query->result_array()) > 0 ? false : true;
    }
}
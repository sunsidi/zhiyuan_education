<?php
/**
 * Created by SD.
 * Date: 03/12/2016
 */
class Model_user extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }

    public function getUsers()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function getUser($user_id)
    {
        $query = $this->db->get_where('user', array('user_id' => $user_id));
        return $query->row();
    }

    public function editUser($post)
    {
        if ($post['new_password'] != $post['confirm_password']) {
            return false;
        }
        if (!$this->uniqueUsername($post['username'], $post['user_id'])) {
            return false;
        }
        $password = md5($post['new_password']);
        $data = array(
            'username' => $post['username'],
            'password' => $password,
            'fullname' => $post['fullname'],
            'email' => $post['email'],
            'image' => $post['image'],
            'status' => $post['user_group']
        );
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('user', $data);

        return true;
    }

    public function addUser($post)
    {
        if ($post['new_password'] != $post['confirm_password']) {
            return false;
        }
        if (!$this->uniqueUsername($post['username'], $post['user_id'])) {
            return false;
        }
        $password = md5($post['new_password']);
        $data = array(
            'username' => $post['username'],
            'password' => $password,
            'fullname' => $post['fullname'],
            'email' => $post['email'],
            'image' => $post['image'],
            'status' => $post['user_group']
        );
        $this->db->insert('user', $data);
        
        return true;
    }

    public function deleteUser($user_id)
    {
        $this->db->delete('user',array('user_id' => $user_id));
    }

    public function uniqueUsername($username, $user_id)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        $row = $query->row();

        if (isset($row)) {
            if ($row->user_id == $user_id) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
}
<?php
/**
 * Created by SD.
 * Date: 02/08/2017
 */
class Model_forgotten extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function validateUsername($username)
    {
        $query = $this->db->get_where('vendor', array('username' => $username));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserEmail($username)
    {
        $query = $this->db->select('email')
            ->from('vendor')
            ->where('username', $username)
            ->get();
        
        return $query->row()->email;
    }
}

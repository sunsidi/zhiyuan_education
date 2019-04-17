<?php
/**
 * Created by SD.
 * Date: 04/08/2017
 */
class Model_forgotten extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function validateEmail($email)
    {
        $query = $this->db->get_where('user', array('email' => $email));

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
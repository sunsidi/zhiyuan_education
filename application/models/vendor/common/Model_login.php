<?php

class Model_login extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
    }

    /**
     * [if login successful set_session and record the ip]
     * @param  [string] $username [username]
     * @param  [string] $password [password]
     * @return [bool]
     */
    public function loginVerification($username, $password)
    {
        $query = $this->db->select('*')->from('vendor')->where('username', $username)->get();
        $login = $query->row();

        if ($query->num_rows() > 0) {
            if ($login->status == 1) {
                if (password_verify($password, $login->password)) {
                    $this->set_session($login, 1800);
                    $this->recordLogin($login);

                    return true;
                }
            } else {
                $array = array(
                    'error' => true,
                    'msg' => ' 您的账户尚未通过审核，请联系网站管理员!'
                );
                return $array;
            }
        } else {
            return false;
        }
    }

    /**
     * [set_session description]
     * @param [array] $data [user information array]
     */
    private function set_session($data, $timeout = 300)
    {

        $vendor = array(
            'vendor_id' => $data->vendor_id,
            'username'  => $data->username,
            'group_id'  => $data->group_id,
            'image'     => $data->image,
        );
        $this->session->set_tempdata('vendor', $vendor, $timeout);

    }

    /**
     * [insert login ip&time]
     * @param [array] $data [user information array]
     * @return [null]
     */
    private function recordLogin($user)
    {
        date_default_timezone_set('Asia/Shanghai');
        $data = array(
            'ip'         => $_SERVER['REMOTE_ADDR'],
            'login_time' => date("Y-m-d H:i:s"),
        );
        $this->db->where('vendor_id', $user->vendor_id);
        $this->db->update('vendor', $data);
    }
}
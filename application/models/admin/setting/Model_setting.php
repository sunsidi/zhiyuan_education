<?php

/**
 * Created by SD.
 * Date: 18/11/2016
 */
class Model_setting extends CI_Model
{
    private $data = array();

    public function __construct()
    {
        $this->load->database();
        $this->load->library('session');
        // initialize $data array
        $this->set();
    }

    public function set()
    {
        $query = $this->db->get('setting');
        $results = $query->result_array();

        foreach ($results as $setting) {
            $this->data[$setting['key']] = $setting['value'];
        }
    }

    public function get($key)
    {
        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

    public function getSetting($code = '')
    {
        if (strlen($code) > 0) {
            $query = $this->db->get_where('setting', array('code' => $code));
            return $query->result_array();
        } else {
            $query = $this->db->get('setting');
            return $query->result_array();
        }
    }

    public function editSetting($post)
    {
        if ($this->session->usergroup == 1) {
            foreach ($post as $key => $value) {
                $data = array(
                    'value' => $value
                );
                $this->db->where('key', $key);
                $this->db->update('setting', $data);
            }
            return true;
        } else {
            return false;
        }
    }
}
<?php
/**
 * Created by SD.
 * Date: 01/07/2017
 */
class Model_payment extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getInstalled($type)
    {
        $extension_data = array();

        $query = $this->db->get_where('extension', array('code' => $type));
        $results = $query->result_array();

        foreach ($results as $result) {
            $extension_data[] = $result['code'];
        }

        return $extension_data;
    }

    public function install($type, $code) {

        // register in extension table
        $data = array(
            'type' => $type,
            'code' => $code,
        );
        $this->db->insert('extension', $data);
    }

    public function uninstall($type, $code) {
        $this->db->delete('extension',array('type' => $type, 'code' => $code));
    }
}
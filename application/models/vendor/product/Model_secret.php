<?php

/**
 * Created by SD.
 * Date: 14/07/2017
 */
class Model_secret extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function uploadSecret($product_id, $secrets, $vendor_id)
    {
        $secrets = explode("\n", trim($secrets));

        foreach ($secrets as $secret) {
            $data = array(
                'product_id' => $product_id,
                'vendor_id'  => $vendor_id,
                'secret'     => $secret,
                'is_used'    => 0,
            );

            $this->db->insert('secret', $data);
        }

        return true;
    }

    public function addSecret($post, $vendor_id)
    {
        $data = array(
            'product_id' => $post['product'],
            'vendor_id'  => $vendor_id,
            'secret'     => $post['secret'],
            'is_used'    => $post['status'],
        );

        $this->db->insert('secret', $data);

        return true;
    }

    public function editSecret($post, $vendor_id)
    {
        $data = array(
            'product_id' => $post['product'],
            'secret'     => $post['secret'],
            'is_used'    => $post['status'],
        );

        $this->db->where('id', $post['id']);
        $this->db->where('vendor_id', $vendor_id);
        $this->db->update('secret', $data);

        return true;
    }

    public function deleteSecret($id, $vendor_id)
    {
        $this->db->delete('secret', array('id' => $id, 'vendor_id' => $vendor_id));
    }

    public function getSecret($id)
    {
        $query = $this->db->get_where('secret', array('id' => $id));

        return $query->row();
    }

    public function getSecrets($start = '', $limit = '', $vendor_id)
    {
        $query = $this->db->get_where('secret', array('vendor_id' => $vendor_id), $limit, $start);

        return $query->result_array();
    }

    public function getSecretTotal()
    {
        return $this->db->count_all('secret');
    }
}
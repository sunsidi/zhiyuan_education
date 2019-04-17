<?php
/**
 * Created by SD.
 * Date: 04/08/2017
 */

class Model_vendor extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getVendor($token)
    {
        $query = $this->db->get_where('vendor', array('token' => $token));
        
        return $query->row();
    }

    public function getProduct($product_id)
    {
        $query = $this->db->get_where('product', array('product_id' => $product_id));

        return $query->row();
    }

    public function getProducts($vendor_id)
    {
        $query = $this->db->get_where('product', array('vendor_id' => $vendor_id, 'status' => 1));
        
        return $query->result_array();
    }

    public function getAnnouncement($tag)
    {
        $query = $this->db->get_where('wiki', array('tag' => $tag, 'status' => 1));

        return $query->row();
    }
}
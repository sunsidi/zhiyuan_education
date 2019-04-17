<?php
/**
 * Created by SD.
 * Date: 31/08/2017
 */
class Model_order extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function getVendorNumber()
    {
        $query = $this->db->get('vendor');

        return count($query->result_array());
    }

    public function getVendors($start='', $limit='')
    {
        $query = $this->db->select('*')
            ->limit($limit, $start)
            ->order_by('vendor_id', 'ASC')
            ->get('vendor');
        return $query->result_array();
    }

    public function getVendor($vendor_id)
    {
        $query = $this->db->get_where('vendor', array('vendor_id' => $vendor_id));

        return $query->row_array();
    }

    public function getOrderStatus()
    {
        $query = $this->db->get('order_status');

        return $query->result_array();
    }

    public function getTotalOrders($vendor_id)
    {
        $query = $this->db->get_where('order', array('vendor_id' => $vendor_id));

        return count($query->result_array());
    }

    public function getSecrets($order_id)
    {
        $query = $this->db->get_where('secret', array('order_id' => $order_id));

        return $query->result_array();
    }

    public function getOrder($order_id)
    {
        $query = $this->db->get_where('order', array('order_id' => $order_id));

        return $query->row_array();
    }

    public function getOrders($vendor_id, $start = '', $limit = '')
    {
        $query = $this->db->select('*')->from('order')->where('vendor_id', $vendor_id)->limit($limit, $start)->order_by('date_modified', 'DESC')->get();

        return $query->result_array();
    }

    public function getProduct($product_id)
    {
        $query = $this->db->get_where('product', array('product_id' => $product_id));

        return $query->row();
    }
}
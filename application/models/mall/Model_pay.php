<?php
/**
 * Created by SD.
 * Date: 11/08/2017
 */
class Model_pay extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function createOrder($order)
    {
        date_default_timezone_set("Asia/Shanghai");

        $price = $this->getProductDetail($order['product'])['price'];
        $name = $this->getProductDetail($order['product'])['name'];

        $data = array(
            'vendor_id' => $order['vendor_id'],
            'email' => $order['email'],
            'total' => $price * $order['quantity'],
            'product' => $order['product'],
            'quantity' => $order['quantity'],
            'payment_method' => $order['payment'],
            'status' => 1,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'date_added' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $this->db->insert('order', $data);

        $order_id = $this->db->insert_id();

        $data = array(
            'invoice_no' => 'INV-'. $order_id. '-' .date('Ymd'). '-' . $order['payment'],
        );
        $this->db->where('order_id', $order_id);
        $this->db->update('order', $data);

        $query = $this->db->get_where('order', array('order_id' => $order_id));
        $result = $query->row_array();
        $result['name'] = $name;
        return $result;
    }

    protected function getProductDetail($product_id)
    {
        $query = $this->db->get_where('product', array('product_id' => $product_id));

        return $query->row_array();
    }
}
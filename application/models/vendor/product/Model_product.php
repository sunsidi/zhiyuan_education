<?php
/**
 * Created by SD.
 * Date: 12/07/2017
 */
class Model_product extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getProduct($product_id, $vendor_id)
    {
        $query = $this->db->get_where('product', array('product_id' => $product_id, 'vendor_id' => $vendor_id));
        return $query->row();
    }
    
    public function getProducts($start = '', $limit = '', $vendor_id)
    {
        $query = $this->db->get_where('product', array('vendor_id' => $vendor_id), $limit, $start);
        return $query->result_array();
    }

    public function getProductTotal()
    {
        return $this->db->count_all('product');
    }

    public function addProduct($post, $vendor_id)
    {
        $data = array(
            'vendor_id' => $vendor_id,
            'name' => $post['name'],
            'price' => $post['price'],
            'status' => $post['status'],
            'cost' => $post['cost'],
            'quantity' => $post['quantity'],
            // 'category' => $post['category'],
            // 'image' => $post['image'],
        );
        $this->db->insert('product', $data);
        return true;
    }

    public function editProduct($post, $vendor_id)
    {
        $data = array(
            'name' => $post['name'],
            'price' => $post['price'],
            'status' => $post['status'],
            'cost' => $post['cost'],
            'quantity' => $post['quantity'],
            // 'category' => $post['category'],
            // 'image' => $post['image'],
        );
        $this->db->where('product_id', $post['product_id']);
        $this->db->where('vendor_id', $vendor_id);
        $this->db->update('product', $data);
        return true;
    }

    public function deleteProduct($product_id, $vendor_id)
    {
        $this->db->delete('product', array('product_id' => $product_id, 'vendor_id' => $vendor_id));
    }
}
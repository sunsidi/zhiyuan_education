<?php

/**
 * Created by SD.
 * Date: 25/07/2017
 */
class Vendor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mall/model_vendor');
        $this->load->library('form_validation');
        $this->load->model('admin/setting/model_setting');
        $this->load->helper('url');
    }

    public function index()
    {
        $token = $this->input->get('token');

        if (isset($token)) {
            $data['base'] = base_url();
            $data['title'] = $this->model_setting->get('config_name');

            $vendor = $this->model_vendor->getVendor($token);

            $products = $this->model_vendor->getProducts($vendor->vendor_id);

            foreach ($products as $product) {
                $data['products'][] = array(
                    'product_id' => $product['product_id'],
                    'name'       => $product['name'],
                );
            }

            $data['qq'] = $vendor->qq;
            $data['vendor_id'] = $vendor->vendor_id;

            $data['payments'][] = array(
                'title'  => '支付宝',
                'name'   => 'alipay',
                'value'  => 'ALIPAY',
                'image'  => 'image/mall/alipay.gif',
                'icon'   => 'image/mall/icon_alipay.png',
                'status' => $this->model_setting->get('alipay_status'),
            );

            $data['payments'][] = array(
                'title'  => '微信支付',
                'name'   => 'weixin',
                'value'  => 'WEIXIN',
                'icon'  => 'image/mall/icon_weixin.png',
                'image'   => 'image/mall/weixin.gif',
                'status' => $this->model_setting->get('wxpay_status'),
            );

            $data['disclaimer'] = sprintf($this->model_vendor->getAnnouncement('disclaimer')->content, $this->model_setting->get('config_qq'), $this->model_setting->get('config_qq'));
            $data['purchase_agreement'] = $this->model_vendor->getAnnouncement('purchase_agreement');
            $data['text_footer'] = sprintf($this->lang->line('text_footer'), base_url(), $this->model_setting->get('config_name'));

            $data['QR_code'] = 'index.php/mall/pay';

            $this->load->view('mall/vendor', $data);
        } else {
            show_404();
        }
    }

    public function product()
    {
        $product_id = $this->input->post('product', true);
        $vendor_id = $this->input->post('vendor_id', true);
        $product = $this->model_vendor->getProduct($product_id, $vendor_id);

        if (isset($product)) {
            $json['price'] = $product->price;
            $json['quantity'] = $product->quantity;
        } else {
            $json = NULL;
        }

        echo json_encode($json);
    }
}
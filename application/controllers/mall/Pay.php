<?php

/**
 * Created by SD.
 * Date: 09/08/2017
 */
class Pay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mall/model_pay');
        $this->load->model('mall/model_vendor');
        $this->load->library('form_validation');
        $this->load->library('wxpay/unifiedorder');
        $this->load->library('wxpay/nativepay');
        $this->load->model('admin/setting/model_setting');
        $this->load->helper('url');

        date_default_timezone_set("Asia/Shanghai");
    }

    public function index()
    {
        $product_id = $this->input->post('product', true);
        $vendor_id = $this->input->post('vendor_id', true);

        $this->form_validation->set_rules('vendor_id', '商户', 'trim|required');
        $this->form_validation->set_rules('product', '商品', 'trim|required');
        $this->form_validation->set_rules('quantity', '购买数量', 'trim|required|integer|callback_validate_quantity[' . $product_id . ']');
        $this->form_validation->set_rules('email', '邮箱', 'trim|required|valid_email');
        $this->form_validation->set_rules('payment', '支付方式', 'trim|required');

        if ($this->form_validation->run()) {
            // create order
            $post = $this->input->post(NULL, true);
            $order = $this->model_pay->createOrder($post);

            // create QR code
            switch ($post['payment']) {
                case 'ALIPAY':
                    break;

                case 'WEIXIN':
                    $result = $this->createWxpayQRcode($order);
                    // var_dump($result);
                    $json['error'] = false;
                    $json['QRcode'] = $result['code_url'];
                    break;
            }
        } else { // go back to last page
            $errors = $this->form_validation->error_array();
            $json['error'] = true;
            foreach ($errors as $error) {
                $json['msg'][] = $error;
            }
        }

        echo json_encode($json);
    }

    // change order status
    // create payment record
    // change product quantity
    // delete secrets
    public function success()
    {

    }

    public function validate_quantity($quantity, $product_id)
    {
        $product = $this->model_vendor->getProduct($product_id);
        $in_stock = $product->quantity;

        if ($quantity > $in_stock) {
            $this->form_validation->set_message('validate_quantity', ' 购买数量不能大于库存');
            return false;
        } else {
            return true;
        }
    }

    public function createWxpayQRcode($order)
    {
        $this->unifiedorder->SetBody($this->model_setting->get('config_name').'-'.$order['name']);
        $this->unifiedorder->SetAttach($this->model_setting->get('config_name'));
        $this->unifiedorder->SetOut_trade_no($order['invoice_no']);// invoice number
        $this->unifiedorder->SetTotal_fee($order['total'] * 100); // total amount
        $this->unifiedorder->SetTime_start(date("YmdHis"));
        $this->unifiedorder->SetTime_expire(date("YmdHis", time() + 600));
        $this->unifiedorder->SetGoods_tag("regular_buy");
        $this->unifiedorder->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $this->unifiedorder->SetTrade_type("NATIVE");
        $this->unifiedorder->SetProduct_id($order['order_id']); // order number
        $this->unifiedorder->SetAppid($this->model_setting->get('wxpay_appid'));//公众账号ID
        $this->unifiedorder->SetMch_id($this->model_setting->get('wxpay_mchid'));//商户号

        $result = $this->nativepay->GetPayUrl($this->unifiedorder);
        
        return $result;
    }
}
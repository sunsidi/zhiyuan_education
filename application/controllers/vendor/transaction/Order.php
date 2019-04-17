<?php

/**
 * Created by SD.
 * Date: 29/08/2017
 */
class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->vendor) {
            $this->load->model('vendor/common/model_header');
            $this->load->model('vendor/common/model_footer');
            $this->load->model('vendor/common/model_column_left');
            $this->load->model('vendor/transaction/model_order');
            $this->lang->load('vendor/transaction/order_lang');
            $this->load->library('form_validation');
        } else {
            $this->load->helper('url');
            redirect('vendor/common/login');
        }
    }

    public function index()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/transaction/order',
        );

        $data['heading_title'] = $this->lang->line('heading_title');

        $data['column_invoice'] = $this->lang->line('column_invoice');
        $data['column_email'] = $this->lang->line('column_email');
        $data['column_total'] = $this->lang->line('column_total');
        $data['column_product'] = $this->lang->line('column_product');
        $data['column_quantity'] = $this->lang->line('column_quantity');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_date'] = $this->lang->line('column_date');
        $data['column_view'] = $this->lang->line('column_view');

        $data['button_cancel'] = $this->lang->line('button_cancel');

        $status = $this->model_order->getOrderStatus();

        // set pagination
        $setting = array(
            'base_url' => 'index.php/vendor/transaction/order/index/',
            'total'    => $this->model_order->getTotalOrders($this->session->vendor['vendor_id']),
            'per_page' => 10,
        );

        $this->load->model('model_common');
        $config = $this->model_common->setPagination($setting);
        $this->pagination->initialize($config);

        // $this->uri->segment(5, 1) get the current page number,
        // if current page number cannot found, set page number as 1
        // use current page number to calculate "start" index
        $orders = $this->model_order->getOrders($this->session->vendor['vendor_id'], ($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page']);

        foreach ($orders as $order) {
            $data['orders'][] = array(
                'invoice_no' => $order['invoice_no'],
                'email'      => $order['email'],
                'total'      => $order['total'],
                'product'    => $this->model_order->getProduct($order['product'])->name,
                'quantity'   => $order['quantity'],
                'status'     => $status[$order['status'] - 1]['name'],
                'date'       => $order['date_modified'],
                'view'       => 'index.php/vendor/transaction/order/view?order_id=' . $order['order_id'],
            );
        }

        $data['cancel'] = 'index.php/vendor/common/dashboard';

        $this->load->view('vendor/transaction/order', $data);

        // set footer
        $this->model_footer->loadFooter();
    }

    public function view()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_view'), '');

        // set sidebar
        $this->model_column_left->loadSidebar();

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/transaction/order',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_view'),
            'href' => 'index.php/vendor/transaction/order/view',
        );

        $data['column_product'] = $this->lang->line('column_product');
        $data['column_secret'] = $this->lang->line('column_secret');
        $data['column_price'] = $this->lang->line('column_price');
        $data['column_date'] = $this->lang->line('column_date');
        $data['column_ip'] = $this->lang->line('column_ip');
        $data['column_email'] = $this->lang->line('column_email');
        $data['column_quantity'] = $this->lang->line('column_quantity');
        $data['column_total'] = $this->lang->line('column_total');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_payment'] = $this->lang->line('column_payment');

        $order_id = $this->input->get('order_id');

        $order = $this->model_order->getOrder($order_id);

        $product = $this->model_order->getProduct($order['product']);

        $secrets = $this->model_order->getSecrets($order_id);

        $status = $this->model_order->getOrderStatus();

        $data['order'] = array(
            'email'    => $order['email'],
            'product'  => $product->name,
            'quantity' => $order['quantity'],
            'price'    => $product->price,
            'total'    => $order['total'],
        );

        $data['create_time'] = array(
            'date'           => $order['date_added'],
            'payment_method' => '',
            'status'         => $status[$order['status'] - 1]['name'],
            'ip'             => $order['ip'],
        );
        if ($order['status'] != 1) {
            $data['modified_time'] = array(
                'date'           => $order['date_modified'],
                'payment_method' => $order['payment_method'],
                'status'         => $status[$order['status'] - 1]['name'],
                'ip'             => $order['ip'],
            );
        }

        foreach ($secrets as $secret) {
            $data['secrets'][] = array(
                'product' => $this->model_order->getProduct($secret['product_id'])->name,
                'secret'  => $secret['secret'],
            );
        }

        $data['text_history'] = $this->lang->line('text_history');
        $data['text_order_no'] = sprintf($this->lang->line('text_order_no'), $order['invoice_no']);
        $data['text_product_record'] = $this->lang->line('text_product_record');
        $data['text_total'] = $this->lang->line('text_total');
        $data['text_no_secret'] = $this->lang->line('text_no_secret');
        $data['heading_title'] = $this->lang->line('heading_title_view');

        $data['button_cancel'] = $this->lang->line('button_cancel');
        $data['cancel'] = 'index.php/vendor/transaction/order';

        $this->load->view('vendor/transaction/order_details', $data);

        // set footer
        $this->model_footer->loadFooter();
    }
}
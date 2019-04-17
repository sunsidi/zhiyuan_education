<?php

/**
 * Created by SD.
 * Date: 11/07/2017
 */
class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->vendor) {
            $this->load->model('vendor/common/model_header');
            $this->load->model('vendor/common/model_footer');
            $this->load->model('vendor/common/model_column_left');
            $this->load->model('vendor/product/model_product');
            $this->lang->load('vendor/product/product_lang');
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

        $data = $this->_getList();

        $this->load->view('vendor/product/product', $data);
        // set footer
        $this->model_footer->loadFooter();
    }

    public function add()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_add'), '');
        // set sidebar
        $this->model_column_left->loadSidebar();

        $this->form_validation->set_rules('name', '商品名称', 'trim|required');
        $this->form_validation->set_rules('price', '价格', 'trim|required|greater_than_equal_to[0]|numeric');
        $this->form_validation->set_rules('quantity', '库存', 'trim|required|greater_than_equal_to[0]|less_than_equal_to[999]|integer');
        $this->form_validation->set_rules('cost', '成本', 'trim|required|greater_than_equal_to[0]|less_than_equal_to[999]|numeric');
        $this->form_validation->set_rules('status', '状态', 'trim|required');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information
            $post = $this->input->post();
            if ($this->model_product->addProduct($post, $this->session->vendor['vendor_id'])) {
                redirect('vendor/product/product?success=1');
            } else {
                redirect('vendor/product/product/add');
            }
        } else { // render the form
            $data = $this->_form('add', '');

            $data['product_id'] = '';
            $data['name'] = '';
            $data['price'] = '';
            $data['quantity'] = '';
            $data['cost'] = '';
            // $data['category'] = '';
            // $data['image'] = '';
            $data['status'] = '';

            $this->load->view('vendor/product/product_form', $data);
            // set footer
            $this->model_footer->loadFooter();
        }
    }

    public function edit()
    {
        // set header
        $this->model_header->loadHeader($this->lang->line('heading_title_edit'), '');
        // set sidebar
        $this->model_column_left->loadSidebar();

        $this->form_validation->set_rules('name', '商品名称', 'trim|required');
        $this->form_validation->set_rules('price', '价格', 'trim|required|greater_than_equal_to[0]|numeric');
        $this->form_validation->set_rules('quantity', '库存', 'trim|required|greater_than_equal_to[0]|less_than_equal_to[999]|integer');
        $this->form_validation->set_rules('cost', '成本', 'trim|required|greater_than_equal_to[0]|less_than_equal_to[999]|numeric');
        $this->form_validation->set_rules('status', '状态', 'trim|required');

        $product_id = $this->input->get('product_id');

        if ($this->form_validation->run() && $this->input->post()) { //post the changed information
            $post = $this->input->post();
            if ($this->model_product->editProduct($post, $this->session->vendor['vendor_id'])) {
                redirect('vendor/product/product?success=1');
            } else {
                redirect('vendor/product/product/edit?product_id=' . $product_id);
            }
        } else { // render the form

            $data = $this->_form('edit', $product_id);

            $product = $this->model_product->getProduct($product_id, $this->session->vendor['vendor_id']);

            if (isset($product)) {
                $data['product_id'] = $product->product_id;
                $data['name'] = $product->name;
                $data['price'] = $product->price;
                $data['quantity'] = $product->quantity;
                $data['cost'] = $product->cost;
                // $data['category'] = $product->category;
                // $data['image'] = $product->image;
                $data['status'] = $product->status;
            } else {
                $data['product_id'] = '';
                $data['name'] = '';
                $data['price'] = '';
                $data['quantity'] = '';
                $data['cost'] = '';
                // $data['category'] = '';
                // $data['image'] = '';
                $data['status'] = '';
            }

            $this->load->view('vendor/product/product_form', $data);
            // set footer
            $this->model_footer->loadFooter();
        }
    }

    public function delete()
    {
        foreach ($this->input->post('selected') as $product_id) {
            $this->model_product->deleteProduct($product_id, $this->session->vendor['vendor_id']);
        }
        redirect('vendor/product/product?success=1');
    }

    private function _getList()
    {

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/product/product',
        );

        $data['success'] = $this->input->get('success') == 1 ? $this->lang->line('text_success') : NULL;
        $data['error_warning'] = $this->input->get('success') == 2 ? $this->lang->line('text_error') : NULL;
        $data['error_alert'] = $this->input->get('success') == 3 ? $this->lang->line('text_warning') : NULL;

        $data['add'] = 'index.php/vendor/product/product/add';
        $data['delete'] = 'index.php/vendor/product/product/delete';

        $data['heading_title'] = $this->lang->line('heading_title');

        // form title
        $data['text_list'] = $this->lang->line('text_list');
        $data['text_confirm'] = $this->lang->line('text_confirm');
        $data['text_no_results'] = $this->lang->line('text_no_results');

        // column names
        $data['column_name'] = $this->lang->line('column_name');
        $data['column_price'] = $this->lang->line('column_price');
        $data['column_quantity'] = $this->lang->line('column_quantity');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_action'] = $this->lang->line('column_action');

        $data['button_add'] = $this->lang->line('button_add');
        $data['button_edit'] = $this->lang->line('button_edit');
        $data['button_delete'] = $this->lang->line('button_delete');

        $data['selected'] = array();

        // set pagination
        $setting = array(
            'base_url' => 'index.php/vendor/product/product/index/',
            'total'    => $this->model_product->getProductTotal(),
            'per_page' => 10,
        );

        $this->load->model('model_common');
        $config = $this->model_common->setPagination($setting);
        $this->pagination->initialize($config);


        // $this->uri->segment(5, 1) get the current page number,
        // if current page number cannot found, set page number as 1
        // use current page number to calculate "start" index
        $products = $this->model_product->getProducts(($this->uri->segment(5, 1) - 1) * $setting['per_page'], $setting['per_page'], $this->session->vendor['vendor_id']);

        foreach ($products as $product) {
            $data['products'][] = array(
                'product_id' => $product['product_id'],
                'name'       => $product['name'],
                'price'      => $product['price'],
                'quantity'   => $product['quantity'],
                'status'     => $product['status'] ? $this->lang->line('text_enable') : $this->lang->line('text_disable'),
                'edit'       => 'index.php/vendor/product/product/edit?product_id=' . $product['product_id'],
            );
        }

        return $data;
    }

    private function _form($action, $product_id)
    {
        $data['button_save'] = $this->lang->line('button_save');
        $data['button_cancel'] = $this->lang->line('button_cancel');
        $data['action'] = 'index.php/vendor/product/product/' . $action . '?product_id=' . $product_id;
        $data['cancel'] = 'index.php/vendor/product/product/';

        $data['heading_title'] = $this->lang->line('heading_title_' . $action);
        $data['text_form'] = $this->lang->line('text_form_' . $action);
        $data['text_enable'] = $this->lang->line('text_enable');
        $data['text_disable'] = $this->lang->line('text_disable');

        $data['column_name'] = $this->lang->line('column_name');
        $data['column_price'] = $this->lang->line('column_price');
        $data['column_status'] = $this->lang->line('column_status');
        $data['column_quantity'] = $this->lang->line('column_quantity');
        $data['column_image'] = $this->lang->line('column_image');
        $data['column_cost'] = $this->lang->line('column_cost');

        $data['entry_name'] = $this->lang->line('entry_name');
        $data['entry_price'] = $this->lang->line('entry_price');
        $data['entry_status'] = $this->lang->line('entry_status');
        $data['entry_quantity'] = $this->lang->line('entry_quantity');
        $data['entry_image'] = $this->lang->line('entry_image');
        $data['entry_cost'] = $this->lang->line('entry_cost');

        $data['tooltip_quantity'] = $this->lang->line('tooltip_quantity');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => 'home',
            'href' => 'index.php/vendor/common/dashboard',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title'),
            'href' => 'index.php/vendor/product/product',
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->lang->line('heading_title_' . $action),
            'href' => 'index.php/vendor/product/product/' . $action . '?product_id=' . $product_id,
        );

        return $data;
    }
}
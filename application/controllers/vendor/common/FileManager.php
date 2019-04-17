<?php
class FileManager extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->isLoggedIn) {
            $this->load->model('admin/common/model_header');
            $this->load->model('admin/common/model_footer');
            $this->load->model('admin/common/model_image');
            $this->lang->load('admin/common/filemanager_lang');
            $this->lang->load('en_lang');
            $this->load->library('image_lib');
        } else {
            $this->load->helper('url');
            redirect('admin/common/login');
        }
    }

    public function index() {

        // set header
        $this->model_header->loadHeader();

        if ($this->input->get('filter_name')) {
            $filter_name = rtrim(str_replace(array('../', '..\\', '..', '*'), '', $this->input->get('filter_name')), '/');
        } else {
            $filter_name = null;
        }

        // Make sure we have the correct directory
        if ($this->input->get('directory')) {
            $directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $this->input->get('directory')), '/');
        } else {
            $directory = DIR_IMAGE . 'catalog';
        }

        if ($this->input->get('page')) {
            $page = $this->input->get('page');
        } else {
            $page = 1;
        }

        $data['images'] = array();

        // Get directories
        $directories = glob($directory . '/' . $filter_name . '*', GLOB_ONLYDIR);

        if (!$directories) {
            $directories = array();
        }

        // Get files
        $files = glob($directory . '/' . $filter_name . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);

        if (!$files) {
            $files = array();
        }

        // Merge directories and files
        $images = array_merge($directories, $files);

        // Get total number of files and directories
        $image_total = count($images);

        // Split the array based on current page number and max number of items per page of 10
        $images = array_splice($images, ($page - 1) * 16, 16);

        foreach ($images as $image) {
            //get the file name or folder name
            $name = str_split(basename($image), 14);

            if (is_dir($image)) { // if $image is a folder
                $url = '';

                if ($this->input->get('target')) {
                    $url .= '&target=' . $this->input->get('target');
                }

                if ($this->input->get('thumb')) {
                    $url .= '&thumb=' . $this->input->get('thumb');
                }

                $data['images'][] = array(
                    'thumb' => '',
                    'name'  => implode(' ', $name),
                    'type'  => 'directory',
                    'path'  => mb_substr($image, mb_strlen(DIR_IMAGE)),
                    'href'  => 'index.php/admin/common/filemanager?directory=' . urlencode(mb_substr($image, mb_strlen(DIR_IMAGE . 'catalog/'))) . $url
                );
            } elseif (is_file($image)) { // if $image is a image

                // config image cut
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 100;
                $config['height'] = 100;

                // get the file name without extension
                $file = basename($image);
                $info = pathinfo($file);
                $file_name =  basename($file,'.'.$info['extension']);
                $config['new_image'] = '/Applications/XAMPP/xamppfiles/htdocs/zhiyuan/image/cache/' . basename($file_name) . '-' . $config['width'] . 'x' . $config['height'] . '.png';

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $data['images'][] = array(
                    'thumb' => 'image/cache/' . basename($file_name) . '-' . $config['width'] . 'x' . $config['height'] . '_thumb.png',
                    'name'  => $file,
                    'type'  => 'image',
                    'path'  => mb_substr($image, mb_strlen(DIR_IMAGE)),
                    'href'  => 'image/' . mb_substr($image, mb_strlen(DIR_IMAGE))
                );
            }
        }

        $data['heading_title'] = $this->lang->line('heading_title');

        $data['text_no_results'] = $this->lang->line('text_no_results');
        $data['text_confirm'] = $this->lang->line('text_confirm');

        $data['entry_search'] = $this->lang->line('entry_search');
        $data['entry_folder'] = $this->lang->line('entry_folder');

        $data['button_parent'] = $this->lang->line('button_parent');
        $data['button_refresh'] = $this->lang->line('button_refresh');
        $data['button_upload'] = $this->lang->line('button_upload');
        $data['button_folder'] = $this->lang->line('button_folder');
        $data['button_delete'] = $this->lang->line('button_delete');
        $data['button_search'] = $this->lang->line('button_search');
        $this->load->library('session');

        if ($this->input->get('directory')) {
            $data['directory'] = urlencode($this->input->get('directory'));
        } else {
            $data['directory'] = '';
        }

        if ($this->input->get('filter_name')) {
            $data['filter_name'] = $this->input->get('filter_name');
        } else {
            $data['filter_name'] = '';
        }

        // Return the target ID for the file manager to set the value
        if ($this->input->get('target')) {
            $data['target'] = $this->input->get('target');
        } else {
            $data['target'] = '';
        }

        // Return the thumbnail for the file manager to show a thumbnail
        if ($this->input->get('thumb')) {
            $data['thumb'] = $this->input->get('thumb');
        } else {
            $data['thumb'] = '';
        }

        // Parent
        $url = '';

        if ($this->input->get('directory')) {
            $pos = strrpos($this->input->get('directory'), '/');

            if ($pos) {
                $url .= '&directory=' . urlencode(substr($this->input->get('directory'), 0, $pos));
            }
        }

        if ($this->input->get('target')) {
            $url .= '&target=' . $this->input->get('target');
        }

        if ($this->input->get('thumb')) {
            $url .= '&thumb=' . $this->input->get('thumb');
        }

        $data['parent'] = 'index.php/admin/common/filemanager' . $url;

        // Refresh
        $url = '';

        if ($this->input->get('directory')) {
            $url .= '&directory=' . urlencode($this->input->get('directory'));
        }

        if ($this->input->get('target')) {
            $url .= '&target=' . $this->input->get('target');
        }

        if ($this->input->get('thumb')) {
            $url .= '&thumb=' . $this->input->get('thumb');
        }

        $data['refresh'] = 'index.php/admin/common/filemanager'. $url;

        $url = '';

        if ($this->input->get('directory')) {
            $url .= '&directory=' . urlencode(html_entity_decode($this->input->get('directory'), ENT_QUOTES, 'UTF-8'));
        }

        if ($this->input->get('filter_name')) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->input->get('filter_name'), ENT_QUOTES, 'UTF-8'));
        }

        if ($this->input->get('target')) {
            $url .= '&target=' . $this->input->get('target');
        }

        if ($this->input->get('thumb')) {
            $url .= '&thumb=' . $this->input->get('thumb');
        }

//        $pagination = new Pagination();
//        $pagination->total = $image_total;
//        $pagination->page = $page;
//        $pagination->limit = 16;
//        $pagination->url = $this->url->link('common/filemanager', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
//
//        $data['pagination'] = $pagination->render();

        $this->load->view('admin/common/filemanager', $data);

        // set footer
        $this->model_footer->loadFooter();
    }

    public function upload() {
        $this->load->language('admin/common/filemanager');

        $json = array();

        // Make sure we have the correct directory
        if ($this->input->get('directory')) {
            $directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $this->input->get('directory')), '/');
        } else {
            $directory = DIR_IMAGE . 'catalog';
        }

        // Check its a directory
        if (!is_dir($directory)) {
            $json['error'] = $this->lang->line('error_directory');
        }

        if (!$json) {
            if (!empty($_FILES['file']['tmp_name']) && is_file($_FILES['file']['tmp_name'])) {
                // Sanitize the filename
                $filename = basename(html_entity_decode($_FILES['file']['name'], ENT_QUOTES, 'UTF-8'));

                // Validate the filename length
                if ((mb_strlen($filename) < 3) || (mb_strlen($filename) > 255)) {
                    $json['error'] = $this->lang->line('error_filename');
                }

                // Allowed file extension types
                $allowed = array(
                    'jpg',
                    'jpeg',
                    'gif',
                    'png'
                );

                if (!in_array(mb_strtolower(mb_substr(strrchr($filename, '.'), 1)), $allowed)) {
                    $json['error'] = $this->lang->line('error_filetype');
                }

                // Allowed file mime types
                $allowed = array(
                    'image/jpeg',
                    'image/pjpeg',
                    'image/png',
                    'image/x-png',
                    'image/gif'
                );

                if (!in_array($_FILES['file']['type'], $allowed)) {
                    $json['error'] = $this->lang->line('error_filetype');
                }
                
                // Check to see if any PHP files are trying to be uploaded
                $content = file_get_contents($_FILES['file']['tmp_name']);

                if (preg_match('/\<\?php/i', $content)) {
                    $json['error'] = $this->lang->line('error_filetype');
                }

                // Return any upload error
                if ($_FILES['file']['error'] != 0) {
                    $json['error'] = $this->lang->line('error_upload_' . $_FILES['file']['error']);
                }

            } else {
                $json['error'] = $this->lang->line('error_upload');
            }
        }

        if (!$json) {
            move_uploaded_file($_FILES['file']['tmp_name'], $directory . '/' . $filename);

            $json['success'] = $this->lang->line('text_uploaded');
        }

        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($json));
    }

//    public function folder() {
//        $this->load->language('common/filemanager');
//
//        $json = array();
//
//        // Check user has permission
//        if (!$this->user->hasPermission('modify', 'common/filemanager')) {
//            $json['error'] = $this->lang->line('error_permission');
//        }
//
//        // Make sure we have the correct directory
//        if (isset($this->input->get('directory')) {
//            $directory = rtrim(DIR_IMAGE . 'catalog/' . str_replace(array('../', '..\\', '..'), '', $this->input->get('directory')), '/');
//        } else {
//            $directory = DIR_IMAGE . 'catalog';
//        }
//
//        // Check its a directory
//        if (!is_dir($directory)) {
//            $json['error'] = $this->lang->line('error_directory');
//        }
//
//        if (!$json) {
//            // Sanitize the folder name
//            $folder = str_replace(array('../', '..\\', '..'), '', basename(html_entity_decode($this->input->post('folder'], ENT_QUOTES, 'UTF-8')));
//
//            // Validate the filename length
//            if ((mb_strlen($folder) < 3) || (mb_strlen($folder) > 128)) {
//                $json['error'] = $this->lang->line('error_folder');
//            }
//
//            // Check if directory already exists or not
//            if (is_dir($directory . '/' . $folder)) {
//                $json['error'] = $this->lang->line('error_exists');
//            }
//        }
//
//        if (!$json) {
//            mkdir($directory . '/' . $folder, 0777);
//
//            $json['success'] = $this->lang->line('text_directory');
//        }
//
//        $this->response->addHeader('Content-Type: application/json');
//        $this->response->setOutput(json_encode($json));
//    }

////    public function delete() {
////        $this->load->language('common/filemanager');
////
////        $json = array();
////
////        // Check user has permission
////        if (!$this->user->hasPermission('modify', 'common/filemanager')) {
////            $json['error'] = $this->lang->line('error_permission');
////        }
////
////        if (isset($this->input->post('path')) {
////            $paths = $this->input->post('path');
////        } else {
////            $paths = array();
////        }
////
////        // Loop through each path to run validations
////        foreach ($paths as $path) {
////            $path = rtrim(DIR_IMAGE . str_replace(array('../', '..\\', '..'), '', $path), '/');
////
////            // Check path exsists
////            if ($path == DIR_IMAGE . 'catalog') {
////                $json['error'] = $this->lang->line('error_delete');
////
////                break;
////            }
////        }
////
////        if (!$json) {
////            // Loop through each path
////            foreach ($paths as $path) {
////                $path = rtrim(DIR_IMAGE . str_replace(array('../', '..\\', '..'), '', $path), '/');
////
////                // If path is just a file delete it
////                if (is_file($path)) {
////                    unlink($path);
////
////                    // If path is a directory beging deleting each file and sub folder
////                } elseif (is_dir($path)) {
////                    $files = array();
////
////                    // Make path into an array
////                    $path = array($path . '*');
////
////                    // While the path array is still populated keep looping through
////                    while (count($path) != 0) {
////                        $next = array_shift($path);
////
////                        foreach (glob($next) as $file) {
////                            // If directory add to path array
////                            if (is_dir($file)) {
////                                $path[] = $file . '/*';
////                            }
////
////                            // Add the file to the files to be deleted array
////                            $files[] = $file;
////                        }
////                    }
////
////                    // Reverse sort the file array
////                    rsort($files);
////
////                    foreach ($files as $file) {
////                        // If file just delete
////                        if (is_file($file)) {
////                            unlink($file);
////
////                            // If directory use the remove directory function
////                        } elseif (is_dir($file)) {
////                            rmdir($file);
////                        }
////                    }
////                }
////            }
////
////            $json['success'] = $this->lang->line('text_delete');
////        }
////
////        $this->response->addHeader('Content-Type: application/json');
////        $this->response->setOutput(json_encode($json));
////    }
}
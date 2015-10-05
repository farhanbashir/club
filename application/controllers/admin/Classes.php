<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classes extends MY_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public $type = 'classes';

    function __construct() {
        parent::__construct();
        $this->load->model('content', '', TRUE);
        $this->load->model('image', '', TRUE);
        $this->load->model('pdf', '', TRUE);

        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
    }

    public function index() {
        $data = array();
        $this->load->library("pagination");
        $total_rows = $this->content->get_total_content_by_type($this->type);

        $pagination_config = get_pagination_config($this->type . '/index', $total_rows, $this->config->item('pagination_limit'), 4);

        $this->pagination->initialize($pagination_config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $classes = $this->content->get_content_by_type($this->type, $page);
        $data['classes'] = $classes;
        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function view($id) {
        $class = $this->content->get_content_by_id($this->type, $id);
        $data['class'] = $class[0];
        $images = $this->image->get_images_by_content_id($id);

        foreach ($images as $image) {
            $data['class']['images'][] = $image['path'] . $image['name'];
        }

        $pdf = $this->pdf->get_pdf($id);

        if (!empty($pdf)) {
            $data['class']['pdf'] = $pdf[0];
        }

        $content = $this->load->view($this->type . '/view.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function edit($id) {
        $class = $this->content->get_content_by_id($this->type, $id);
        $data['class'] = $class[0];
        $images = $this->image->get_images_by_content_id($id);
        $pdf = $this->pdf->get_pdf($id);

        if (!empty($pdf)) {
            $data['class']['pdf'] = $pdf[0];
        }

        foreach ($images as $image) {
            $data['class']['images'][] = array(
                'path' => $image['path'] . $image['name'],
                'id' => $image['image_id']
            );
        }
        $content = $this->load->view($this->type . '/edit.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {

        $serialize_data = array();
        $serialize_data = $_POST['class']['data'];
        $serialize_data['day'] = $_POST['class']['days'];
        $serialize_data['time'] = $_POST['class']['time'];


        $data = array(
            'title' => $_POST['class']['title'],
            'start_date' => $_POST['class']['start_date'],
            'description' => $_POST['class']['description'],
            'data' => serialize($serialize_data),
            'modified_time'=>date('Y-m-d H:i:s')
        );

        $class_id = $this->content->update_content_by_id($_POST['class']['id'], $data);

        if (!empty($_FILES['pdf']['name'])) {
            $pdf_data = $this->uploadContentPdfFile($class_id, $this->type);
            $this->pdf->add_pdf($pdf_data);
        }

        $image_data = $this->uploadImageFile($class_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/' . $this->type . '/edit/' . $class_id));
    }

    public function addnew() {
        $content = $this->load->view($this->type . '/new.php', $data = NULL, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {

        $serialize_data = array();
        $serialize_data = $_POST['class']['data'];
        $serialize_data['day'] = $_POST['class']['days'];
        $serialize_data['time'] = $_POST['class']['time'];


        $data = array(
            'title' => $_POST['class']['title'],
            'start_date' => $_POST['class']['start_date'],
            'description' => $_POST['class']['description'],
            'data' => serialize($serialize_data),
            'modified_time'=>date('Y-m-d H:i:s')
        );

        $class_id = $this->content->add_content($data, $this->type);

        if (!empty($_FILES['pdf']['name'])) {
            $pdf_data = $this->uploadContentPdfFile($class_id, $this->type);
            $this->pdf->add_pdf($pdf_data);
        }


        $image_data = $this->uploadImageFile($class_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/' . $this->type . '/view/' . $class_id));
    }

    public function delete($id, $status, $view = NULL) {
        $flag = $this->content->delete_content($id, $status);
//        $this->image->delete_content_images($id);
        if (empty($view)) {
            redirect(site_url('admin/' . $this->type . '/index'));
        } else {
            redirect(site_url('admin/' . $this->type . '/view/' . $id));
        }
    }

    public function delete_image($id, $content_id) {
        $this->image->deactivate_image($id);

        redirect(site_url('admin/' . $this->type . '/edit/' . $content_id));
    }

    public function remove_pdf($pdf_id, $content_id, $action) {
        $this->pdf->deactive_pdf($pdf_id);
        redirect(site_url('admin/' . $this->type . '/' . $action . '/' . $content_id));
    }

}

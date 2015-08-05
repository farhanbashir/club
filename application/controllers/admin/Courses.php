<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Courses extends My_Controller {

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
    public $type = 'courses';

    function __construct() {
        parent::__construct();
        $this->load->model('content', '', TRUE);


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

        $courses = $this->content->get_content_by_type($this->type, $page);
        $data['courses'] = $courses;
        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function view($id) {
        $course = $this->content->get_content_by_id($this->type, $id);
        $data['course'] = $course[0];
        $content = $this->load->view($this->type . '/view.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function edit($id) {
        $course = $this->content->get_content_by_id($this->type, $id);
        $data['course'] = $course[0];
        $content = $this->load->view($this->type . '/edit.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {

        $data = array(
            'title' => $_POST['course']['title'],
            'date' => $_POST['course']['date'],
            'description' => $_POST['course']['description'],
                //'link' => $_POST['course']['link']
        );

        $course_id = $this->content->update_content_by_id($_POST['course']['id'], $data);

        $this->edit($course_id);
    }

    public function addnew() {
        $content = $this->load->view($this->type . '/new.php', $data = NULL, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {

        $data = array(
            'title' => $_POST['course']['title'],
            'date' => $_POST['course']['date'],
            'description' => $_POST['course']['description'],
//            'link' => $_POST['course']['link']
        );

        $course_id = $this->content->add_content($data, $this->type);
        $this->uploadImageFile($course_id, $this->type);

//        if ($this->uploadSuccess) {
////            $data = array('upload_data' => $this->uploadData);
////            $this->load->view('upload_success', $data);
//        } else {
//
////            $this->load->view('upload_form', $this->uploadError);
//        }



        $this->view($course_id);
    }

    public function delete($id) {
        $flag = $this->content->delete_content($id);

        redirect(site_url('admin/' . $this->type . '/index'));
    }

}

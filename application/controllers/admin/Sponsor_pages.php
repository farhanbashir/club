<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sponsor_pages extends MY_Controller {

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
    public $type = 'sponsor_pages';
    public $pages = array('Splash Page', 'Information Page', "What's On Page");

    function __construct() {
        parent::__construct();
        $this->load->model('content', '', TRUE);
        $this->load->model('image', '', TRUE);

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

        $sponsor_pages = $this->content->get_content_by_type($this->type, $page);
        $data['sponsor_pages'] = $sponsor_pages;
        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function view($id) {
        $sponsor_page = $this->content->get_content_by_id($this->type, $id);
        $data['sponsor_page'] = $sponsor_page[0];
        $images = $this->image->get_images_by_content_id($id);

        foreach ($images as $image) {
            $data['sponsor_page']['images'][] = $image['path'] . $image['name'];
        }

        $content = $this->load->view($this->type . '/view.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function edit($id) {
        $sponsor_page = $this->content->get_content_by_id($this->type, $id);
        $data['sponsor_page'] = $sponsor_page[0];
        $images = $this->image->get_images_by_content_id($id);
        $data['pages'] = $this->pages;

        foreach ($images as $image) {
            $data['sponsor_page']['images'][] = array(
                'path' => $image['path'] . $image['name'],
                'id' => $image['image_id']
            );
        }
        $content = $this->load->view($this->type . '/edit.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {

        $data_page = array(
            'page' => $_POST['sponsor_page']['page']
        );
        $data = array(
            'title' => $_POST['sponsor_page']['title'],
            //'detail_description' => $_POST['sponsor_page']['detail_description'],
            'data' => serialize($data_page)
        );


        $sponsor_page_id = $this->content->update_content_by_id($_POST['sponsor_page']['id'], $data);
        $image_data = $this->uploadSingleImageFile($sponsor_page_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_single_images($sponsor_page_id, $image_data);
        }

        redirect(site_url('admin/' . $this->type . '/edit/' . $sponsor_page_id));
    }

    public function addnew() {
        $data['pages'] = $this->pages;
        $content = $this->load->view($this->type . '/new.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {
        $data_page = array(
            'page' => $_POST['sponsor_page']['page']
        );
        $data = array(
            'title' => $_POST['sponsor_page']['title'],
            //'detail_description' => $_POST['sponsor_page']['detail_description'],
            'data' => serialize($data_page)
        );

        $sponsor_page_id = $this->content->add_content($data, $this->type);
        $image_data = $this->uploadSingleImageFile($sponsor_page_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_single_images($sponsor_page_id, $image_data);
        }

        redirect(site_url('admin/' . $this->type . '/view/' . $sponsor_page_id));
    }

    public function delete($id, $status, $view = NULL) {
        $flag = $this->content->delete_content($id, $status);
//        $this->image->delete_content_images($id);
//        if (empty($view)) {
            redirect(site_url('admin/' . $this->type . '/index'));
//        } else {
//            redirect(site_url('admin/' . $this->type . '/view/' . $id));
//        }
    }

    public function delete_image($id, $content_id) {
        $this->image->deactivate_image($id);

        redirect(site_url('admin/' . $this->type . '/edit/' . $content_id));
    }

}

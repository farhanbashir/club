<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promotions extends My_Controller {

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
    public $type = 'promotions';

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

        $promotions = $this->content->get_content_by_type($this->type, $page);
        $data['promotions'] = $promotions;
        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function view($id) {
        $promotion = $this->content->get_content_by_id($this->type, $id);
        $data['promotion'] = $promotion[0];
        $images = $this->image->get_images_by_content_id($id);

        foreach ($images as $image) {
            $data['promotion']['images'][] = $image['path'] . $image['name'];
        }

        $content = $this->load->view($this->type . '/view.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function edit($id) {
        $promotion = $this->content->get_content_by_id($this->type, $id);
        $data['promotion'] = $promotion[0];
        $images = $this->image->get_images_by_content_id($id);

        foreach ($images as $image) {
            $data['promotion']['images'][] = array(
                'path' => $image['path'] . $image['name'],
                'id' => $image['image_id']
            );
        }
        $content = $this->load->view($this->type . '/edit.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {

        $data = array(
            'title' => $_POST['promotion']['title'],
            'description' => $_POST['promotion']['description'],
        );

        $promotion_id = $this->content->update_content_by_id($_POST['promotion']['id'], $data);
        $image_data = $this->uploadImageFile($promotion_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/' . $this->type . '/edit/' . $promotion_id));
    }

    public function addnew() {
        $content = $this->load->view($this->type . '/new.php', $data = NULL, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {

        $data = array(
            'title' => $_POST['promotion']['title'],
            'description' => $_POST['promotion']['description'],
        );

        $promotion_id = $this->content->add_content($data, $this->type);
        $image_data = $this->uploadImageFile($promotion_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/' . $this->type . '/view/' . $promotion_id));
    }

    public function delete($id) {
        $flag = $this->content->delete_content($id);
        $this->image->delete_content_images($id);
        redirect(site_url('admin/' . $this->type . '/index'));
    }

    public function delete_image($id, $content_id) {
        $this->image->deactivate_image($id);

        redirect(site_url('admin/' . $this->type . '/edit/' . $content_id));
    }

}

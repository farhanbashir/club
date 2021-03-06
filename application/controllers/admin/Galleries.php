<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galleries extends MY_Controller {

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
    public $type = 'galleries';
    
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
        $total_rows = $this->content->get_total_content_by_type('event_galleries');

        $pagination_config = get_pagination_config($this->type . '/index', $total_rows, $this->config->item('pagination_limit'), 4);

        $this->pagination->initialize($pagination_config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $galleries = $this->content->get_content_by_type('event_galleries', $page);
//        $data['galleries'] = $galleries;


        if (!empty($galleries)) {
            foreach ($galleries as $gallery) {
                $data['galleries'][] = array(
                    'images' => $this->image->get_images_by_content_id($gallery['content_id']),
                    'content_id' => $gallery['content_id'],
                    'content_type_id' => $gallery['content_type_id'],
                    'title' => $gallery['title'],
                    'description' => $gallery['description'],
                    'is_active' => $gallery['is_active'],
                );
            }
        }


        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function view($id) {
        $gallery = $this->content->get_content_by_id('event_galleries', $id);
        $data['gallery'] = $gallery[0];
        $images = $this->image->get_images_by_content_id($id);

        foreach ($images as $image) {
            $data['gallery']['images'][] = $image['path'] . $image['name'];
        }

        $content = $this->load->view($this->type . '/view.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function edit($id) {
        $gallery = $this->content->get_content_by_id('event_galleries', $id);
        $data['gallery'] = $gallery[0];
        $images = $this->image->get_images_by_content_id($id);

        foreach ($images as $image) {
            $data['gallery']['images'][] = array(
                'path' => $image['path'] . $image['name'],
                'id' => $image['image_id']
            );
        }

        $event_title = array();
        $gallery_title = array();

        $events_data = $this->content->get_content_by_type('events');
        if (!empty($events_data)) {
            foreach ($events_data as $event) {
                $event_title[] = $event['title'];
            }
        }
        $galleries_data = $this->content->get_content_by_type('event_galleries');
        if (!empty($galleries_data)) {
            foreach ($galleries_data as $gallery) {
                $gallery_title[] = $gallery['title'];
            }
        }
        $data['remaining_title'] = array_diff($event_title, $gallery_title);



        $content = $this->load->view($this->type . '/edit.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {

        $serialize_data = array();
        $serialize_data = $_POST['gallery']['data'];

        $data = array(
            'title' => $_POST['gallery']['title'],
            'description' => $_POST['gallery']['description'],
            'data' => serialize($serialize_data),
            'modified_time'=>date('Y-m-d H:i:s')
        );

        $gallery_id = $this->content->update_content_by_id($_POST['gallery']['id'], $data);
        $image_data = $this->uploadImageFile($gallery_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/' . $this->type . '/edit/' . $gallery_id));
    }

    public function addnew() {
        $event_title = array();
        $gallery_title = array();

        $events_data = $this->content->get_content_by_type('events');
        if (!empty($events_data)) {
            foreach ($events_data as $event) {
                $event_title[] = $event['title'];
            }
        }
        $galleries_data = $this->content->get_content_by_type('event_galleries');
        if (!empty($galleries_data)) {
            foreach ($galleries_data as $gallery) {
                $gallery_title[] = $gallery['title'];
            }
        }
        $data['remaining_title'] = array_diff($event_title, $gallery_title);



        $content = $this->load->view($this->type . '/new.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {

        $serialize_data = array();
        $serialize_data = $_POST['gallery']['data'];
        $data = array(
            'title' => $_POST['gallery']['title'],
            'description' => $_POST['gallery']['description'],
            'data' => serialize($serialize_data),
            'modified_time'=>date('Y-m-d H:i:s')
        );

        $gallery_id = $this->content->add_content($data, 'event_galleries');
        $image_data = $this->uploadImageFile($gallery_id, 'event_galleries');

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/' . $this->type . '/view/' . $gallery_id));
    }

    public function delete($id) {
        $flag = $this->content->delete_content($id);
//        $this->image->delete_content_images($id);
        redirect(site_url('admin/' . $this->type . '/index'));
    }

    public function delete_image($id, $content_id) {
        $this->image->deactivate_image($id);

        redirect(site_url('admin/' . $this->type . '/edit/' . $content_id));
    }

}

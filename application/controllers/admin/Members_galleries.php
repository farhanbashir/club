<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Members_galleries extends MY_Controller {

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
    public $type = 'members_galleries';

    function __construct() {
        parent::__construct();
        $this->load->model('hash_tag', '', TRUE);
        $this->load->model('hash_tag_image', '', TRUE);
        $this->load->model('image', '', TRUE);

        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
    }

    public function index() {
        $data = array();
        $this->load->library("pagination");
        $total_rows = $this->hash_tag->get_total_contents();

        $pagination_config = get_pagination_config($this->type . '/index', $total_rows, $this->config->item('pagination_limit'), 4);

        $this->pagination->initialize($pagination_config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $members_galleries = $this->hash_tag->get_content($page);
        $data['members_galleries'] = $members_galleries;
        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function view($id) {
        $data['members_gallery'] = $this->hash_tag->get_content_by_id($id);
        $data['members_gallery']['images'] = $this->hash_tag_image->get_content_by_id($id);

        $content = $this->load->view($this->type . '/view.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function edit($id) {
        $data['members_gallery'] = $this->hash_tag->get_content_by_id($id);
        $data['members_gallery']['images'] = $this->hash_tag_image->get_content_by_id($id);

        $content = $this->load->view($this->type . '/edit.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {
        $data = array(
            'hash_tag' => $_POST['members_gallery']['hash_tag'],
        );

        $members_gallery_id = $this->hash_tag->update_content_by_id($_POST['members_gallery']['id'], $data);
        if (!empty($_POST['members_gallery']['images'])) {
            foreach ($_POST['members_gallery']['images'] as $image) {
                $image_data[] = array(
                    'hash_tag_id' => $members_gallery_id,
                    'image' => $image
                );
            }
            $this->hash_tag_image->add_content($image_data);
        }


        redirect(site_url('admin/' . $this->type . '/edit/' . $members_gallery_id));
    }

    public function addnew() {
        $content = $this->load->view($this->type . '/new.php', $data = NULL, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {
        $data = array(
            'hash_tag' => $_POST['members_gallery']['hash_tag'],
        );

        $members_gallery_id = $this->hash_tag->add_content($data);
        if (!empty($_POST['members_gallery']['images'])) {
            foreach ($_POST['members_gallery']['images'] as $image) {
                $image_data[] = array(
                    'hash_tag_id' => $members_gallery_id,
                    'image' => $image
                );
            }


            $this->hash_tag_image->add_content($image_data);
        }
        redirect(site_url('admin/' . $this->type . '/view/' . $members_gallery_id));
    }

    public function delete($id, $status, $view = NULL) {
        $flag = $this->hash_tag->delete_content($id, $status);
//        $this->image->delete_content_images($id);
//        if (empty($view)) {
            redirect(site_url('admin/' . $this->type . '/index'));
//        } else {
//            redirect(site_url('admin/' . $this->type . '/view/' . $id));
//        }
    }

    public function delete_image($id, $hash_tag_id) {
        $this->hash_tag_image->delete_content($id);
        redirect(site_url('admin/' . $this->type . '/edit/' . $hash_tag_id));
    }

    public function search_instagram_images($tag) {

        $client_id = "20fedafd752f4516995ec9c50027a41b";
        $url = 'https://api.instagram.com/v1/tags/' . $tag . '/media/recent?client_id=' . $client_id;

        $all_result = doCurl($url);
        $decoded_results = json_decode($all_result, true);

        //Now parse through the $results array to display your results... 
        $count = 0;
        foreach ($decoded_results['data'] as $item) {
            $count++;
            $image_link = $item['images']['thumbnail']['url'];
            $low_resolution = $item['images']['low_resolution']['url'];
            $name = $item['user']['full_name'];
            $text = $item['caption']['text'];
            $item_array = array("image"=>$low_resolution,"name"=>$name,"text"=>$text);
            echo '<div  class="checkbox-wrapper col-md-6">'
            . '<input class="checkbox_images" name="members_gallery[images][]" value="' . base64_encode(json_encode($item_array)) . '" form-control" id="checkbox_' . $count . '" type="checkbox">'
            . '<img class="image_instagram" for="checkbox_' . $count . '" src="' . $image_link . '" />'
            . '</div>';
        }
    }

}

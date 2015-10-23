<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pools extends MY_Controller {

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
    public $type = 'pools';

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

        $pools = $this->content->get_content_by_type($this->type, $page);
        $data['key'] = 'all';
        $data['pools'] = $pools;
        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function kid() {
        $data = array();
        $this->load->library("pagination");
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $filter_data = $this->filter_data_and_count('Kid Pool', $page);

        $total_rows = $filter_data['count'];

        $pagination_config = get_pagination_config($this->type . '/kid', $total_rows, $this->config->item('pagination_limit'), 4);

        $this->pagination->initialize($pagination_config);
        $data["links"] = $this->pagination->create_links();
        $data['key'] = 'kid';
        $pools = !empty($filter_data['pool']) ? ($filter_data['pool']) : "";
        $data['pools'] = $pools;
        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function main() {
        $data = array();
        $this->load->library("pagination");
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $filter_data = $this->filter_data_and_count('Main Pool', $page);

        $total_rows = $filter_data['count'];

        $pagination_config = get_pagination_config($this->type . '/main', $total_rows, $this->config->item('pagination_limit'), 4);

        $this->pagination->initialize($pagination_config);

        $data["links"] = $this->pagination->create_links();

        $pools = !empty($filter_data['pool']) ? ($filter_data['pool']) : "";
        $data['key'] = 'main';
        $data['pools'] = $pools;
        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function filter_data_and_count($type, $page) {
        $filter = array();
        $pools = $this->content->get_content_by_type($this->type, $page);
        foreach ($pools as $pool) {
            $ser_data = unserialize($pool['data']);
            if ($ser_data['type'] == $type) {
                $filter['pool'][] = $pool;
            }
        }
        $filter['count'] = !empty($filter['pool']) ? count($filter['pool']) : '';
        return $filter;
    }

    public function view($id) {
        $pool = $this->content->get_content_by_id($this->type, $id);
        $data['pool'] = $pool[0];
        $images = $this->image->get_images_by_content_id($id);

        foreach ($images as $image) {
            $data['pool']['images'][] = $image['path'] . $image['name'];
        }

        $content = $this->load->view($this->type . '/view.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function edit($id) {
        $pool = $this->content->get_content_by_id($this->type, $id);
        $data['pool'] = $pool[0];
        $images = $this->image->get_images_by_content_id($id);

        foreach ($images as $image) {
            $data['pool']['images'][] = array(
                'path' => $image['path'] . $image['name'],
                'id' => $image['image_id']
            );
        }
        $content = $this->load->view($this->type . '/edit.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {
        $serialize_data = array();
        $serialize_data = $_POST['pool']['data'];
        $data = array(
            'title' => $_POST['pool']['title'],
            'description' => $_POST['pool']['description'],
            'data' => serialize($serialize_data)
        );
        $pool_id = $this->content->update_content_by_id($_POST['pool']['id'], $data);
        $image_data = $this->uploadImageFile($pool_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/' . $this->type . '/edit/' . $pool_id));
    }

    public function addnew() {
        $content = $this->load->view($this->type . '/new.php', $data = NULL, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {
        $serialize_data = array();
        $serialize_data = $_POST['pool']['data'];
        $data = array(
            'title' => $_POST['pool']['title'],
            'description' => $_POST['pool']['description'],
            'data' => serialize($serialize_data)
        );

        $pool_id = $this->content->add_content($data, $this->type);
        $image_data = $this->uploadImageFile($pool_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/' . $this->type . '/view/' . $pool_id));
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

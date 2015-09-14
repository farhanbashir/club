<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sponsors_relation extends MY_Controller {

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
    public $type = 'sponsors_relation';
    public $pages =  array('Splash Page','Information Page',"What's On Page");

    function __construct() {
        parent::__construct();
        $this->load->model('sponsor_relation_model', '', TRUE);
        $this->load->model('image', '', TRUE);

        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
    }

    public function index() {
        $data = array();
        $this->load->library("pagination");
        $total_rows = $this->sponsor_relation_model->get_total_sponsors();

        $pagination_config = get_pagination_config($this->type . '/index', $total_rows, $this->config->item('pagination_limit'), 4);

        $this->pagination->initialize($pagination_config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $sponsor_relations = $this->sponsor_relation_model->get_sponsors($page);
        $data['sponsor_relations'] = $sponsor_relations;
        $content = $this->load->view($this->type . '/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function view($id) {
        $data['sponsor_relation'] = $this->sponsor_relation_model->get_content_by_id($id);

        
        $content = $this->load->view($this->type . '/view.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function edit($id) {
        $data['sponsor_relation'] = $this->sponsor_relation_model->get_content_by_id($id);
        $data['sponsor_relation']['sponsor'] = $this->sponsor_relation_model->get_sponsor_content();
        $data['pages'] = $this->pages;
        $data['id'] = $id;
        
        $content = $this->load->view($this->type . '/edit.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {

        $data = array(
            'name' => $_POST['sponsor_relation']['title'],
            'page' => $_POST['sponsor_relation']['page'],
            'sponsor_content_id' => $_POST['sponsor_relation']['sponsor'],
        );

        $sponsor_relation_id = $this->sponsor_relation_model->update_content_by_id($_POST['sponsor_relation']['id'], $data);
        //$image_data = $this->uploadImageFile($sponsor_relation_id, $this->type);

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/' . $this->type . '/edit/' . $sponsor_relation_id));
    }

    public function addnew() {
        $data['sponsor_relation']['sponsor'] = $this->sponsor_relation_model->get_sponsor_content();
        $data['pages'] = $this->pages;

        $content = $this->load->view($this->type . '/new.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {

        $data = array(
            'name' => $_POST['sponsor_relation']['title'],
            'page' => $_POST['sponsor_relation']['page'],
            'sponsor_content_id' => $_POST['sponsor_relation']['sponsor'],
        );
        $sponsor_relation_id = $this->sponsor_relation_model->add_content($data);

        redirect(site_url('admin/' . $this->type . '/view/' . $sponsor_relation_id));
    }

    
    public function delete($id) {
        $this->sponsor_relation_model->delete_sponsor($id);
        redirect(site_url('admin/' . $this->type . '/index'));
    }
 
}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events extends CI_Controller {

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

    public $type = 'events';

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

        $pagination_config = get_pagination_config($this->type.'/index', $total_rows, $this->config->item('pagination_limit'), 4);

        $this->pagination->initialize($pagination_config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $events = $this->content->get_content_by_type($this->type , $page);
        $data['events'] = $events;
        $content = $this->load->view($this->type.'/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function view($id) {
        $event = $this->content->get_content_by_id($this->type, $id);
        $data['event'] = $event[0];
        $content = $this->load->view($this->type.'/view.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function edit($id) {
        $event = $this->content->get_content_by_id($this->type, $id);
        $data['event'] = $event[0];
        $content = $this->load->view($this->type.'/edit.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {

        $data = array(
            'title' => $_POST['event']['title'],
            'date' => $_POST['event']['date'],
            'description' => $_POST['event']['description'],
            //'link' => $_POST['event']['link']
        );

        $event_id = $this->content->update_content_by_id($_POST['event']['id'], $data);

        $this->edit($event_id);
    }

    public function addnew() {
        $content = $this->load->view($this->type.'/new.php', $data = NULL, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {

        $data = array(
            'title' => $_POST['event']['title'],
            'date' => $_POST['event']['date'],
            'description' => $_POST['event']['description'],
            'link' => $_POST['event']['link']
        );

        $event_id = $this->eventModel->add_event($data);
        $this->view($event_id);
    }

    public function delete($id) {
        $flag = $this->eventModel->delete_event($id);

        redirect(site_url('admin/'.$this->type.'/index'));
    }

}

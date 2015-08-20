<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends MY_Controller {

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
    function __construct() {
        parent::__construct();
        $this->load->model('pagemodel', '', TRUE);
        $this->load->model('image', '', TRUE);

        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
    }

    public function delete_image($param) {
        $this->image->deactivate_image($param[0]);
        redirect(site_url('admin/page/' . $param[1]));
    }

    function _remap($method, $params = NULL) {
        if (method_exists($this, $method)) {
            $this->$method($params);
        } else {
            $this->index($method);
        }
    }

    public function index($page_slug) {
        $pages = array(
            'tv_schedule',
            'accumulator',
            'about_us',
            'contact_us',
            'membership_enquiries', 
            'guest_policy_fees',
            'fringe_benefits_salon_barbers',
            'library',
            'multipurpose_court',
            'adds',
            'diving',
            'football',
            'sailing',
            'photography',
            'the_gallery',
            'creche',
            'creche',
            'goodies',
            'dry_cleaners',
            'liquor_shop',
            'bus_schedule',
            'tennis',
            'squash_and_racketball',
            'badminton'
            );
        if (in_array($page_slug, $pages)) {
            $page = $this->pagemodel->get_page_by_key($page_slug);
            if (!empty($page)) {
                $data = array('page' => $page[0]);

                $images = $this->image->get_images_by_page_id($page[0]['page_id']);

                foreach ($images as $image) {
                    $data['page']['images'][] = array(
                        'path' => $image['path'] . $image['name'],
                        'id' => $image['image_id']
                    );
                }

                $content = $this->load->view($page_slug . '/form.php', $data, true);
                $this->load->view('welcome_message', array('content' => $content));
            } else {
                $this->add_page($page_slug);
                $page = $this->pagemodel->get_page_by_key($page_slug);


                $data = array('page' => $page[0]);
                $images = $this->image->get_images_by_page_id($page[0]['page_id']);

                foreach ($images as $image) {
                    $data['page']['images'][] = $image['path'] . $image['name'];
                }

                $content = $this->load->view($page_slug . '/form.php', $data, true);
                $this->load->view('welcome_message', array('content' => $content));
            }
        } else {
            redirect(site_url('admin/dashboard'));
        }
    }

    public function add_page($key, $content = NULL) {
        $page = array(
            'key' => (!empty($key)) ? $key : '',
            'content' => (!empty($content)) ? $content : '',
        );
        $this->pagemodel->add_page($page);
    }

    public function update() {


        $data = array(
        'key' => $_POST['page']['key'],
        'content' => $_POST['page']['content'],
        'data' => !empty($_POST['page']['data'])? serialize($_POST['page']['data']):'',
        );
        
        $page_id = $this->pagemodel->update_page_by_id($_POST['page']['id'], $data);
        $image_data = $this->uploadPageImageFile($_POST['page']['id'], $_POST['page']['key']);

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/page/' . $_POST['page']['key']));
    }

}

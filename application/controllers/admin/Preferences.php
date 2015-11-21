<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Preferences extends MY_Controller {

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
        $this->load->model('content', '', TRUE);
        $this->load->model('members_gallery_images_model', '', TRUE);

        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
    }

    public function delete_image($param) {
        $this->image->deactivate_image($param[0]);
        redirect(site_url('admin/page/' . $param[1]));
    }

    public function delete_member_gallery_image($param) {
        $this->members_gallery_images_model->delete_image($param[0]);
        redirect(site_url('admin/page/' . $param[1]));
    }

    public function index() {
        $page_slug = 'preferences';
        $page = $this->pagemodel->get_page_by_key($page_slug);
        $data = array('page' => $page[0]);
        $content = $this->load->view($page_slug . '/form.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function update() {
         $page_slug = 'preferences';
         $data = array();
         $page_data = $this->pagemodel->get_page_by_key($page_slug);
         if(count($page_data) > 0)
         {
             $data = unserialize($page_data[0]['data']);
         }    
         
         if ($_FILES['android_image']['error'] == 0) {
            $image_data = $this->uploadPreferencesImage($_POST['page']['id'], $_POST['page']['key'],'android_image');
            if ($this->uploadSuccess) {
                $data['homepage_images']['android_image'] = $image_data['path'].$image_data['name'];        
            }
            
        }

        if ($_FILES['iphone_image']['error'] == 0) {
            $image_data = $this->uploadPreferencesImage($_POST['page']['id'], $_POST['page']['key'],'iphone_image');
            if ($this->uploadSuccess) {
                $data['homepage_images']['iphone_image'] = $image_data['path'].$image_data['name'];        
            }
            
        }

        if ($_FILES['ipad_image']['error'] == 0) {
            $image_data = $this->uploadPreferencesImage($_POST['page']['id'], $_POST['page']['key'],'ipad_image');
            if ($this->uploadSuccess) {
                $data['homepage_images']['ipad_image'] = $image_data['path'].$image_data['name'];        
            }
            
        }

        if ($_FILES['tablet_image']['error'] == 0) {
            $image_data = $this->uploadPreferencesImage($_POST['page']['id'], $_POST['page']['key'],'tablet_image');
            if ($this->uploadSuccess) {
                $data['homepage_images']['tablet_image'] = $image_data['path'].$image_data['name'];        
            }
            
        }

        $data_array = array(
                'key' => $_POST['page']['key'],
                'data' => serialize($data),
            );

        $page_id = $this->pagemodel->update_page_by_id($_POST['page']['id'], $data_array);

        redirect(site_url('admin/preferences'));
    }

    
}

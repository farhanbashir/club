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
            'badminton',
            'gym_personal_training',
            'private_parties',
            'snooker',
            'parties',
            'sauna_and_steam_room',
            'members_gallery',
            'main_pool',
            'kid_pool',
            'main_beach',
            'adults_beach'
        );
        if (in_array($page_slug, $pages)) {
            $page = $this->pagemodel->get_page_by_key($page_slug);
            if (!empty($page)) {
                $data = array('page' => $page[0]);

                $images = $this->image->get_images_by_page_id($page[0]['page_id']);

                if ($page_slug == 'tennis' || $page_slug == 'squash_and_racketball' || $page_slug == 'badminton' || $page_slug == 'snooker') {
                    $news = $this->content->get_content_by_type($page_slug . 'news');
                    foreach ($news as $new) {
                        $image = $this->image->get_images_by_content_id($new['content_id']);
                        $data['page'][$page_slug . 'news'][] = array(
                            'image' => !empty($image[0]) ? $image[0] : '',
                            'content_id' => $new['content_id'],
                            'title' => $new['title'],
                            'description' => $new['description'],
                            'detail_description' => $new['detail_description'],
                            'is_active' => $new['is_active']
                        );
                    }
                } elseif ($page_slug == 'members_gallery') {
                    $data['page']['images'] = $this->members_gallery_images_model->get_all_images();
                }

                foreach ($images as $image) {
                    $data['page']['images'][] = array(
                        'path' => $image['path'] . $image['name'],
                        'id' => $image['image_id'],
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

        $data_serialize = !empty($_POST['page']['data']) ? $_POST['page']['data'] : '';

        if ($_POST['page']['key'] == 'private_parties' || $_POST['page']['key'] == 'fringe_benefits_salon_barbers' || $_POST['page']['key'] == 'sauna_and_steam_room') {
            if (isset($_FILES['pdf']['name'])) {
                if(!empty($_FILES['pdf']['name']))
                {
                    $pdf_data = $this->uploadPagePdfFile($_POST['page']['id'], $_POST['page']['key']);
                    $data_serialize['pdf'] = $pdf_data['file'];    
                }
                else {
                    $data_serialize['pdf'] = $_POST['page']['pdf_file'];
                }    
                
                $data = array(
                    'key' => $_POST['page']['key'],
                    'content' => !empty($_POST['page']['content']) ? $_POST['page']['content'] : '',
                    'data' => serialize($data_serialize),
                );
            } else {
                $data_serialize['pdf'] = $_POST['page']['pdf_file'];
                $data = array(
                    'key' => $_POST['page']['key'],
                    'content' => !empty($_POST['page']['content']) ? $_POST['page']['content'] : '',
                    'data' => serialize($data_serialize),
                );
            }
        } elseif ($_POST['page']['key'] == 'members_gallery') {
            $data = array(
                'key' => $_POST['page']['key'],
                'content' => !empty($_POST['page']['content']) ? $_POST['page']['content'] : '',
                'data' => serialize($data_serialize),
            );
            if (!empty($_POST['members_gallery']['images'])) {
                $this->members_gallery_images_model->add_images($_POST['members_gallery']['images']);
            }
        } else {
            $data = array(
                'key' => $_POST['page']['key'],
                'content' => !empty($_POST['page']['content']) ? $_POST['page']['content'] : '',
                'data' => !empty($data_serialize) ? serialize($data_serialize) : '',
            );
        }

        $page_id = $this->pagemodel->update_page_by_id($_POST['page']['id'], $data);
        if (!empty($_FILES['userfile']['name'])) {
            $image_data = $this->uploadPageImageFile($_POST['page']['id'], $_POST['page']['key']);
        }

        if ($this->uploadSuccess) {
            $this->image->add_images($image_data);
        }

        redirect(site_url('admin/page/' . $_POST['page']['key']));
    }

    public function remove_pdf($param) {
        $page = $this->pagemodel->get_page_by_id($param[0]);
        $data = unserialize($page[0]['data']);
        $data['pdf'] = "";
        $page_id = $this->pagemodel->update_page_by_id($param[0], $data = array('data' => serialize($data)));
        redirect(site_url('admin/page/' . $param[1]));
    }

}

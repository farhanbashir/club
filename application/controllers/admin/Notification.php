<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification extends MY_Controller {

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
    public $type = 'classes';
    public $receivers = array("All Users","Android Only","Iphone Only");

    function __construct() {
        parent::__construct();
        $this->load->model('notifications', '', TRUE);
        $this->load->model('device', '', TRUE);
        
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        }
    }

    public function index() {
        $data = array();
        $this->load->library("pagination");
        $total_rows = $this->notifications->get_total_notifications();

        $pagination_config = get_pagination_config('notification/index', $total_rows, $this->config->item('pagination_limit'), 4);

        $this->pagination->initialize($pagination_config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["links"] = $this->pagination->create_links();

        $notifications = $this->notifications->get_notifications($page);
        $data['notifications'] = $notifications;
        $data['receivers'] = $this->receivers;
        $content = $this->load->view('notifications/tabular.php', $data, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function addnew() {
        $content = $this->load->view('notifications/new.php', $data = NULL, true);
        $this->load->view('welcome_message', array('content' => $content));
    }

    public function submit() {

        set_time_limit(0);
        $data = array(
            'send_to' => $_POST['send_to'],
            'notification' => $_POST['notification'],
        );

        $notification_id = $this->notifications->add_notification($data);

        $this->send_notifications($data['send_to'],$data['notification']);

        redirect(site_url('admin/notification'));
    }

    private function send_notifications($send_to, $notification)
    {
        $file_url = asset_url("files/".$this->config->item('pem'));
        
        if($send_to == 0)
        {
            $devices = $this->device->get_all_devices();
            if(count($devices) > 0)
            {
                $devices_ids = array();
                foreach ($devices as $device) {
                       if($device['type'] == 0 && isset($device['uid']))
                       {
                            send_notification_iphone($device['uid'], $notification, $file_url);
                       } 
                       elseif($device['type'] == 1 && isset($device['uid']))
                       {
                            $devices_ids[] = $device['uid'];
                            //send_notification_android($device['uid'], $notification);
                       } 
                }

                if(count($devices_ids) > 0)
                {
                    send_notification_android($devices_ids, $notification);
                }

            }    
        }   
        elseif($send_to == 1)
        {
            $devices = $this->device->get_android_devices();
            if(count($devices) > 0)
            {
                $devices_ids = array();
                foreach ($devices as $device) {
                    if(isset($device['uid']))
                    {
                        $devices_ids[] = $device['uid'];
                    }    
                       
                }   

                if(count($devices_ids) > 0)
                {
                    send_notification_android($devices_ids, $notification);
                }    
            }
        } 
        elseif($send_to == 2) 
        {
            $devices = $this->device->get_iphone_devices();
            if(count($devices) > 0)
            {
                foreach ($devices as $device) {
                    if(isset($device['uid']))
                    {
                        send_notification_iphone($device['uid'], $notification, $file_url);
                       //send_notification_android($device['uid'], $notification, $file_url); 
                    }    
                       
                }             
            }
        }

    }

    public function delete($id, $status, $view = NULL) {
        $flag = $this->content->delete_content($id, $status);
//        $this->image->delete_content_images($id);
        if (empty($view)) {
            redirect(site_url('admin/' . $this->type . '/index'));
        } else {
            redirect(site_url('admin/' . $this->type . '/view/' . $id));
        }
    }

    public function delete_image($id, $content_id) {
        $this->image->deactivate_image($id);

        redirect(site_url('admin/' . $this->type . '/edit/' . $content_id));
    }

    public function remove_pdf($pdf_id, $content_id, $action) {
        $this->pdf->deactive_pdf($pdf_id);
        redirect(site_url('admin/' . $this->type . '/' . $action . '/' . $content_id));
    }

}

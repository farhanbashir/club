<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('content','',TRUE);
	   $this->load->model('user','',TRUE);
	   $this->load->model('device','',TRUE);
	   //$this->load->model('news','',TRUE);
	 }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	function login_post()
    {
    	$data = array();

    	$username = $this->post('username');
    	$password = $this->post('password');
        $device_id = $this->post('device_id');
        $device_type = $this->post('device_type');

        if(!$username || !$password)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Username or password is incorrect";
            $this->response($data, 400);
        }
        else
        {

            $result = $this->user->login($username, $password, 0);

            if(is_array($result))
            {
                $device = $this->device->get_user_device($result[0]->user_id);
                if(count($device) > 0)
                {
                    //update device table
                    $device_data = array('uid'=>$device_id, 'type'=>$device_type);
                    $this->device->edit_device($result[0]->user_id, $device_data);
                }
                else
                {
                    if(isset($device_type) && isset($device_id))
                    {

                        //insert device table
                        $device_data = array('user_id'=>$result[0]->user_id,'uid'=>$device_id, 'type'=>$device_type);
                        $this->device->insert_device($device_data);
                    }
                }
                $data["header"]["error"] = "0";
                $data["header"]["message"] = "Login successfully";
            }
            else
            {
                $data["header"]["error"] = "1";
                $data["header"]["message"] = "Username or password is incorrect";
            }

            $this->response($data);
        }
    }

    function forgetPassword_post()
    {
    	$data = array();

        $username = $this->post('username');

        if(!$username)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide username";
            $this->response($data,400);
        }
        else
        {
            //$result = $this->news->get_news();

//            if(count($result) > 0)
//            {
//                $data["header"]["error"] = "0";
//                $data["body"] = $result;
//            }
//            else
//            {
//                $data["header"]["error"] = "1";
//                $data["header"]["message"] = "No news found.";
//            }
            $data["header"]["error"] = "0";
            $data["header"]["message"] = "Admin will contact you shortly.";

            $this->response($data);
        }


    }

    function getContent_post()
    {
        $type = $this->post('type');

        $result = $this->content->get_content_by_type($type);

        if(count($result) > 0)
        {
            $data["header"]["error"] = "0";
            $data["body"] = $result;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }
}

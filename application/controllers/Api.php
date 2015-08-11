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
	   $this->load->model('image','',TRUE);
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

    function getCourseById_post()
    {
        $content_id = $this->post('id');
        $type = 'courses';
        $return = array();

        if(!$content_id)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide id";
            $this->response($data,400);
        }

        $result = $this->content->get_content_by_id($type, $content_id);
        $images = $this->image->get_images_by_content_id($content_id);

        if(count($result) > 0)
        {
            $return = $result[0];
            $result_images = array();
            if(count($images) > 0)
            {
                foreach ($images as $key => $value) {
                    $result_images[] = $value['path'];
                }
            }    
            $return['images'] = $result_images;

            unset($return['data']);
            unset($return['content_type_id']);
            unset($return['detail_description']);
            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }

    function getEventById_post()
    {
        $content_id = $this->post('id');
        $type = 'events';
        $return = array();

        if(!$content_id)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide id";
            $this->response($data,400);
        }

        $result = $this->content->get_content_by_id($type, $content_id);
        $images = $this->image->get_images_by_content_id($content_id);
        if(count($result) > 0)
        {
            $return = $result[0];
            $result_images = array();
            if(count($images) > 0)
            {
                foreach ($images as $key => $value) {
                    $result_images[] = $value['path'];
                }
            }    
            $return['images'] = $result_images;
            unset($return['data']);
            unset($return['content_type_id']);
            unset($return['detail_description']);
            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }

    function getResturantById_post()
    {
        $content_id = $this->post('id');
        $type = 'restaurants';
        $return = array();

        if(!$content_id)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide id";
            $this->response($data,400);
        }

        $result = $this->content->get_content_by_id($type, $content_id);
        $images = $this->image->get_images_by_content_id($content_id);

        if(count($result) > 0)
        {
            $additional_fields = unserialize($result[0]['data']);
            $return = array_merge($result[0],$additional_fields);
            $result_images = array();
            if(count($images) > 0)
            {
                foreach ($images as $key => $value) {
                    $result_images[] = $value['path'];
                }
            }    
            $return['images'] = $result_images;

            //removing unwanted fields
            unset($return['start_date']);
            unset($return['end_date']);
            unset($return['data']);
            unset($return['content_type_id']);
            unset($return['detail_description']);

            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }

    function getPromotionById_post()
    {
        $content_id = $this->post('id');
        $type = 'promotions';
        $return = array();

        if(!$content_id)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide id";
            $this->response($data,400);
        }

        $result = $this->content->get_content_by_id($type, $content_id);
        $images = $this->image->get_images_by_content_id($content_id);
        
        if(count($result) > 0)
        {
            $return = $result[0];
            //$additional_fields = unserialize($result[0]['data']);
            //$return = array_merge($result[0],$additional_fields);
            $result_images = array();
            if(count($images) > 0)
            {
                foreach ($images as $key => $value) {
                    $result_images[] = $value['path'];
                }
            }    
            $return['images'] = $result_images;

            //removing unwanted fields
            unset($return['start_date']);
            unset($return['end_date']);
            unset($return['data']);
            unset($return['content_type_id']);
            unset($return['detail_description']);

            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }

    function getCampById_post()
    {
        $content_id = $this->post('id');
        $type = 'camps';
        $return = array();

        if(!$content_id)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide id";
            $this->response($data,400);
        }

        $result = $this->content->get_content_by_id($type, $content_id);
        $images = $this->image->get_images_by_content_id($content_id);
        if(count($result) > 0)
        {
            $return = $result[0];
            $result_images = array();
            if(count($images) > 0)
            {
                foreach ($images as $key => $value) {
                    $result_images[] = $value['path'];
                }
            }    
            $return['images'] = $result_images;
            unset($return['data']);
            unset($return['content_type_id']);
            unset($return['detail_description']);
            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }

    function getActivityById_post()
    {
        $content_id = $this->post('id');
        $type = 'activities';
        $return = array();

        if(!$content_id)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide id";
            $this->response($data,400);
        }

        $result = $this->content->get_content_by_id($type, $content_id);
        $images = $this->image->get_images_by_content_id($content_id);
        if(count($result) > 0)
        {
            $return = $result[0];
            $result_images = array();
            if(count($images) > 0)
            {
                foreach ($images as $key => $value) {
                    $result_images[] = $value['path'];
                }
            }    
            $return['images'] = $result_images;
            unset($return['data']);
            unset($return['content_type_id']);
            unset($return['detail_description']);
            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }

    function getPoolById_post()
    {
        $content_id = $this->post('id');
        $type = 'pools';
        $return = array();

        if(!$content_id)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide id";
            $this->response($data,400);
        }

        $result = $this->content->get_content_by_id($type, $content_id);
        $images = $this->image->get_images_by_content_id($content_id);

        if(count($result) > 0)
        {
            $additional_fields = unserialize($result[0]['data']);
            $return = array_merge($result[0],$additional_fields);
            $result_images = array();
            if(count($images) > 0)
            {
                foreach ($images as $key => $value) {
                    $result_images[] = $value['path'];
                }
            }    
            $return['images'] = $result_images;

            //removing unwanted fields
            unset($return['start_date']);
            unset($return['end_date']);
            unset($return['data']);
            unset($return['content_type_id']);
            unset($return['detail_description']);

            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }

    function getBeachById_post()
    {
        $content_id = $this->post('id');
        $type = 'beaches';
        $return = array();

        if(!$content_id)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide id";
            $this->response($data,400);
        }

        $result = $this->content->get_content_by_id($type, $content_id);
        $images = $this->image->get_images_by_content_id($content_id);

        if(count($result) > 0)
        {
            $additional_fields = unserialize($result[0]['data']);
            $return = array_merge($result[0],$additional_fields);
            $result_images = array();
            if(count($images) > 0)
            {
                foreach ($images as $key => $value) {
                    $result_images[] = $value['path'];
                }
            }    
            $return['images'] = $result_images;

            //removing unwanted fields
            unset($return['start_date']);
            unset($return['end_date']);
            unset($return['data']);
            unset($return['content_type_id']);
            unset($return['detail_description']);

            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }

    function getClassById_post()
    {
        $content_id = $this->post('id');
        $type = 'classes';
        $return = array();

        if(!$content_id)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide id";
            $this->response($data,400);
        }

        $result = $this->content->get_content_by_id($type, $content_id);
        $images = $this->image->get_images_by_content_id($content_id);

        if(count($result) > 0)
        {
            $additional_fields = unserialize($result[0]['data']);
            $return = array_merge($result[0],$additional_fields);
            $result_images = array();
            if(count($images) > 0)
            {
                foreach ($images as $key => $value) {
                    $result_images[] = $value['path'];
                }
            }    
            $return['images'] = $result_images;

            //removing unwanted fields
            //unset($return['start_date']);
            unset($return['end_date']);
            unset($return['data']);
            unset($return['content_type_id']);
            unset($return['detail_description']);

            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found.";
        }
        $this->response($data);
    }


}

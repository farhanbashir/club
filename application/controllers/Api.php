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
	   $this->load->model('page','',TRUE);
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
            $return = $this->__makeData($type, $result);
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

    function getImagesArray($content_id)
    {
        $images = $this->image->get_images_by_content_id($content_id);
        if(count($images) > 0)
        {
            $return = array();
            foreach($images as $image)
            {
                $return[] = $image['path'].$image['name'];
            }    
            return $return;
        }   
        else
        {
            return array();    
        } 
        
    }

    function __makeData($type, $data)
    {
        $return = array();
        switch ($type) {
            case 'events':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }    
                    
                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                //$return = $data;
                break;
            case 'courses':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;
            case 'restaurants':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['start_date']);
                    unset($return[$i]['end_date']);
                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;
            case 'promotions':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    unset($return[$i]['start_date']);
                    unset($return[$i]['end_date']);
                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;
            case 'pools':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['start_date']);
                    unset($return[$i]['end_date']);
                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;
            case 'beaches':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['start_date']);
                    unset($return[$i]['end_date']);
                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;
            case 'classes':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['end_date']);
                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;
            case 'activities':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;
            case 'camps':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;
            default:
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    $i++;
                }
                break;
        }
        return $return;
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
                    $result_images[] = $value['path'].$value['name'];
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

    function getPageByKey_post()
    {
        $key = $this->post('key');
        $return = array();

        if(!$key)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide key";
            $this->response($data,400);
        }

        $result = $this->page->get_page_by_key($key);
        
        if(count($result) > 0)
        {
            $data["header"]["error"] = "0";
            $data["body"] = $result;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found for this key.";
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
                    $result_images[] = $value['path'].$value['name'];
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
                    $result_images[] = $value['path'].$value['name'];
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
                    $result_images[] = $value['path'].$value['name'];
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
                    $result_images[] = $value['path'].$value['name'];
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
                    $result_images[] = $value['path'].$value['name'];
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
                    $result_images[] = $value['path'].$value['name'];
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
                    $result_images[] = $value['path'].$value['name'];
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
                    $result_images[] = $value['path'].$value['name'];
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

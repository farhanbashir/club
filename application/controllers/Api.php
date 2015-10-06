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
       $this->load->model('pagemodel','',TRUE);
       $this->load->model('sponsor_relation_model','',TRUE);
	   $this->load->model('hash_tag_image','',TRUE);
       $this->load->model('members_gallery_images_model', '', TRUE);
       $this->load->model('pdf', '', TRUE);
	   //$this->load->model('news','',TRUE);
	 }

	public function index()
	{
		$this->load->view('welcome_message');
	}

    function test_post()
    {
        $postdata = array();
            $postdata['apikey'] = $this->config->item('club_apiKey');
            $postdata['username'] = 'tcadmuser';
            $postdata['userpass'] = 'LauraDunn';
            $postdata['post'] = true;
            $url = $this->config->item('club_authentication_url');

            $result = doCurl($url,$postdata); 
            echo $result;die;
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
            $postdata = array();
            $postdata['apikey'] = $this->config->item('club_apiKey');
            $postdata['username'] = $username;
            $postdata['userpass'] = $password;
            $postdata['post'] = true;
            $url = $this->config->item('club_authentication_url');

            $result = doCurl($url,$postdata); 
            $xml = simplexml_load_string($result);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            //$result = $this->user->login($username, $password, 0);

            if(isset($array['reply']['membership']))
            {
                // $device = $this->device->get_user_device($result[0]->user_id);
                // if(count($device) > 0)
                // {
                //     //update device table
                //     $device_data = array('uid'=>$device_id, 'type'=>$device_type);
                //     $this->device->edit_device($result[0]->user_id, $device_data);
                // }
                // else
                // {
                //     if(isset($device_type) && isset($device_id))
                //     {

                //         //insert device table
                //         $device_data = array('user_id'=>$result[0]->user_id,'uid'=>$device_id, 'type'=>$device_type);
                //         $this->device->insert_device($device_data);
                //     }
                // }
                $data["header"]["error"] = "0";
                $data["header"]["message"] = "Login successfully";
                $data['body'] = $array['reply'];
            }
            else
            {
                $data["header"]["error"] = "1";
                $data["header"]["message"] = $array['reply']['loginInfo'];//"Username or password is incorrect";
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
            $return = $this->__makeContentData($type, $result);
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

    function getImagesArray($id, $type='content')
    {
        if($type == 'content')
        {
            $images = $this->image->get_images_by_content_id($id);
        }   
        else
        {
            $images = $this->image->get_images_by_page_id($id);
        } 
        
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

    function __removePastContent($data)
    {
        // debug(strtotime('2015-08-22 21:23:49'));
        // debug(strtotime('2015-08-22'),1);
        
        $return = array();
        foreach($data as $val)
        {
            $end_date = date('Y-m-d', strtotime($val['start_date']));
            if($val['start_date'] >= date('Y-m-d') || $val['end_date'] >= date('Y-m-d'))
            {
                $return[] = $val;
            }    
            //if($val['end_date'])
        }    
        return $return;
    }

    function __enquireObject($data)
    {
        if(isset($data['email']) || isset($data['enquire']))
        {
            $temp = $data;
            
            if(isset($temp['enquire']))
            {
                $data['enquiry']['phone'] = $temp['enquire'];
                unset($data['enquire']);
            }

            if(isset($temp['email']))
            {
                $data['enquiry']['email'] = $temp['email'];
                unset($data['email']);
            }    
                

            
            if(isset($temp['email_label']))
            {
                $data['enquiry']['label'] = $temp['email_label'];
                unset($data['email_label']);
            }

            if(isset($temp['enquire_label']))
            {
                $data['enquiry']['label'] = $temp['enquire_label'];
                unset($data['enquire_label']);
            }

            if(isset($temp['email_status']))
            {
                $data['enquiry']['status'] = $temp['email_status'];
                unset($data['email_status']);
            }

            if(isset($temp['enquire_status']))
            {
                $data['enquiry']['status'] = $temp['enquire_status'];
                unset($data['enquire_status']);
            }    

            //if status is not set
            if(!isset($data['status']))
                $data['enquiry']['status'] = 'off';
                
        }   
        
        return $data;
         
    }

    function __makeContentData($type, $data)
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
                    $return[$i] = $this->__enquireObject($return[$i]);
                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                $return = $this->__removePastContent($return);
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

                    $return[$i]['description'] = $return[$i]['detail_description'];
                    $return[$i] = $this->__enquireObject($return[$i]);
                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                $return = $this->__removePastContent($return);
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
                    $return[$i] = $this->__enquireObject($return[$i]);
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
                    $return[$i] = $this->__enquireObject($return[$i]);
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
                    $return[$i] = $this->__enquireObject($return[$i]);
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
                    $return[$i] = $this->__enquireObject($return[$i]);
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
                    $pdf = $this->pdf->get_pdf($value['content_id']);
                    if(count($pdf) > 0)
                    {
                        $return[$i]['file'] = $pdf[0]['path'];    
                    }    
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    $return[$i] = $this->__enquireObject($return[$i]);
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
                    $return[$i] = $this->__enquireObject($return[$i]);
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
                    $return[$i] = $this->__enquireObject($return[$i]);
                    unset($return[$i]['data']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;
            case 'event_galleries':
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
                    $return[$i] = $this->__enquireObject($return[$i]);
                    unset($return[$i]['data']);
                    unset($return[$i]['start_date']);
                    unset($return[$i]['end_date']);
                    unset($return[$i]['content_type_id']);
                    unset($return[$i]['detail_description']);
                    $i++;
                }
                break;    
            case 'sponsors':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['content_id']);
                    $return[$i]['images'] = $images;
                    $return[$i]['link'] = $return[$i]['description'];
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    $return[$i] = $this->__enquireObject($return[$i]);
                    unset($return[$i]['data']);
                    unset($return[$i]['description']);
                    unset($return[$i]['start_date']);
                    unset($return[$i]['end_date']);
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
                    $return[$i] = $this->__enquireObject($return[$i]);
                    $i++;
                }
                break;
        }
        return $return;
    }

    function __makePageData($type, $data)
    {
        $return = array();
        switch ($type) {
            case 'accumulator':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }    
                    
                    unset($return[$i]['data']);
                    $i++;
                }
                //$return = $data;
                break;
            case 'tv_schedule':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;
            case 'contact_us':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    // $images = $this->getImagesArray($value['page_id'],'page');
                    // $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;
            case 'about_us':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    // $images = $this->getImagesArray($value['page_id'],'page');
                    // $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;    
            case 'guest_policy_fees':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    // $images = $this->getImagesArray($value['page_id'],'page');
                    // $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    unset($return[$i]['data']);
                    $i++;
                }
                break;
            case 'membership_enquiries':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    // $images = $this->getImagesArray($value['page_id'],'page');
                    // $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;
            case 'parties':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    // $images = $this->getImagesArray($value['page_id'],'page');
                    // $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;    
            case 'fringe_benefits_salon_barbers':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    if(isset($return[$i]['pdf']))
                    {
                        $return[$i]['file'] = $return[$i]['pdf'];
                        unset($return[$i]['pdf']);    
                    }

                    unset($return[$i]['data']);
                    unset($return[$i]['content']);
                    $i++;
                }
                break;    
            case 'sauna_and_steam_room':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    if(isset($return[$i]['pdf']))
                    {
                        $return[$i]['file'] = $return[$i]['pdf'];
                        unset($return[$i]['pdf']);    
                    }

                    unset($return[$i]['data']);
                    unset($return[$i]['content']);
                    $i++;
                }
                break;        
            case 'library':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;        
            case 'multipurpose_court':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;            
            case 'adds':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;                
            case 'diving':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;                    
            case 'football':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;                        
            case 'sailing':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'],'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);
                    $i++;
                }
                break;                            
            case 'gym_personal_training':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'], 'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    //if(is_array($additional_fields))
                    if(isset($additional_fields['gym']) && is_array($additional_fields['gym']))
                    {
                        $gyms = array();
                        foreach($additional_fields['gym'] as $gym)
                        {
                            $gyms[] = $gym;
                        }    
                        $return[$i]['trainers'] = $gyms;
                        //$return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    if(isset($additional_fields['enquire']))
                    {
                        $return[$i]['enquire'] = $additional_fields['enquire'];
                    }    

                    unset($return[$i]['data']);
                    $i++;
                }
                break;
            case 'tennis':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'], 'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    $news = $this->content->get_content_by_type('tennisnews');
                    foreach ($news as $new) {
                        $image = $this->image->get_images_by_content_id($new['content_id']);
                        $return[$i]['news'][] = array(
                            'image' => !empty($image[0]) ? $image[0]['path'].$image[0]['name'] : '',
                            'content_id' => $new['content_id'],
                            'title' => $new['title'],
                            'description' => $new['description'],
                            'detail_description' => $new['detail_description'],
                        );
                    }
                    //$return[$i]['news'] = $news;
                    unset($return[$i]['data']);
                    $i++;
                }
                break;    
            case 'snooker':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'], 'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    $news = $this->content->get_content_by_type('snookernews');
                    foreach ($news as $new) {
                        $image = $this->image->get_images_by_content_id($new['content_id']);
                        $return[$i]['news'][] = array(
                            'image' => !empty($image[0]) ? $image[0]['path'].$image[0]['name'] : '',
                            'content_id' => $new['content_id'],
                            'title' => $new['title'],
                            'description' => $new['description'],
                            'detail_description' => $new['detail_description'],
                        );
                    }
                    //$return[$i]['news'] = $news;
                    unset($return[$i]['data']);
                    $i++;
                }
                break;        
            case 'badminton':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'], 'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    $news = $this->content->get_content_by_type('badmintonnews');
                    foreach ($news as $new) {
                        $image = $this->image->get_images_by_content_id($new['content_id']);
                        $return[$i]['news'][] = array(
                            'image' => !empty($image[0]) ? $image[0]['path'].$image[0]['name'] : '',
                            'content_id' => $new['content_id'],
                            'title' => $new['title'],
                            'description' => $new['description'],
                            'detail_description' => $new['detail_description'],
                        );
                    }
                    //$return[$i]['news'] = $news;
                    unset($return[$i]['data']);
                    $i++;
                }
                break;
            case 'squash_and_racketball':
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'], 'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }
                    $news = $this->content->get_content_by_type('squash_and_racketballnews');
                    foreach ($news as $new) {
                        $image = $this->image->get_images_by_content_id($new['content_id']);
                        $return[$i]['news'][] = array(
                            'image' => !empty($image[0]) ? $image[0]['path'].$image[0]['name'] : '',
                            'content_id' => $new['content_id'],
                            'title' => $new['title'],
                            'description' => $new['description'],
                            'detail_description' => $new['detail_description'],
                        );
                    }
                    //$return[$i]['news'] = $news;
                    unset($return[$i]['data']);
                    $i++;
                }
                break;            
            default:
                $i=0;
                $return = $data;
                foreach ($return as $key => $value) {
                    $images = $this->getImagesArray($value['page_id'], 'page');
                    $return[$i]['images'] = $images;
                    $additional_fields = unserialize($return[$i]['data']);
                    if(is_array($additional_fields))
                    {
                        $return[$i] = array_merge($return[$i],$additional_fields);    
                    }

                    unset($return[$i]['data']);    
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
            
            $additional_fields = unserialize($return['data']);
            if(is_array($additional_fields))
            {
                $return = array_merge($return,$additional_fields);    
            }

            $return = $this->__enquireObject($return);

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

        $result = $this->pagemodel->get_page_by_key($key);
        
        if(count($result) > 0)
        {
            $return = $this->__makePageData($key, $result);
            // $images = $this->image->get_images_by_page_id($result[0]['page_id']);
            // $result_images = array();
            // if(count($images) > 0)
            // {
            //     foreach ($images as $key => $value) {
            //         $result_images[] = $value['path'].$value['name'];
            //     }
            // }
            // $result['images'] = $result_images;

            $data["header"]["error"] = "0";
            $data["body"] = $return;
        }
        else
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "No record found for this key.";
        }
        $this->response($data);
    }

    function reservationForm_post()
    {
        $type = $this->post('type');
        $membership = $this->post('membership');
        $email = $this->post('email');
        $first_name = $this->post('first_name');
        $last_name = $this->post('last_name');
        $content_id = $this->post('content_id');

        $data["header"]["error"] = "0";
        $data["header"]["message"] = "Admin will contact you";
        $this->response($data,200);
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

            $additional_fields = unserialize($return['data']);
            if(is_array($additional_fields))
            {
                $return = array_merge($return,$additional_fields);    
            }

            $return = $this->__enquireObject($return);
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
            

            $return = $this->__enquireObject($return);

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
            $additional_fields = unserialize($return['data']);
            if(is_array($additional_fields))
            {
                $return = array_merge($return,$additional_fields);    
            }

            $return = $this->__enquireObject($return);
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
            $additional_fields = unserialize($return['data']);
            if(is_array($additional_fields))
            {
                $return = array_merge($return,$additional_fields);    
            }

            $return = $this->__enquireObject($return);

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

    function getGalleryById_post()
    {
        $content_id = $this->post('id');
        $type = 'galleries';
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
            $additional_fields = unserialize($return['data']);
            if(is_array($additional_fields))
            {
                $return = array_merge($return,$additional_fields);    
            }

            $return = $this->__enquireObject($return);

            unset($return['data']);
            unset($return['start_date']);
            unset($return['end_date']);
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
            $additional_fields = unserialize($return['data']);
            if(is_array($additional_fields))
            {
                $return = array_merge($return,$additional_fields);    
            }

            $return = $this->__enquireObject($return);

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
            
            $return = $this->__enquireObject($return);

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
            
            $return = $this->__enquireObject($return);

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
        $pdf = $this->pdf->get_pdf($content_id);
                    
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
            if(count($pdf) > 0)
            {
                $return['file'] = $pdf[0]['path'];    
            }

            
            $return = $this->__enquireObject($return);

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

    function test1_post()
    {
        $string = file_get_contents(asset_url('availability.xml'));
        $xml = simplexml_load_string($string);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        if(isset($array['reply']['error']))
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = $array['reply']['error'];
            $this->response($data,400);   
        }    
        else
        {
            $data["header"]["error"] = "0";
            $data["body"] = $array['reply'];
            $this->response($data,400);   
        }    
        //debug($array['reply'],1);
    }

    function checkReservationAvailability_post()
    {
        $queryString = array();
        $queryString['apikey'] = $this->config->item('club_apiKey');
        $queryString['membership'] = $this->post('membership');
        $queryString['date'] = $this->post('date');
        $queryString['action'] = $this->post('action');

        $url = $this->config->item('club_availability_url').'?'.http_build_query($queryString);
        
        $result = doCurl($url);//echo $result;
        $xml = simplexml_load_string($result);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        if(isset($array['reply']['error']))
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = $array['reply']['error'];
            $this->response($data,400);   
        }    
        else
        {
            $data["header"]["error"] = "0";
            $data["body"] = $array['reply'];
            $this->response($data,200);   
        }
    }

    function reservation_post()
    {
        $queryString = array();
        $queryString['apikey'] = $this->config->item('club_apiKey');
        $queryString['membership'] = $this->post('membership');
        $queryString['reservationkey'] = $this->post('reservationkey');
        

        $url = $this->config->item('club_reservation_url').'?'.http_build_query($queryString);
        
        $result = doCurl($url);//echo $result;
        $xml = simplexml_load_string($result);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        
        if(isset($array['reply']['error']))
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = $array['reply']['error'];
            $this->response($data,400);   
        }    
        else
        {
            $data["header"]["error"] = "0";
            $data["body"] = $array['reply'];
            $this->response($data,200);   
        }
    }

    function getSponsorById_post()
    {
        $content_id = $this->post('id');
        $type = 'sponsors';
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
            $return['link'] = $result[0]['description'];
            
            $additional_fields = unserialize($return['data']);
            if(is_array($additional_fields))
            {
                $return = array_merge($return,$additional_fields);    
            }

            $return = $this->__enquireObject($return);

            //removing unwanted fields
            //unset($return['start_date']);
            unset($return['end_date']);
            unset($return['description']);
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
        $this->response($data,200);
    }

    function getSponsorByPage_post()
    {
        $page = $this->post('page');
        
        if(!$page)
        {
            $data["header"]["error"] = "1";
            $data["header"]["message"] = "Please provide key";
            $this->response($data,400);
        }

        $result = $this->sponsor_relation_model->get_sponsor_by_page($page);
        
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

    function getInstagramImages_post()
    {
        $key = 'members_gallery';
        $result = $this->members_gallery_images_model->get_all_images();
        $post = $this->pagemodel->get_page_by_key($key);
        
        //$result = $this->hash_tag_image->get_hashtag_images();
        
        if(count($result) > 0)
        {
            $return = array();
            foreach($result as $res)
            {
                $return['images'][] = $res['image'];
            }

            if(count($post) > 0)
            {
                $post = unserialize($post[0]['data']);
                $return['description'] = $post['description'];
            }    

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

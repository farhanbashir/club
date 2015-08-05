<?php

class Image_Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

//    function do_upload($type) {
//
//        $files = $_FILES;
//
//        $cpt = count($_FILES[$type]['name']);
//        for ($i = 0; $i < $cpt; $i++) {
//
//            $_FILES[$type]['name'] = $files[$type]['name'][$i];
//            $_FILES[$type]['type'] = $files[$type]['type'][$i];
//            $_FILES[$type]['tmp_name'] = $files[$type]['tmp_name'][$i];
//            $_FILES[$type]['error'] = $files[$type]['error'][$i];
//            $_FILES[$type]['size'] = $files[$type]['size'][$i];
//
//            $config = $this->upload->initialize($this->set_upload_options());
//
////            var_dump($_FILES); exit;
//            $this->load->library('upload', $config);
//
//            if (!$this->upload->do_upload()) {
//                $error = array('error' => $this->upload->display_errors());
//
//                var_dump($error); exit;
//            }
//        }
//    }
//
//    private function set_upload_options() {
//        //upload an image options
//        $config =  array(
//                  'upload_path'     => dirname($_SERVER["SCRIPT_FILENAME"])."/files/",
//                  'upload_url'      => base_url()."files/",
//                  'allowed_types'   => "gif|jpg|png|jpeg|pdf|doc|xml",
//                  'overwrite'       => TRUE,
//                  'max_size'        => "1000KB",
//                  'max_height'      => "768",
//                  'max_width'       => "1024"   
//                );
//
//        return $config;
//    }



    public function do_upload() {
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "204800000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024"
        );
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data = array('upload_data' => $this->upload->data());


//            $this->load->view('upload_success', $data);
        } else {
            $error = array('error' => $this->upload->display_errors());
            var_dump($error);
            exit;
//            $this->load->view('file_view', $error);
        }
    }

}

?>
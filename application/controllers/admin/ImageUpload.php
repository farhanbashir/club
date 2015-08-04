<?php

class ImageUpload {

    private $CI;

    function __construct() {
        // Assign by reference with "&" so we don't create a copy
        $this->CI = &get_instance();
    }

    function do_upload($type) {

        $files = $_FILES;

        $cpt = count($_FILES[$type]['name']);
        for ($i = 0; $i < $cpt; $i++) {

            $_FILES[$type]['name'] = $files[$type]['name'][$i];
            $_FILES[$type]['type'] = $files[$type]['type'][$i];
            $_FILES[$type]['tmp_name'] = $files[$type]['tmp_name'][$i];
            $_FILES[$type]['error'] = $files[$type]['error'][$i];
            $_FILES[$type]['size'] = $files[$type]['size'][$i];

//            $config = $this->CI->upload->initialize($this->set_upload_options());

            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';


            $this->CI->load->library('upload', $config);

            if (!$this->CI->upload->do_upload()) {
                $error = array('error' => $this->CI->upload->display_errors());

                var_dump($error); exit;
            }
        }
    }

//    private function set_upload_options() {
//        //upload an image options
//        $config = array();
//        $config['upload_path'] = 'D:/Imagesnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn/';
//        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_size'] = '0';
//        $config['overwrite'] = FALSE;
//
//        return $config;
//    }
}

?>
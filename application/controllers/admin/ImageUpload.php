<?php

class ImageUpload{

    function do_upload($type) {
//         $this->load->library('upload');
//        $this->load->library('../controllers/admin/imageupload');
//        var_dump($_FILES);exit;
        $files = $_FILES;
        
        $cpt = count($_FILES[$type]['name']);
        for ($i = 0; $i < $cpt; $i++) {

            $_FILES[$type]['name'] = $files[$type]['name'][$i];
            $_FILES[$type]['type'] = $files[$type]['type'][$i];
            $_FILES[$type]['tmp_name'] = $files[$type]['tmp_name'][$i];
            $_FILES[$type]['error'] = $files[$type]['error'][$i];
            $_FILES[$type]['size'] = $files[$type]['size'][$i];

        $config = $this->upload->initialize($this->set_upload_options());
//        $this->upload->do_upload();
        $this->load->library('upload', $config);
        }
    }

    private function set_upload_options() {
        //upload an image options
        $config = array();
        $config['upload_path'] = './Images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;

        return $config;
    }

}

?>
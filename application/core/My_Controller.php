<?php

class My_Controller extends CI_Controller {

    public $uploadSuccess;
    public $uploadError;
    public $uploadData;

    public function uploadImageFile() {


        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100000000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $this->uploadSuccess = false;
            $this->uploadError = array('error' => $this->upload->display_errors());
            var_dump($this->uploadError);
            exit;
        } else {
            var_dump($this->uploadError);
            exit;
            $this->uploadSuccess = true;
            $this->uploadData = $this->upload->data();
        }
    }

}

?>
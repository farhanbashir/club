<?php

class My_Controller extends CI_Controller {

    public $uploadSuccess;
    public $uploadError;
    public $uploadData;

    public function uploadImageFile($id, $type) {

        $path = './uploads/' . $type . '/' . $id;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '999999999';
        $config['max_width'] = '10024';
        $config['max_height'] = '10768';


        if (!file_exists('path/to/directory')) {
            mkdir('path/to/directory', 0777, true);
        }


        for ($i = $cpt - 1; $i >= 0; $i--) {

            $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];



            $this->upload->initialize($config);
            $this->upload->do_upload();
            $this->load->library('upload', $config);
        }

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            $this->uploadSuccess = false;
            $this->uploadError = array('error' => $this->upload->display_errors());
        } else {
            $this->uploadSuccess = true;
            $this->uploadData = $this->upload->data();
        }
    }

}

?>
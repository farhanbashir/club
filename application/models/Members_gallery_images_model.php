<?php

Class Members_gallery_images_model extends CI_Model {

    public function get_all_images() {
        $query = $this->db->get('members_gallery_images');
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function add_images($data) {

        foreach ($data as $image) {
            $image_path = array('image' => $image);
            $this->db->insert('members_gallery_images', $image_path);
        }
    }

    public function delete_image($id) {
        return $this->db->delete('members_gallery_images', array('id' => $id));
    }

}

?>
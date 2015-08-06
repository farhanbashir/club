<?php

Class Image extends CI_Model {

    function get_total_images() {
        return $this->db->count_all('image');
    }

    function add_images($data) {
        foreach ($data as $image) {
            $this->db->insert('image', $image);
        }
    }

    function get_images_by_content_id($content_id) {
        $this->db->where('is_active', 1);
        $query = $this->db->get_where('image', array('content_id' => $content_id));
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function delete_image($id) {
        return $this->db->delete('image', array('imagess_id' => $id));
    }

    function deactivate_image($id) {
        $data = array(
            'is_active' => 0
        );

        $this->db->where('image_id', $id);
        $this->db->update('image', $data);
    }

}

?>
<?php

Class Hash_tag_image extends CI_Model {

    public function get_content_by_id($id) {
        $query = $this->db->get_where('hash_tags_image', array('hash_tag_id' => $id));
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function get_hashtag_images() {
        $sql = 'select ht.id,ht.hash_tag,hti.image from hash_tags_image hti  
                inner join hash_tag ht on ht.id=hti.hash_tag_id';
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function add_content($data) {
        foreach ($data as $image) {
            $this->db->insert('hash_tags_image', $image);
        }
    }

    public function delete_content($id) {
        return $this->db->delete('hash_tags_image', array('id' => $id));
    }

}

?>
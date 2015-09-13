<?php

Class Hash_tag extends CI_Model {

    function get_total_contents() {
        return $this->db->count_all('hash_tag');
    }

    function get_content($page = 0) {

        $sql = "SELECT h.*,
            (SELECT count(*) FROM hash_tags_image WHERE hash_tag_id = h.id) as count_images 
            FROM hash_tag h";


        if ($page >= 0) {
            $start = $page;
            $limit = $this->config->item('pagination_limit');
            $sql .=" limit $start,$limit";
        }

        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function get_content_by_id($id) {
        $query = $this->db->get_where('hash_tag', array('id' => $id));
        $result = $query->result_array();
        $query->free_result();
        return $result[0];
    }

    public function update_content_by_id($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('hash_tag', $data);
        return $id;
    }

    function get_contents($page) {
        $start = $page;
        $limit = $this->config->item('pagination_limit');

        $sql = "select * from content limit $start,$limit";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function add_content($data) {
        $this->db->insert('hash_tag', $data);
        return $this->db->insert_id();
    }

    public function delete_content($id) {
        return $this->db->delete('hash_tag', array('id' => $id));
    }

}

?>
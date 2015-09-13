<?php

Class Sponsor_relation_model extends CI_Model {

    function get_total_contents() {
        return $this->db->count_all('sponsor_relation');
    }

    function get_latest_five_by_type($type) {
        $sql = "select * from content
            WHERE content_type_id =
            (
                    SELECT content_type_id FROM content_type
                    WHERE content = '$type'
                    order by content_id desc limit 5
            )";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function get_sponsor_content() {
        $sql = "select * from content
            WHERE content_type_id =
            (
                    SELECT content_type_id FROM content_type
                    WHERE content = 'sponsors'
                    order by content_id desc limit 5
            )";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function get_total_sponsors(){

        $sql = "SELECT count(*) as count FROM sponsor_relation";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result[0]['count'];
    }

    function get_sponsors($page = 0) {

        $sql = "SELECT s.*,c.title as content_title,c.content_id as content_id FROM sponsor_relation s LEFT JOIN content c 
                ON s.sponsor_content_id = c.content_id
                ";


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
        $sql = "SELECT s.*,c.title as content_title,c.content_id as content_id FROM sponsor_relation s LEFT JOIN content c 
                ON s.sponsor_content_id = c.content_id
                WHERE s.id = $id";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function update_content_by_id($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('sponsor_relation', $data);
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
//        $this->db->select('content_type_id');
//        $this->db->from('content_type');
//        $this->db->where('content', $type);
//        $query = $this->db->get();
//        $result = $query->result_array();
//        $query->free_result();
//        $content_id = $result[0]['content_type_id'];
//        $data['content_type_id'] = $content_id;

        $this->db->insert('sponsor_relation', $data);
        return $this->db->insert_id();
    }

    public function delete_sponsor($id) {
        return $this->db->delete('sponsor_relation', array('id' => $id));
    }

}

?>
<?php

Class Hash_tag_image extends CI_Model {

    function get_total_contents() {
        return $this->db->count_all('content');
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

    function get_total_content_by_type($type) {

        $sql = "SELECT count(*) as count FROM content
                WHERE content_type_id =
                (
                        SELECT content_type_id FROM content_type
                        WHERE content = '$type'
                ) ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result[0]['count'];
    }

    function get_content_by_type($type, $page = 0) {
        // $sql = "select * from content
        //     WHERE content_type_id =
        //     (
        //             SELECT content_type_id FROM content_type
        //             WHERE content = '$type'
        //     )";

        $sql = "select c.*,ct.content as content_type_name from content c
                inner join content_type ct on ct.content_type_id=c.content_type_id 
                where ct.content = '$type'
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
        $query = $this->db->get_where('hash_tags_image', array('hash_tag_id' => $id));
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function get_hashtag_images()
    {
        $sql = 'select ht.id,ht.hash_tag,hti.image from hash_tags_image hti  
                inner join hash_tag ht on ht.id=hti.hash_tag_id';
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function update_content_by_id($id, $data) {
        $this->db->where('content_id', $id);
        $this->db->update('content', $data);
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
        foreach ($data as $image) {
            $this->db->insert('hash_tags_image', $image);
        }
    }

    public function delete_content($id) {
        return $this->db->delete('hash_tags_image', array('id' => $id));
    }

}

?>
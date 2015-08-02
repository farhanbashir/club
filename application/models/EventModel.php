<?php

Class EventModel extends CI_Model {

    function get_total_events() {

        $sql = "SELECT count(*) as count FROM content 
                WHERE content_type_id = 
                (
                        SELECT content_type_id FROM content_type 
                        WHERE content = 'events'
                ) ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result[0]['count'];
    }

//    function key_exists($key) {
//        $this->db->select('id');
//        $this->db->from('authenticate');
//        $this->db->where('key', $key);
//        $this->db->limit(1);
//
//        $query = $this->db->get();
//
//        if ($query->num_rows() == 1) {
//            return $query->result();
//        } else {
//            return false;
//        }
//    }
//    function get_latest_five_events() {
//        $sql = "select * from event order by event_id desc limit 5";
//        $query = $this->db->query($sql);
//        $result = $query->result_array();
//        $query->free_result();
//        return $result;
//    }

    function get_events($event) {
        $start = $event;
        $limit = $this->config->item('pagination_limit');

        $sql = "SELECT * FROM content 
                WHERE content_type_id = 
                (
                        SELECT content_type_id FROM content_type 
                        WHERE content = 'events'
                ) limit $start,$limit";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function get_event_by_id($id) {
        $sql = "SELECT * FROM content 
                WHERE content_type_id = 
                (
                        SELECT content_type_id FROM content_type 
                        WHERE content = 'events'
                ) AND content_id = $id limit 1";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function update_event_by_id($id, $data) {
        $this->db->where('content_id', $id);
        $this->db->update('content', $data);
        return $id;
    }

    public function add_event($data) {
        $this->db->select('content_type_id');
        $this->db->from('content_type');
        $this->db->where('content', 'events');
        $query = $this->db->get();
        $result = $query->result_array();
        $query->free_result();
        $content_id = $result[0]['content_type_id'];
        $data['content_type_id'] = $content_id;

        $this->db->insert('content', $data);
        return $this->db->insert_id();
    }

    public function delete_event($id){
        return $this->db->delete('content', array('content_id' => $id));
    }
}

?>
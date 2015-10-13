<?php

Class Notifications extends CI_Model {

    function get_total_notifications() {
        return $this->db->count_all('notifications');
    }

    public function get_notification_by_id($id) {
        $sql = "SELECT * FROM notifications
                WHERE notification_id = $id";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function get_notifications($page) {
        $start = $page;
        $limit = $this->config->item('pagination_limit');

        $sql = "select * from notifications limit $start,$limit";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    public function add_notification($data) {
        $this->db->insert('notifications', $data);
        return $this->db->insert_id();
    }


}

?>
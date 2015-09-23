<?php

Class PDF extends CI_Model {

    function add_pdf($data) {
        $this->db->where('content_id', $data['content_id']);
        $this->db->update('pdf', array('is_active' => 0));

        $this->db->insert('pdf', $data);
    }

    function get_pdf($content_id) {
        $this->db->where('is_active', 1);
        $query = $this->db->get_where('pdf', array('content_id' => $content_id));
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function deactive_pdf($pdf_id) {
        $this->db->where('pdf_id', $pdf_id);
        $this->db->update('pdf', array('is_active' => 0));
    }

}

?>
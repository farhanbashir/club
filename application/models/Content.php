<?php
Class Content extends CI_Model
{

 function get_total_contents()
 {
     return $this->db->count_all('content');
 }

 function get_latest_five_by_type($type)
 {
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


function get_content_by_type($type, $page = 0)
{
    $sql = "select * from content
            WHERE content_type_id =
            (
                    SELECT content_type_id FROM content_type
                    WHERE content = '$type'
            )";

    if($page >= 0)
    {
        $start =  $page;
        $limit = $this->config->item('pagination_limit');
        $sql .=" limit $start,$limit";
    }

    $query = $this->db->query($sql);
    $result = $query->result_array();
    $query->free_result();
    return $result;
}

    public function get_content_by_id($type, $id) {
        $sql = "SELECT * FROM content
                WHERE content_type_id =
                (
                        SELECT content_type_id FROM content_type
                        WHERE content = '$type'
                ) AND content_id = $id limit 1";
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

 function get_contents($page)
 {
    $start =  $page;
    $limit = $this->config->item('pagination_limit');

     $sql = "select * from content limit $start,$limit" ;
     $query = $this->db->query($sql);
     $result = $query->result_array();
     $query->free_result();
     return $result;
 }

}
?>
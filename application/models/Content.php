<?php
Class Content extends CI_Model
{

 function get_total_contents()
 {
     return $this->db->count_all('content');
 }

 function key_exists($key)
 {
   $this -> db -> select('id');
   $this -> db -> from('authenticate');
   $this -> db -> where('key', $key);
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }

 function get_latest_five_contents()
 {
    $sql = "select * from content order by content_id desc limit 5";
    $query = $this->db->query($sql);
    $result = $query->result_array();
    $query->free_result();
    return $result;
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
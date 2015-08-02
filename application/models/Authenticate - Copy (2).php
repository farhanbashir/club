<?php
Class Authenticate extends CI_Model
{

 function get_total_keys()
 {
     return $this->db->count_all('authenticate');
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

 function get_latest_five_keys()
 {
    $sql = "select * from authenticate order by id desc limit 5";
    $query = $this->db->query($sql);
    $result = $query->result_array();
    $query->free_result();
    return $result;
 }

 function get_keys($page)
 {
    $start =  $page;
    $limit = $this->config->item('pagination_limit');

     $sql = "select * from authenticate limit $start,$limit" ;
     $query = $this->db->query($sql);
     $result = $query->result_array();
     $query->free_result();
     return $result;
 }

}
?>
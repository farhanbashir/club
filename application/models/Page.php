<?php
Class Page extends CI_Model
{

 function get_total_pages()
 {
     return $this->db->count_all('page');
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

 function get_latest_five_pages()
 {
    $sql = "select * from page order by page_id desc limit 5";
    $query = $this->db->query($sql);
    $result = $query->result_array();
    $query->free_result();
    return $result;
 }

 function get_pages($page)
 {
    $start =  $page;
    $limit = $this->config->item('pagination_limit');

     $sql = "select * from page limit $start,$limit" ;
     $query = $this->db->query($sql);
     $result = $query->result_array();
     $query->free_result();
     return $result;
 }

 public function get_page_by_key($key) {
        $sql = "SELECT * FROM page
                WHERE `key` = '$key' limit 1";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

}
?>
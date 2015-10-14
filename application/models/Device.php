<?php
Class Device extends CI_Model
{

    function get_total_devices()
    {
        return $this->db->count_all('devices');
    }

    function get_all_devices()
    {
        $sql = "select * from devices" ;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function get_iphone_devices()
    {
        $sql = "select * from devices where `type`=0" ;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function get_android_devices()
    {
        $sql = "select * from devices where `type`=1" ;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function get_user_device($user_id)
    {
        $sql = "select * from devices where user_id=$user_id" ;
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }

    function edit_device($user_id,$data)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('devices',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function insert_device($data)
    {
        $this->db->insert('devices',$data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}

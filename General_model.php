<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class General_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_all($table)
    {
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        return array();
    }
	public function get_all_row($table)
    {
        $q = $this->db->get($table);
        if($q->num_rows() == 1)
        {
            return $q->row();
        }
        return array();
    }
 
    public function get_row($table,$primaryfield,$id)
    {
        $this->db->where($primaryfield,$id);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->row();
        }
        return false;
    }
	public function get_row_array($table,$data)
    {
        $this->db->where($data);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->row();
        }
        return false;
    }
 
    public function get_data($table,$primaryfield,$fieldname,$id)
    {
        $this->db->select($fieldname);
        $this->db->where($primaryfield,$id);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->row()->$fieldname;
        }
        return array();
    }
	public function get_data_all($table,$primaryfield,$fieldname,$id)
    {
        $this->db->select($fieldname);
        $this->db->where($primaryfield,$id);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        return array();
    }
	public function get_data_all_by_order($table,$primaryfield,$fieldname,$id,$order_id,$order)
    {
        $this->db->select($fieldname);
        $this->db->where($primaryfield,$id);
        $this->db->order_by($order_id,$order);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        return array();
    }
	public function get_data_array_by_order($table,$fieldname,$data,$order_id,$order)
    {
        $this->db->select($fieldname);
        $this->db->where($data);
        $this->db->order_by($order_id,$order);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        return array();
    }
	public function get_data_all_array($table,$fieldname,$data)
    {
        $this->db->select($fieldname);
        $this->db->where($data);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->result();
        }
        return array();
    }
	public function get_data_field($table,$fieldname,$data)
    {
        $this->db->select($fieldname);
        $this->db->where($data);
        $q = $this->db->get($table);
        if($q->num_rows() > 0)
        {
            return $q->row()->$fieldname;
        }
        return array();
    }
 
    public function add($table,$data)
    {
        return $this->db->insert($table, $data);
    }
    public function update($table,$data,$primaryfield,$id)
    {
        $this->db->where($primaryfield, $id);
        $q = $this->db->update($table, $data);
        return $q;
    }
 
    public function delete($table,$primaryfield,$id)
    {
    	$this->db->where($primaryfield,$id);
    	$this->db->delete($table);
    }
    public function has_duplicate($value, $tabletocheck, $fieldtocheck)
    {
        $this->db->select($fieldtocheck);
        $this->db->where($fieldtocheck,$value);
        $result = $this->db->get($tabletocheck);
 
        if($result->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    public function has_duplicate_array($tabletocheck, $data)
    {
        $this->db->select($fieldtocheck);
        $this->db->where($data);
        $result = $this->db->get($tabletocheck);
 
        if($result->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    public function has_child($tabletocheck,$fieldtocheck,$value)
    {
        $this->db->select($fieldtocheck);
        $this->db->where($fieldtocheck,$value);
        $result = $this->db->get($tabletocheck);
 
        if($result->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
    public function get_ref($table,$key,$value,$dropdown=false)
    {
        $this->db->from($table);
        $this->db->order_by($value);
        $result = $this->db->get();
 
        $array = array();
        if ($dropdown)
            $array = array("" => "Please Select");
 
        if($result->num_rows() > 0) {
            foreach($result->result_array() as $row) {
            $array[$row[$key]] = $row[$value];
            }
        }
        return $array;
    }
}
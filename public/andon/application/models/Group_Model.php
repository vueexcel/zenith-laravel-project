<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Group_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function showAllGroup()
    {
        $this->db->order_by('group_number', 'asc');
        $query = $this->db->get('groups');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function editGroup()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $query = $this->db->get('groups');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function addGroup()
    {
        $field = array(
            'group_number' => $this->input->post('group_number'),
            'group_name' => $this->input->post('group_name')
        );
        $this->db->insert('groups', $field);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateGroup()
    {
        $action = $this->input->post('action');
        $id = $this->input->post('id');

        if($action == "delete") {
            $this->db->where('id', $id);
            $this->db->delete('groups');
        } else {
            $field = array(
                'group_number' => $this->input->post('group_number'),
                'group_name' => $this->input->post('group_name')
            );
            $this->db->where('id', $id);
            $result = $this->db->update('groups', $field);
        }
        return $this->input->post();
    }

    function deleteGroup()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('groups');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}

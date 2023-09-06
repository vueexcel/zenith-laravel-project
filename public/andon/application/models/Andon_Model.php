<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Andon_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function showAllAndon()
    {
        $this->db->order_by('andon_no', 'asc');
        $query = $this->db->get('andons');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function editAndon()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $query = $this->db->get('andons');
        if($query->num_rows() > 0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function addAndon()
    {
        $field = array(
            'andon_no'          =>$this->input->post('andon_no'),
            'andon_name'        =>$this->input->post('andon_name'),
            'status'            =>$this->input->post('status'),
            'group_id'          =>$this->input->post('group_id'),
            'andon_type'        =>$this->input->post('andon_type'),
            'yellow_andon'      =>$this->input->post('yellow_andon'),
            'red_andon_timer'   =>$this->input->post('red_andon_timer'),
            'andon_timer_reset' =>$this->input->post('andon_timer_reset'),
            'red_andon'         =>$this->input->post('red_andon'),
            'line_running'      =>$this->input->post('line_running'),
        );
        $this->db->insert('andons', $field);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function updateAndon()
    {
        $action = $this->input->post('action');
        $id = $this->input->post('id');

        if($action == "delete") {
            $this->db->where('id', $id);
            $this->db->delete('andons');
        } else {
            $field = array();
            if($this->input->post('andon_name')) {
                $field['andon_name'] = $this->input->post('andon_name');
            }

            if($this->input->post('kind')) {
                switch ($this->input->post('kind')) {
                    case 'status':              $field['status']            = $this->input->post('val'); break;
                    case 'group_id':            $field['group_id']          = $this->input->post('val'); break;
                    case 'andon_type':          $field['andon_type']        = $this->input->post('val'); break;
                    case 'yellow_andon':        $field['yellow_andon']      = $this->input->post('val'); break;
                    case 'red_andon_timer':     $field['red_andon_timer']   = $this->input->post('val'); break;
                    case 'andon_timer_reset':   $field['andon_timer_reset'] = $this->input->post('val'); break;
                    case 'red_andon':           $field['red_andon']         = $this->input->post('val'); break;
                    case 'line_running':        $field['line_running']      = $this->input->post('val'); break;
                }
            }

            $this->db->where('id', $id);
            $result = $this->db->update('andons', $field);
        }

        return $this->input->post();
    }

    function deleteAndon()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('andons');
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    function getAllTags()
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('tag_names');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    function getAllAndonsByGroup($group_id)
    {
        $this->db->where('group_id', $group_id);
        $query = $this->db->get('andons');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    function getRedAndonTime($start_time, $end_time, $tag)
    {
        if($tag == null || empty($tag)) {
            return 0;
        } else {
            $this->db->where('timestamp >=', $start_time);
            $this->db->where('timestamp <=', $end_time);
            $this->db->where('name', $tag);
            $this->db->where('value', 1);
            $query = $this->db->get('live');
            if($query->num_rows() > 0){
                $time = 0;
                foreach ($query->result() as $row)
                {
                    $timestamp = $row->timestamp;
                    $this->db->where('timestamp >=', $timestamp);
                    $this->db->where('name', $tag);
                    $this->db->where('value', 0);
                    $this->db->order_by('timestamp', 'asc');
                    $this->db->limit(1);
                    $q = $this->db->get('live');
                    if($q->num_rows() > 0){
                        $r = $q->row();
                        $time += strtotime($r->timestamp) - strtotime($row->timestamp);
                    }
                }
                return $time;
            }else{
                return 0;
            }
        }
    }

    function getAndonCount($start_time, $end_time, $tag)
    {
        $this->db->where('timestamp >=', $start_time);
        $this->db->where('timestamp <=', $end_time);
        $this->db->where('name', $tag);
        $this->db->where('value', 1);
        $query = $this->db->get('live');
        return $query->num_rows();
    }


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Home extends BaseController {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function index()
    {
        $this->global['pageTitle'] = 'Plastics Shop : Home';
        $this->global['pageName'] = 'Home';

        //Check new tag and insert new tag to tag names table
        $current = "2020-02-18 23:59:59";
        $this->db->where('timestamp >=', date('Y-m-d H:i:s', strtotime("-1 day", strtotime($current))));
        $this->db->select('name');
        $this->db->group_by('name');
        $query = $this->db->get('live');
        if($query->num_rows() > 0){
            $tags = $query->result();
            foreach ($tags as $tag) {
                $this->db->where('tag_name', $tag->name);
                $tag_query = $this->db->get('tag_names');
                if($tag_query->num_rows() == 0) {
                    $field = array(
                        'tag_name' => $tag->name
                    );
                    $this->db->insert('tag_names', $field);
                }
            }
        }

        $this->loadViews("home", $this->global, NULL , NULL);


    }

    public function adminLogin()
    {
        $password = $this->input->post('password');

        if($password == "rta1") {
            $this->session->admin = "logged";
            echo "ok";
        } else{
            echo "fail";
        }
    }
}
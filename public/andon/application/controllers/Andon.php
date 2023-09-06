<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Andon extends BaseController {

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
        $this->load->model('Group_Model', 'g');
        $this->load->model('Andon_Model', 'a');
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Plastics Shop : Andon Configuration';
        $this->global['pageName'] = 'Andon';
        $data['groups'] = $this->g->showAllGroup();
        $data['tags'] = $this->a->getAllTags();
        $data['andons'] = $this->getAllAndons();
        $footer['admin_password'] = $this->session->admin;
        $this->loadViews("andons", $this->global, $data , $footer);
    }

    public function showAllAndon(){
        $result = $this->a->showAllAndon();
        if($result == false)
            $result = array();
        echo json_encode($result);
    }

    public function getAllAndons(){
        $result = $this->a->showAllAndon();
        if($result == false)
            $result = array();
        return $result;
    }

    public function addAndon(){
        $result = $this->a->addAndon();
        $msg['success'] = false;
        $msg['type'] = 'add';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function editAndon()
    {
        $result = $this->a->editAndon();
        echo json_encode($result);
    }

    public function updateAndon(){
        $result = $this->a->updateAndon();
        echo json_encode($result);
    }

    public function deleteAndon(){
        $result = $this->a->deleteAndon();
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
}
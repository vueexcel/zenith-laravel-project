<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class AndonGroup extends BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Group_Model', 'm');
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Plastics Shop : Group Setup';
        $this->global['pageName'] = 'Group';
        $footer['admin_password'] = $this->session->admin;
        $pageInfo['groups'] = $this->getAllGroup();
        $this->loadViews("groups", $this->global, $pageInfo , $footer);
    }

    public function showAllGroup(){
        $result = $this->m->showAllGroup();
        if($result == false)
            $result = array();
        echo json_encode($result);
    }

    public function getAllGroup(){
        $result = $this->m->showAllGroup();
        if($result == false)
            $result = array();
        return $result;
    }


    public function editGroup()
    {
        $result = $this->m->editGroup();
        echo json_encode($result);
    }

    public function addGroup(){
        $result = $this->m->addGroup();
        $msg['success'] = false;
        $msg['type'] = 'add';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function updateGroup(){
        $result = $this->m->updateGroup();
        echo json_encode($result);
    }

    public function deleteGroup(){
        $result = $this->m->deleteGroup();
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
}
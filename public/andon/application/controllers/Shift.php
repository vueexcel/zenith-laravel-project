<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Shift extends BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Shift_Model', 'm');
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Plastics Shop : Shift Setting';
        $this->global['pageName'] = 'Shift_Setting';
        $data['shifts'] = $this->m->getAllShifts();
        $footer['admin_password'] = $this->session->admin;
        $this->loadViews("shift", $this->global, $data , $footer);
    }

    public function updateShift(){
        $result = $this->m->updateShift();
        $msg['success'] = false;
        $msg['type'] = 'update';
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

}
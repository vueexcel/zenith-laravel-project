<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Analysis extends BaseController {

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
        $this->load->model('Group_Model', 'm');
        $this->load->model('Andon_Model', 'a');
        $this->load->model('Shift_Model', 's');
    }


    public function index()
    {
        $this->global['pageTitle'] = 'Plastics Shop : Analysis';
        $this->global['pageName'] = 'Analysis';
        $data['groups'] = $this->m->showAllGroup();
        $shift_data = $this->s->getCurrentShift();
        $data['live_date'] = $shift_data['live_date'];
        $data['live_shift'] = $shift_data['live_shift'];
        $this->loadViews("analysis", $this->global, $data , NULL);
    }

    public function getAnalysisGraph()
    {
		$from_date = $this->convertDateString($this->input->post('from_date'));
		$to_date = $this->convertDateString($this->input->post('to_date'));
        $shift = $this->input->post('shift');
        $group_id = $this->input->post('group_id');

        $g_data = array();

        $andons = $this->a->getAllAndonsByGroup($group_id);

        if($andons != false) {
            foreach ($andons as $andon) {
                $start_date = $from_date;
                while($start_date <= $to_date) {
                    $end_date = date("Y-m-d", strtotime("+1 days", strtotime($start_date)));
                    if($shift != "both_shift") {
                        $timeset = $this->s->getStartEndTime($start_date, $shift);
                        $start_time = $timeset['start'];
                        $end_time = $timeset['end'];
                    } else {
                        $timeset1 = $this->s->getStartEndTime($start_date, "shift1");
                        $timeset2 = $this->s->getStartEndTime($start_date, "shift2");
                        $start_time = $timeset1['start'];
                        $end_time = $timeset2['end'];
                    }

                    //Red Andon Timer (red_andon_timer)
                    $red_time = $this->a->getRedAndonTime($start_time, $end_time, $andon->red_andon_timer);

                    //Yellow Andon (yellow_andon)
                    $yellow = $this->a->getAndonCount($start_time, $end_time, $andon->yellow_andon);

                    //Red Andon (red_andon)
                    $red = $this->a->getAndonCount($start_time, $end_time, $andon->red_andon);

                    array_push($g_data, array(
                        'andon' => $andon->andon_name,
                        'time' => $red_time,
                        'red_andon' => $red,
                        'yellow_andon' => $yellow,
                        'count_color' => "#fff",
                        'time_color' => "#000",
					));

                    $start_date = $end_date;
                }
            }
        }
        echo json_encode($g_data, true);
    }


    public function getAnalysisGrid()
    {

        $from_date = $this->convertDateString($this->input->post('from_date'));
        $to_date = $this->convertDateString($this->input->post('to_date'));
        $shift = $this->input->post('shift');
        $group_id = $this->input->post('group_id');

        $g_data = array();

        $andons = $this->a->getAllAndonsByGroup($group_id);

        $times = array();

        if($from_date == $to_date)
            $time_scale = "+30 minutes";
        else
            $time_scale = "+1 hour";


        if($andons != false) {
            foreach ($andons as $index=>$andon) {
                $start_date = $from_date;
                $g_data[$index]['andon'] = $andon->andon_name;
                $g_data[$index]['times'] = array();

                while($start_date <= $to_date) {
                    $end_date = date("Y-m-d", strtotime("+1 days", strtotime($start_date)));
                    if($shift != "both_shift") {
                        $timeset = $this->s->getStartEndTime($start_date, $shift);
                        $start_time = $timeset['start'];
                        $end_time = $timeset['end'];
                    } else {
                        $timeset1 = $this->s->getStartEndTime($start_date, "shift1");
                        $timeset2 = $this->s->getStartEndTime($start_date, "shift2");
                        $start_time = $timeset1['start'];
                        $end_time = $timeset2['end'];
                    }

                    $from_datetime = $start_time;

                    while (strtotime($from_datetime) < strtotime($end_time)) {
                        $to_datetime = date("Y-m-d H:i:s", strtotime($time_scale, strtotime($from_datetime)));
                        if(strtotime($to_datetime) > strtotime($end_time))
                            $to_datetime = $end_time;

                        /*echo "<td class='header-td'>";
                        echo date('H:i', strtotime($to_datetime));
                        echo "</td>";*/

                        array_push($times, array(
                            'start' => $from_datetime,
                            'end' => $to_datetime
						));

                        //Yellow Andon (yellow_andon)
                        $yellow = $this->a->getRedAndonTime($from_datetime, $to_datetime, $andon->yellow_andon);

                        //Red Andon (red_andon)
                        $red = $this->a->getRedAndonTime($from_datetime, $to_datetime, $andon->red_andon);

                        array_push($g_data[$index]['times'], array(
                            'time' => $to_datetime,
                            'red_andon' => $red,
                            'yellow_andon' => $yellow
						));

                        $from_datetime = $to_datetime;
                    }
                    $start_date = $end_date;
                }
            }
        }

        $data['g_data'] = $g_data;
        $this->load->view('grid', $data);
    }


}

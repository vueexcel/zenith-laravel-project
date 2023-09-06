<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Shift_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllShifts()
    {
        $this->db->where('set_type', 'shift_setting');
        $query = $this->db->get('shift_setting');
        if($query->num_rows() > 0){
            $row = $query->row();
            $string = $row->set_value;

        }else{
            //Read Default Shift setting from json;
            $this->load->helper("url");
            //$string = file_get_contents(base_url()."application/config/shift.json");
            $string = file_get_contents(APPPATH . 'config/shift.json');
        }

        $shift_settings = json_decode($string, true);
        return $shift_settings;
    }

    public function updateShift()
    {
        //Start and End Time
        $settings['days']['start'] = $this->make_time_string($this->input->post('days_start')).":00";
        $settings['days']['end'] = $this->make_time_string($this->input->post('days_end')).":00";

        $settings['night']['start'] = $this->make_time_string($this->input->post('night_start')).":00";
        $settings['night']['end'] = $this->make_time_string($this->input->post('night_end')).":00";

        $settings['fnight']['start'] = $this->make_time_string($this->input->post('fnight_start')).":00";
        $settings['fnight']['end'] = $this->make_time_string($this->input->post('fnight_end')).":00";

        $days_break_start = $this->input->post('days_break_start');
        $days_break_end = $this->input->post('days_break_end');
        $night_break_start = $this->input->post('night_break_start');
        $night_break_end = $this->input->post('night_break_end');
        $fnight_break_start = $this->input->post('fnight_break_start');
        $fnight_break_end = $this->input->post('fnight_break_end');

        for($i=0; $i<4; $i++) {
            $index = $i + 1;
            $settings['days']['breaks']['start'.$index] = $this->make_time_string($days_break_start[$i]).":00";
            $settings['days']['breaks']['end'.$index] = $this->make_time_string($days_break_end[$i]).":00";

            $settings['night']['breaks']['start'.$index] = $this->make_time_string($night_break_start[$i]).":00";
            $settings['night']['breaks']['end'.$index] = $this->make_time_string($night_break_end[$i]).":00";

            $settings['fnight']['breaks']['start'.$index] = $this->make_time_string($fnight_break_start[$i]).":00";
            $settings['fnight']['breaks']['end'.$index] = $this->make_time_string($fnight_break_end[$i]).":00";
        }

        $shift_setting = json_encode($settings, true);

        $field = array(
            'set_value' => $shift_setting,
            'set_type' => "shift_setting"
        );


        $this->db->where('set_type', 'shift_setting');
        $query = $this->db->get('shift_setting');
        if($query->num_rows() > 0){
            $this->db->where('set_type', 'shift_setting');
            $result = $this->db->update('shift_setting', $field);
        }else{
            $result = $this->db->insert('shift_setting', $field);
        }

        return $result;
    }


    public function make_time_string($time)
    {
        if (strlen($time) < 5) {
            $time = "0" . $time;
        }
        return $time;
    }

    public function getCurrentShift()
    {
        $current = date('Y-m-d H:i:s');
        $todayWeek = date('N');
        $today = date("Y-m-d");
        $yesterday = date("Y-m-d", strtotime("-1 days"));
        $shift_settings = $this->getAllShifts();

        if($todayWeek == 5) {
            if ($current < $today . " " . $shift_settings['days']['start']) {
                $live_shift = "shift2";
                $live_date = $yesterday;
            } else if ($current >= $today . " " . $shift_settings['days']['start'] && $current < $today . " " . $shift_settings['fnight']['start']) {
                $live_shift = "shift1";
                $live_date = $today;
            } else {
                $live_shift = "shift2";
                $live_date = $today;
            }
        } else {
            if ($current < $today . " " . $shift_settings['days']['start']) {
                $live_shift = "shift2";
                $live_date = $yesterday;
            } else if ($current >= $today . " " . $shift_settings['days']['start'] && $current < $today . " " . $shift_settings['night']['start']) {
                $live_shift = "shift1";
                $live_date = $today;
            } else {
                $live_shift = "shift2";
                $live_date = $today;
            }
        }

        $data['live_shift'] = $live_shift;
        $data['live_date'] = $live_date;

        return $data;
    }

    public function getStartEndTime($graph_date, $shift)
    {
        $shift_settings = $this->getAllShifts();
        $graph_week = date('N', strtotime($graph_date));
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime("+1 days"));
        if ($graph_date == $today) {
            if ($shift == "shift1") {
                $shiftKind = 'days';
                $day = $today;
                $nextDay = $today;
            } else {
                if ($graph_week == 5) {
                    $shiftKind = 'fnight';
                    $day = $today;
                    $nextDay = $tomorrow;
                } else {
                    $shiftKind = 'night';
                    $day = $today;
                    $nextDay = $tomorrow;
                }
            }
        } else {
            if ($shift == "shift1") {
                $shiftKind = 'days';
                $day = $graph_date;
                $nextDay = $graph_date;
            } else {
                $afterDay = date('Y-m-d', strtotime("+1 days", strtotime($graph_date)));

                if ($graph_week == 5) {
                    $shiftKind = 'fnight';
                    $day = $graph_date;
                    $nextDay = $afterDay;
                } else {
                    $shiftKind = 'night';
                    $day = $graph_date;
                    $nextDay = $afterDay;
                }
            }
        }

        $date['start'] = $day . " " . $shift_settings[$shiftKind]['start'];
        $date['end'] = $nextDay . " " . $shift_settings[$shiftKind]['end'];
        return $date;

    }
}

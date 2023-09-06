<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MulitpleSheetExport implements WithMultipleSheets
{
    private $report_data;
    private $export_sheets;
    private $start_date;
    private $end_date;
    public function __construct($report_data, $export_sheets, $start_date, $end_date, $master_kpi = null) {
        $this->report_data = $report_data;
        $this->export_sheets = $export_sheets;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->master_kpi = $master_kpi;
    }

    public function sheets(): array
    {
        $sheets = [];
        $report_data = $this->report_data;
        foreach ($this->export_sheets as $index => $sheet){
            if(strpos($sheet, 'Database') === false) {
                if($sheet == "Health Concerns")
                    $sheets[] = new ExceptionExport('Health Concerns');
                else if($sheet == "Accidents")
                    $sheets[] = new ExceptionExport('Accidents');
                else if($sheet == 'Changed Data Exception')
                    $sheets[] = new ExceptionExport('Changed Data Exception');
                else {
                    if(isset($report_data[$index - 1]))
                        $sheets[] = new HsExport($report_data[$index - 1], $sheet);
                    else
                        $sheets[] = new HsExport($report_data[0], $sheet);
                }
            }
            else {
                if($sheet == "Accident List From Database")
                    $sheets[] = new AccidentExport($this->start_date, $this->end_date, $sheet, $this->master_kpi);
                else if($sheet == "MSS List From Database")
                    $sheets[] = new MssIncidentExport($this->start_date, $this->end_date, $this->master_kpi);
                else if($sheet == "LT Accident List From Database")
                    $sheets[] = new LostTimeIncidentExport($this->start_date, $this->end_date);
                else if($sheet == "LT MSS List From Database")
                    $sheets[] = new LostTimeMSSExport($this->start_date, $this->end_date);
                else if($sheet == "Illness List From Database")
                    $sheets[] = new IllnessIncidentExport($this->start_date, $this->end_date);
                else if($sheet == "Near Miss List from SIRS, Database")
                    $sheets[] = new NearMissExport($this->start_date, $this->end_date);
                else if($sheet == "RIDDOR List From Database")
                    $sheets[] = new AccidentExport($this->start_date, $this->end_date, 'RIDDOR');
                else if($sheet == "RIDDOR Industrial Disease List From Database")
                    $sheets[] = new RiddorIncidentExport($this->start_date, $this->end_date);
                else if($sheet == "Restricted & Absent Cases, Database")
                    $sheets[] = new RestrictionCostExport($this->start_date, $this->end_date);
                else if($sheet == "Other List From Database")
                    $sheets[] = new WorkOtherIncidentExport($this->start_date, $this->end_date);
                else if($sheet == "Health Concerns From Database")
                    $test = '';
                else if($sheet == "Contractor Accidents From Database")
                    $sheets[] = new ContractorAccidentExport($this->start_date, $this->end_date);
                else
                    $sheets[] = new AccidentExport($this->start_date, $this->end_date);
            }
        }
        return $sheets;
    }
}

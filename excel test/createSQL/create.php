<?php
namespace createSQL;

class createSQL {
    /**
     * 月初日、月末日の取得
     * @param $month
     * @return array
     */
    public function getStartAndEnd($month){
        if($month === 0 && $month <= 12){
            $start = date("Y-m-01");
            $end = date('Y-m-t');
        } else {
            $start = date("Y-{$month}-01");
            $end = date("Y-{$month}-t");
        }
        $start = strtotime($start);
        $end = strtotime($end);
        return [$start, $end];
    }

    public function createDateArray($from_to){
        $dates = [];
        list($start,$end) = $from_to;
        $i = 0;
        while ($start <= $end){
            $week = date('w',$start);
            if($week ==='1' || $week ==='2' || $week ==='3' || $week ==='4' || $week ==='5'){
                // 休日を除く
                $dates[$i] = date('Y-m-d',$start);
            }
            $start = strtotime('+1 day',$start);
            $i++;
        }
        return $dates;
    }

    public function exportSQL($dates){
    }
}

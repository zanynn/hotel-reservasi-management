<?php

namespace App\Http\Controllers;

use App\DetailBill;
use App\Reservation;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function monthly_report(Request $request){
        $months = $this->get_months();
        $years = $this->get_years();

        $reservations = [];
        $monthly_income = 0;
        $stats_label = [];
        $stats_data = [];
        if($request->has('month') && $request->has('year')){

            
            
            
            $selected_month = $request->month;
            $selected_year = $request->year;
            // how many day in month
            $days_in_month = cal_days_in_month(CAL_GREGORIAN,$selected_month,$selected_year);
            
            $reservations = Reservation::with('bills')->whereMonth('DateIn', $selected_month)->whereYear('DateIn', $selected_year)->get();
            foreach($reservations as $reservation){
                $reservation->total_bill = 0;
                $reservation->check_in_day = (int) date('d', strtotime($reservation->DateIn));
                foreach($reservation->bills as $bill){
                    $reservation->total_bill += $bill->price;
                }
                $monthly_income += $reservation->total_bill;
            }
            for($i = 1;$i <= $days_in_month;$i++){
                array_push($stats_label,$i);
                $has_check_in_day = array_search($i ,array_column($reservations->toArray(), 'check_in_day'));
                if($has_check_in_day > -1){
                    array_push($stats_data, $reservations[$has_check_in_day]->total_bill);
                }else {
                    array_push($stats_data, 0);
                }
            }

        }

        if($request->is_export == 1){
            return view('admin.reporting.monthly_pdf', compact('months', 'years', 'reservations','monthly_income','stats_data','stats_label'));
        }

        return view('admin.reporting.monthly', compact('months', 'years', 'reservations','monthly_income','stats_data','stats_label'));
    }
    public function yearly_report(Request $request){
        $years = $this->get_years();
        $months = $this->get_months();
        $reservations = [];
        $yearly_income = 0;
        $stats_label = $months;
        $stats_data = [];
        if($request->has('year')){
            $selected_year = $request->year;
            // how many day in month
            $reservations = Reservation::with('bills')->whereYear('DateIn', $selected_year)->get();
            foreach($reservations as $reservation){
                $reservation->total_bill = 0;
                $reservation->check_in_month = (int) date('m', strtotime($reservation->DateIn));
                foreach($reservation->bills as $bill){
                    $reservation->total_bill += $bill->price;
                }
                $yearly_income += $reservation->total_bill;
            }
            foreach($months as $key => $month){
                $reservations_in_month = Reservation::whereYear('DateIn', $selected_year)->whereMonth('DateIn', $key + 1)->get();
                if(count($reservations_in_month)> 0){
                    $total_bill_in_month = 0;
                    foreach($reservations_in_month as $reservation){
                        foreach($reservation->bills as $bill){
                            $total_bill_in_month += $bill->price;
                        }
                    }
                    array_push($stats_data, $total_bill_in_month);
                } else {
                    array_push($stats_data,0);
                }
                // $has_check_in_month = array_search($key + 1, array_column($reservations->toArray(), 'check_in_month'));
                // if($has_check_in_month > -1){
                //     array_push($stats_data)
                // }
            }
        }

        if($request->is_export == 1){
            return view('admin.reporting.yearly_pdf', compact('months', 'years', 'reservations','yearly_income','stats_data','stats_label'));
        }
        return view('admin.reporting.yearly', compact('years', 'reservations','yearly_income','stats_data','stats_label'));
    }
}

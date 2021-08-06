<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expenditure;
use App\Models\Income;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller{

    public function index(){
        $dashboard_data = $this->getDashboardData();
        return view('home', compact('dashboard_data'));
    }

    private function getDashboardData(){
        $staff_count = Staff::count();
        $income_count = Income::sum('total');
        $receiavable_count = Income::sum('receivable_remain');
        $customer_count = Customer::count();
        $income_years = Income::selectRaw('DISTINCT year(date) year')->orderBy('year', 'DESC')->pluck('year', 'year');
        $expenditure_years = Expenditure::selectRaw('DISTINCT year(date) year')->orderBy('year', 'DESC')->pluck('year', 'year');

        return [
            'staff_count' => $staff_count,
            'income_count' => $income_count,
            'receiavable_count' => $receiavable_count,
            'customer_count' => $customer_count,
            'income_years' => $income_years,
            'expenditure_years' => $expenditure_years
        ];
    }

    public function getIncomeChart(Request $request){
        $year = $request->year != 'now' ? $request->year : Carbon::now()->year;
        $months = [ 'January',  'February',  'March',  'April',  'May',  'June',  'July',  'August',  'September',  'October',  'November',  'December'];
        $result = Income::selectRaw('year(date) year, monthname(date) month, sum(total) data')
                ->whereYear('date', $year)
                ->groupBy('year', 'month')
                ->orderBy('month', 'DESC')
                ->get()->toArray();

        $income_chart = [];

        foreach($months as $key => $month){
            $key = array_search($month, array_column($result, 'month'));
            $data = $key === false ? 0 : $result[$key]['data'];
            array_push($income_chart, $data);
        }

        return response(['code' => 1, 'income' => $income_chart]);
    }

    public function getExpenditureChart(Request $request){
        $year = $request->year != 'now' ? $request->year : Carbon::now()->year;
        $months = [ 'January',  'February',  'March',  'April',  'May',  'June',  'July',  'August',  'September',  'October',  'November',  'December'];
        $result = Expenditure::selectRaw('year(date) year, monthname(date) month, sum(amount) data')
                ->whereYear('date', $year)
                ->groupBy('year', 'month')
                ->orderBy('month', 'DESC')
                ->get()->toArray();

        $expenditure_chart = [];

        foreach($months as $key => $month){
            $key = array_search($month, array_column($result, 'month'));
            $data = $key === false ? 0 : $result[$key]['data'];
            array_push($expenditure_chart, $data);
        }

        // return $expenditure_chart;

        return response(['code' => 1, 'expenditure' => $expenditure_chart]);
    }

}

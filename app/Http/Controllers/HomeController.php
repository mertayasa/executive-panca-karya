<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expenditure;
use App\Models\Income;
use App\Models\IncomeType;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Datatables\IncomePerDayDatatable;
use App\Datatables\ExpenPerDayDatatable;
use Illuminate\Support\Facades\Request as FacadesRequest;

class HomeController extends Controller
{

    public function index()
    {
        $dashboard_data = $this->getDashboardData();
        return view('home', compact('dashboard_data'));
    }

    private function getDashboardData()
    {
        $staff_count = Staff::count();
        $income_count = Income::sum('total');
        $receiavable_count = Income::sum('receivable_remain');
        $customer_count = Customer::count();
        $income_years = Income::selectRaw('DISTINCT year(date) year')->orderBy('year', 'DESC')->pluck('year', 'year');
        $expenditure_years = Expenditure::selectRaw('DISTINCT year(date) year')->orderBy('year', 'DESC')->pluck('year', 'year');
        $date = Carbon::now()->startOfDay();
        $income_per_day = Income::selectRaw('date(date) date, sum(total) data')
            ->where('status', 1)
            ->whereYear('date', $date)
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->get();

        return [
            'staff_count' => $staff_count,
            'income_count' => $income_count,
            'receiavable_count' => $receiavable_count,
            'customer_count' => $customer_count,
            'income_years' => $income_years,
            'expenditure_years' => $expenditure_years,
            'income_per_day' => $income_per_day

        ];
    }


    // ========================
    public function datatablePerDay()
    {
        $date = Carbon::now()->subDays(30)->startOfDay();
        $income_per_day = Income::selectRaw('date(date) date, sum(total) total')
            ->where('status', 1)
            ->whereYear('date', $date)
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->get();

        return IncomePerDayDataTable::set($income_per_day);
    }

    public function datatableExPerDay()
    {
        // $date = Carbon::now()->subDays(30)->startOfDay();
        // $expenditure_per_day = Expenditure::selectRaw('date(date) date, sum(amount) amount')
        //     ->whereYear('date', $date)
        //     ->groupBy('date')
        //     ->orderBy('date', 'DESC')
        //     ->get();

        $expenditure_per_day = Expenditure::all();

        return ExpenPerDayDataTable::set($expenditure_per_day);
    }

    // =====================


    public function getIncomeChart(Request $request)
    {
        $year = $request->year != 'now' ? $request->year : Carbon::now()->year;
        $months = ['January',  'February',  'March',  'April',  'May',  'June',  'July',  'August',  'September',  'October',  'November',  'December'];
        $result = Income::selectRaw('year(date) year, monthname(date) month, sum(total) data')
            ->whereYear('date', $year)
            ->groupBy('year', 'month')
            ->orderBy('month', 'DESC')
            ->get()->toArray();

        $income_chart = [];

        foreach ($months as $key => $month) {
            $key = array_search($month, array_column($result, 'month'));
            $data = $key === false ? 0 : $result[$key]['data'];
            array_push($income_chart, $data);
        }

        return response(['code' => 1, 'income' => $income_chart]);
    }

    public function getExpenditureChart(Request $request)
    {
        $year = $request->year != 'now' ? $request->year : Carbon::now()->year;
        $months = ['January',  'February',  'March',  'April',  'May',  'June',  'July',  'August',  'September',  'October',  'November',  'December'];
        $result = Expenditure::selectRaw('year(date) year, monthname(date) month, sum(amount) data')
            ->whereYear('date', $year)
            ->groupBy('year', 'month')
            ->orderBy('month', 'DESC')
            ->get()->toArray();

        $expenditure_chart = [];

        foreach ($months as $key => $month) {
            $key = array_search($month, array_column($result, 'month'));
            $data = $key === false ? 0 : $result[$key]['data'];
            array_push($expenditure_chart, $data);
        }

        // return $expenditure_chart;

        return response(['code' => 1, 'expenditure' => $expenditure_chart]);
    }
}

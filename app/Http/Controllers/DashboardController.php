<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expenditure;
use App\Models\ExpenditureType;
use App\Models\Income;
use App\Models\IncomeType;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dd($this->getExpenByCategory());
        $dashboard_data = $this->getDashboardData();
        return view('dashboard.index', compact('dashboard_data'));
    }

    private function getDashboardData()
    {
        $staff_count = Staff::count();
        $income_count = Income::sum('total');
        $receiavable_count = Income::sum('receivable_remain');
        $customer_count = Customer::count();
        $years = Income::selectRaw('DISTINCT year(date) year')->orderBy('year', 'DESC')->pluck('year', 'year');

        return [
            'staff_count' => $staff_count,
            'income_count' => $income_count,
            'receiavable_count' => $receiavable_count,
            'customer_count' => $customer_count,
            'years' => $years,
            // 'income_count_day' => $income_count_day
        ];
    }

    public function getIncomeAndExpenChart(Request $request)
    {
        $year = $request->year != 'now' ? $request->year : Carbon::now()->year;
        $months = ['January',  'February',  'March',  'April',  'May',  'June',  'July',  'August',  'September',  'October',  'November',  'December'];
        $data_income = Income::selectRaw('year(date) year, monthname(date) month, sum(total) data')
            ->whereYear('date', $year)
            ->groupBy('year', 'month')
            ->orderBy('month', 'DESC')
            ->get()->toArray();

        $months = ['January',  'February',  'March',  'April',  'May',  'June',  'July',  'August',  'September',  'October',  'November',  'December'];
        $data_expenditure = Expenditure::selectRaw('year(date) year, monthname(date) month, sum(amount) data')
            ->whereYear('date', $year)
            ->groupBy('year', 'month')
            ->orderBy('month', 'DESC')
            ->get()->toArray();

        $income = [];
        $expenditure = [];

        foreach ($months as $key => $month) {
            $key = array_search($month, array_column($data_income, 'month'));
            $data = $key === false ? 0 : $data_income[$key]['data'];
            array_push($income, $data);
        }

        foreach ($months as $key => $month) {
            $key = array_search($month, array_column($data_expenditure, 'month'));
            $data = $key === false ? 0 : $data_expenditure[$key]['data'];
            array_push($expenditure, $data);
        }

        if (isset($request->type) && $request->type = 'doughnut') {
            return response(['code' => 1, 'income' => array_sum($income), 'expenditure' => array_sum($expenditure)]);
        }
        return response(['code' => 1, 'income' => $income, 'expenditure' => $expenditure]);
    }

    public function getIncomeAndExpenChartMonthly(Request $request)
    {
        $year = Carbon::now()->year;

        $month = $request->month != 'now' ? $request->month : Carbon::now()->month;

        $income = Income::whereYear('date', $year)->whereMonth('date', $month)->sum('total');
        $expenditure = Expenditure::whereYear('date', $year)->whereMonth('date', $month)->sum('amount');

        return response(['code' => 1, 'income' => [$income], 'expenditure' => [$expenditure]]);
    }

    public function getIncomeByCategory()
    {
        $income = IncomeType::with('incomes')->get();

        $income = $income->map(function ($income) {
            return $income->income_sum;
        });

        $labels = IncomeType::pluck('name')->flatten()->toArray();

        $colors =  [];

        foreach ($labels as $key => $label) {
            $colors += [$key => sprintf('#%06X', mt_rand(0, 0xFFFFFF))];
        }

        return response(['code' => 1, 'labels' => $labels, 'income' => $income, 'colors' => $colors]);
    }

    public function getExpenByCategory()
    {
        $expenditure = ExpenditureType::with('expenditures')->get();

        $expenditure = $expenditure->map(function ($expenditure) {
            return $expenditure->expenditure_sum;
        });


        $labels = ExpenditureType::pluck('name')->flatten()->toArray();

        // dd($labels);
        $colors =  [];

        foreach ($labels as $key => $label) {
            $colors += [$key => sprintf('#%06X', mt_rand(0, 0xFFFFFF))];
        }

        return response(['code' => 1, 'labels' => $labels, 'expenditure' => $expenditure, 'colors' => $colors]);
    }
}

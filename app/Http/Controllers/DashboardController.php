<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\GuaranteeLetter;
use App\Models\Client;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        return view('administrator.dashboard');
    }

    public function showAllocateBudget()
    {
        return view('administrator.dashboard.allocate-budget');
    }

    public function showExpenseHistory(Request $request)
    {
        $q = $request->input('search');
        $per = $request->input('per_page', 10);

        $query = Expense::search($q)->orderBy('exp_id', 'desc');

        if ($per === 'all') {
            $expenses = $query->get();
        } else {
            $expenses = $query->paginate($per)->appends($request->except('page'));
        }

        return view('administrator.dashboard.expense-history', ['expenses' => $expenses]);
    }

    public function showBudgetStatistics()
    {
        return view('administrator.dashboard.budget-statistics');
    }

    public function showDataRecordCountingYear()
    {
        return view('administrator.dashboard.data-record-counting-year');
    }

    public function showGlList(Request $request)
    {
        $q = $request->input('search');
        $per = $request->input('per_page', 10);
        $sort = $request->input('sort_by', 'gl_id_asc');

        $startYear = $request->input('start_year');
        $startMonth = $request->input('start_month');
        $startDay = $request->input('start_day');
        $endYear = $request->input('end_year');
        $endMonth = $request->input('end_month');
        $endDay = $request->input('end_day');

        $query = GuaranteeLetter::search($q);

        if ($startYear && $startMonth && $startDay && $endYear && $endMonth && $endDay) {
            $start = "{$startYear}-{$startMonth}-{$startDay}";
            $end = "{$endYear}-{$endMonth}-{$endDay}";
            $query->dateRange($start, $end);
        }

        match ($sort) {
            'date_desc' => $query->orderBy('app_date', 'desc'),
            'date_asc' => $query->orderBy('app_date', 'asc'),
            default => $query->orderBy('gl_id', 'asc'),
        };

        if ($per === 'all') {
            $letters = $query->get();
        } else {
            $letters = $query->paginate($per)->appends($request->except('page'));
        }

        return view('administrator.dashboard.gl-list', ['letters' => $letters]);
    }

    public function showApplySb()
    {
        return view('administrator.dashboard.apply-sb');
    }

    public function showClientList(Request $request)
    {
        $q = $request->input('search');
        $per = $request->input('per_page', 10);
        $sort = $request->input('sort_by', 'name_asc');

        $startYear = $request->input('start_year');
        $startMonth = $request->input('start_month');
        $startDay = $request->input('start_day');
        $endYear = $request->input('end_year');
        $endMonth = $request->input('end_month');
        $endDay = $request->input('end_day');

        $query = Client::search($q);

        if ($startYear && $startMonth && $startDay && $endYear && $endMonth && $endDay) {
            $start = "{$startYear}-{$startMonth}-{$startDay}";
            $end = "{$endYear}-{$endMonth}-{$endDay}";
            $query->dateRange($start, $end);
        }

        match ($sort) {
            'latest' => $query->orderBy('time_registered', 'desc'),
            'oldest' => $query->orderBy('time_registered', 'asc'),
            default => $query->orderBy('surname', 'asc'),
        };

        if ($per === 'all') {
            $clients = $query->get();
        } else {
            $clients = $query->paginate($per)->appends($request->except('page'));
        }

        return view('administrator.sidebar.client-list', ['clients' => $clients]);
    }
}
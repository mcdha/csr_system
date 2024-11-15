<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Query;
use App\Models\OptionValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Dashboard\IndexRequest;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $start_date = $request->start_date ? Carbon::parse($request->start_date) :  Query::Oldest()->first()->created_at ?? Carbon::now();
        $end_date = $request->end_date ? Carbon::parse($request->end_date) : Carbon::now();

        $queries = Query::where(function($query) use($start_date, $end_date){
            $query->whereBetween('created_at', [$start_date, $end_date])
            ->orWhereDate('created_at', $start_date)
            ->orWhereDate('created_at', $end_date);
        });

        if ($request->branches) {
            $queries = $queries->whereIn('branch', explode(';', $request->branches));
        }

        if ($request->channels) {
            $queries = $queries->whereIn('channel', explode(';', $request->channels));
        }

        if ($request->concerns) {
            $queries = $queries->whereIn('concern', explode(';', $request->concerns));
        }

        if ($request->departments) {
            $queries = $queries->whereIn('department', explode(';', $request->departments));
        }

        $total_queries = $queries->clone()->count();
        $new_queries = $queries->clone()->get();
        $top_concerns = $queries->clone()->topConcerns()->get()->pluck('concern')->implode(', ');

        $resolved_queries_count = $queries->clone()
            ->where('status', 'Resolved')
            ->count();
        $pending_queries_count = $queries->clone()
            ->where('status', 'Pending')
            ->count();

        $concerns_count_array = $queries->clone()->concernsCount()->get()->toArray();

        return view('dashboard.index', compact([
            'start_date',
            'end_date',
            'total_queries',
            'new_queries',
            'top_concerns',
            'resolved_queries_count',
            'pending_queries_count',
            'concerns_count_array'
        ]));
    }

    public function filter()
    {
        $branches = OptionValue::where('table', 'queries')->where('field', 'branch')->first()->values;
        $departments = OptionValue::where('table', 'queries')->where('field', 'department')->first()->values;
        $channels = OptionValue::where('table', 'queries')->where('field', 'channel')->first()->values;
        $concerns = OptionValue::where('table', 'queries')->where('field', 'concern')->first()->values;

        return view('dashboard.filter', compact('branches', 'departments', 'channels', 'concerns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

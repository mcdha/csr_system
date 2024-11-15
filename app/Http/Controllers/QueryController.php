<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Query;
use App\Models\OptionValue;
use Illuminate\Http\Request;
use App\Exports\QueriesExport;
use App\Imports\QueriesImport;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Query\StoreRequest;
use App\Http\Requests\Query\ExportRequest;
use App\Http\Requests\Query\ImportRequest;
use App\Http\Requests\Query\UpdateRequest;
use Illuminate\Support\Facades\Log;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     if (!$request->ajax()) {
    //         return view("queries.index");
    //     }

    //     $queries = Query::query();

    //     return DataTables::of($queries)
    //         ->addIndexColumn()
    //         ->editColumn('is_member', function ($row) {
    //             return $row->is_member ? 'Yes' : 'No';
    //         })
    //         ->editColumn('status', function ($row) {
    //             return "<form action='" . route('queries.updateField', ['query' => $row->id]) . "' method='POST'>
    //                         " . csrf_field() . "
    //                         " . method_field("PUT") . "
    //                         <input name='field' value='status' hidden>
    //                         <select class='form-control' style='width: 6.4rem;' onchange='this.form.submit()' name='value'>
    //                             <option " . ($row->status == 'Pending' ? 'selected' : null) . ">Pending</option>
    //                             <option " . ($row->status == 'Resolved' ? 'selected' : null) . ">Resolved</option>
    //                         </select>
    //                     </form>";
    //         })
    //         ->addColumn('action', function ($row) {
    //             return '
    //                 <a href="' . route('queries.show', ['query' => $row->id]) . '" class="text-decoration-none">
    //                     <button type="button" class="btn btn-outline-primary bg-white mb-2 mb-md-0">View</button>
    //                 </a>
    //                 <a href="' . route('queries.edit', ['query' => $row->id]) . '" class="text-decoration-none">
    //                     <button class="btn btn-outline-primary bg-white mb-2 mb-md-0">Edit</button>
    //                 </a>
    //                 <form method="POST" action="' . route('queries.destroy', ['query' => $row->id]) . '" class="d-inline">
    //                     ' . csrf_field() . '
    //                     ' . method_field('DELETE') . '
    //                     <button type="submit" class="btn btn-outline-primary bg-white mb-2 mb-md-0">Delete</button>
    //                 </form>
    //             ';
    //         })
    //         ->editColumn('created_at', function ($row) {
    //             return $row->created_at->format('M d, Y h:i A');
    //         })
    //         ->rawColumns(['action', 'status'])
    //         ->make(true);
    // }

    public function index(Request $request)
    {
        if (!$request->ajax()) {
            return view("queries.index");
        }

        $queries = Query::query();

        return DataTables::of($queries)
            ->addIndexColumn()
            ->editColumn('is_member', function ($row) {
                return $row->is_member ? 'Yes' : 'No';
            })

            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('queries.show', ['query' => $row->id]) . '" class="text-decoration-none">
                        <button type="button" class="btn btn-outline-primary bg-white mb-2 mb-md-0">View</button>
                    </a>

                    <form method="POST" action="' . route('queries.destroy', ['query' => $row->id]) . '" class="d-inline">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-outline-primary bg-white mb-2 mb-md-0">Delete</button>
                    </form>
                ';
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('M d, Y h:i A');
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    // Other controller methods (create, store, show, edit, update, destroy, updateField, upload, import, importFailures, filter, export) go here...


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $branches = OptionValue::where('table', 'queries')->where('field', 'branch')->first()->values;
        $departments = OptionValue::where('table', 'queries')->where('field', 'department')->first()->values;
        $channels = OptionValue::where('table', 'queries')->where('field', 'channel')->first()->values;
        $concerns = OptionValue::where('table', 'queries')->where('field', 'concern')->first()->values;

        return view('queries.create', compact('departments', 'channels', 'concerns'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreRequest $request)
    {
        $query = new Query();
        $query->fill($request->all());

        // Capitalize the first letter of urgency
        $query->urgency = ucfirst($request->urgency);

        if ($request->status == 'Resolved') {
            $query->resolved_at = Carbon::now();
        }

        $query->save();

        $currentDateTime = Carbon::now()->format('M d, Y h:i A');

        return redirect()->route('queries.create')
            ->with('success', "Query added successfully on $currentDateTime!");
    }





    /**
     * Display the specified resource.
     */
    // public function show(Query $query)
    // {
    //     return view('queries.show', compact('query',));
    // }

    public function show(Query $query)
{
    // Load the handler relationship with the query
    $query->load('handler');

    return view('queries.show', compact('query'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Query $query)
    {
        $departments = OptionValue::where('table', 'queries')->where('field', 'department')->first()->values;
        $channels = OptionValue::where('table', 'queries')->where('field', 'channel')->first()->values;
        $concerns = OptionValue::where('table', 'queries')->where('field', 'concern')->first()->values;
        $users = User::where('first_name', '!=', 'Admin')->get();

        // dd($users);

        return view('queries.edit', compact('query', 'departments', 'channels', 'concerns', 'users'));
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateRequest $request, Query $query)
    // {
    //     $query->fill($request->all());

    //     if ($query->isDirty('status')) {
    //         if ($query->status == 'Resolved') {
    //             $query->fill([
    //                 'resolved_at' => Carbon::now()
    //             ]);
    //         } else {
    //             $query->fill([
    //                 'resolved_at' => null
    //             ]);
    //         }
    //     }

    //     $query->save();
    //     return redirect()->route('queries.show', ['query' => $query->id])->with('success', 'Query has been successfully updated!');
    // }



    public function update(UpdateRequest $request, Query $query)
    {
        $query->fill($request->all());

        // Check if the status is "Resolved" and "resolved_by" field is selected
        if ($query->status == 'Resolved' && $request->filled('resolved_by')) {
            $query->resolved_at = Carbon::now();

            // Generate the Ticket Number if the "Resolved" status and "Handled By" agent are set
            $agent = User::find($request->resolved_by);
            if ($agent) {
                $ticketNumber = $this->generateTicketNumber($agent->agent_code, Carbon::now());
                $query->ticket_number = $ticketNumber;
            }
        } else {
            // Reset the ticket number if status changes from Resolved to another status
            $query->resolved_at = null;
            $query->ticket_number = null;
        }

        $query->save();

        return redirect()->route('queries.show', ['query' => $query->id])
                         ->with('success', 'Query has been successfully updated!');
    }

    /**
     * Generate Ticket Number based on agent code and date
     * Format: {MonthLetter}{AgentCode}{Year}{Day}
     * Example: A10120241
     */
    private function generateTicketNumber($agentCode, $date)
    {
        $monthLetter = chr(64 + $date->month); // Converts 1 = A, 2 = B, etc.
        $year = $date->year;
        $day = $date->day;

        return "{$monthLetter}{$agentCode}{$year}{$day}";
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Query $query)
    {
        $query->delete();
        return redirect()->route('queries.index')->with('success', 'Query has been successfully deleted!');
    }

    public function updateField(Request $request, Query $query)
    {
        $query->update([
            $request->field => $request->value
        ]);
        return redirect()->route('queries.index')->with("success", "Query's {$request->field} has been successfully updated!");
    }

    /**
     * Upload excel file before importing.
     */
    public function upload()
    {
        return view('queries.upload');
    }

    // public function import(ImportRequest $request)
    // {
    //     $import = new QueriesImport();
    //     $import->import($request->file('excel_file'));
    //     $failures = $import->failures()->toJson();

    //     // foreach ($import->failures() as $failure) {
    //     //     $failure->row();
    //     //     $failure->attribute();
    //     //     $failure->errors();
    //     //     $failure->values();
    //     // }

    //     return redirect()->route('queries.importFailures', ['failures' => $failures, 'success_count' => $import->getSuccessCount()]);
    // }


    public function import(ImportRequest $request)
    {
        if (!$request->hasFile('excel_file')) {
            return redirect()->back()->withErrors(['excel_file' => 'No file uploaded']);
        }

        $file = $request->file('excel_file');

        Log::info('File details', [
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'real_path' => $file->getRealPath(),
        ]);

        if (!$file->isValid()) {
            return redirect()->back()->withErrors(['excel_file' => 'Uploaded file is not valid']);
        }

        $filePath = $file->getRealPath();
        if (empty($filePath)) {
            return redirect()->back()->withErrors(['excel_file' => 'File path cannot be empty']);
        }

        try {
            $import = new QueriesImport();
            $import->import($file);

            $failures = $import->failures()->toJson();

            return redirect()->route('queries.importFailures', ['failures' => $failures, 'success_count' => $import->getSuccessCount()]);
        } catch (\Exception $e) {
            Log::error('Import error', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors(['excel_file' => 'An error occurred during import: ' . $e->getMessage()]);
        }
    }


    public function importFailures(Request $request)
    {
        $failures = collect(json_decode($request->failures));
        return view('queries.import_failures', ['failures' => $failures, 'success_count' => $request->success_count]);
    }


    /**
     * Filter for queries records before exporting.
     */
    public function filter()
    {
        $branches = OptionValue::where('table', 'queries')->where('field', 'branch')->first()->values;
        $departments = OptionValue::where('table', 'queries')->where('field', 'department')->first()->values;
        $channels = OptionValue::where('table', 'queries')->where('field', 'channel')->first()->values;
        $concerns = OptionValue::where('table', 'queries')->where('field', 'concern')->first()->values;

        return view('queries.filter', compact('branches', 'departments', 'channels', 'concerns'));
    }


    public function export(ExportRequest $request)
    {
        return (new QueriesExport($request))->download('Queries_' . Carbon::now() . '.xlsx');

        return redirect()->route('queries.filter')->with(['success' => 'Excel file is successfully generated.']);
    }
}

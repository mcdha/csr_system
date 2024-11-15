<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionValue\UpdateRequest;
use App\Models\OptionValue;
use Illuminate\Http\Request;

class OptionValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($field)
    {
        $option_value = OptionValue::where('table', 'queries')
            ->where('field', $field)
            ->first();

        return view('option_values.index', compact('option_value', 'field'));
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
    public function update(UpdateRequest $request, OptionValue $option_value)
    {
        $option_value->update([
            'values' => explode(';', $request->values)
        ]);

        return redirect()->route('option-values.index', ['field' => $request->field])->with("success", "Option values for {$request->field} updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

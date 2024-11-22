<?php

namespace App\Http\Controllers\Admin\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartCalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('admin.chart.calculator.index');
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
        // Get the chart image from the hidden input field
        // Receive the input data for the chart
        $legends = $request->input('legend'); // Array of legends
        $values = $request->input('value');   // Array of values
        $colors = $request->input('color');   // Array of colors

        // Return the data as a JSON response
        return response()->json([
            'legends' => $legends,
            'values' => $values,
            'colors' => $colors,
        ]);
    }

}

<?php

namespace App\Http\Controllers\Admin\Programs;

use App\Http\Controllers\Controller;
use App\Models\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colleges = College::all();

        return view('admin.college.create', compact('colleges'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $existingcollege = College::where('college_id', $request->college_id)->exists();

        if ($existingcollege) {
            // If student ID exists in any table, show an error message
            session()->flash('error', 'Student ID already exists in the system!');
            return redirect()->back();
        }
        // Validate the incoming request data
        $request->validate([
            'college_id' => 'required|string|max:10|unique:colleges',
            'college_name' => 'required|string|max:100',
        ]);

        // Create a new college record
        College::create([
            'college_id' => $request->input('college_id'),
            'college_name' => $request->input('college_name'),
        ]);

        // Redirect back with a success message
        return redirect()->route('create.college')->with('success', 'College added successfully!');
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

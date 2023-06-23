<?php

namespace App\Http\Controllers;

use App\Models\CriminalDetection;
use Illuminate\Http\Request;

class CriminalDetectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('criminals.index')->with('criminals', CriminalDetection::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'fname' => ['required', 'string'],
            'lname' => ['required', 'string'],
            'sex' => ['required', 'string'],
//            'natid' => ['required', 'regex:/^\d{2}-\d{7} [A-Z] \d{2}$/'],
            'crime' => ['required'],
            'image' => ['required', 'image', 'max:255', 'mimes:png,jpg,jpeg'],
        ]);

        $imageName = $request->image->getClientOriginalName();
        $image = $request->image->storeAs('images', $imageName);

        CriminalDetection::create([
            "fname" => request('fname'),
            "lname" => request('lname'),
            "sex" => request('sex'),
            "natid" => request('natid'),
            "crime" => request('crime'),
            'image' => $image,
        ]);

        return redirect()->back()->with('success', 'Criminal Person successfully Added.');

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

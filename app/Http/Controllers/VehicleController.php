<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vehicles.index')->with('vehicles', Vehicle::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'make' => ['required', 'max:255'],
            'model' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'plate_number' => ['required', 'max:255', 'unique:vehicles'],
            'image' => ['required', 'image', 'max:255', 'mimes:png,jpg,jpeg'],
        ]);

        $imageName = $request->image->getClientOriginalName();
        $image = $request->image->storeAs('images', $imageName);

        Vehicle::create([
            "make" => request('make'),
            "model" => request('model'),
            "description" => request('description'),
            "plate_number" => request('plate_number'),
            'image' => $image,
        ]);

        return redirect()->back()->with('success', 'Vehicle Successfully Reported.');
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

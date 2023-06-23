<?php

namespace App\Http\Controllers;

use App\Models\CriminalDetection;
use Illuminate\Http\Request;

class CitizensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('citizens.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('citizens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imageName = $request->image->getClientOriginalName();
        $image = $request->image->storeAs('images', $imageName);

        $find = CriminalDetection::where('image', 'images/'.$imageName)->first();

        if ($find) {
            // Image found, return details
//            return redirect()->back()->with('success', 'Vehicle was Successfully Clamped.');
            return view('citizens.create', compact('find'));
        } else {
            // Image not found, display message
            return redirect()->back()->withErrors('This Person Not Found');
//            return back()->with('error', 'Image not available');
        }
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

<?php

namespace App\Http\Controllers;

use App\Models\comission;
use Illuminate\Http\Request;

class ComissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comissions = Comission::all();
        return response()->json($comissions);
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
    public function show(comission $comission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comission $comission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comission $comission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comission $comission)
    {
        //
    }
}

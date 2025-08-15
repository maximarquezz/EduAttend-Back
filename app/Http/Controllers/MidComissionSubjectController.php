<?php

namespace App\Http\Controllers;

use App\Models\MidComissionSubject;
use Illuminate\Http\Request;

class MidComissionSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $MidsComissionsSubjects = MidComissionSubject::all();
        return response()->json($MidsComissionsSubjects);
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
    public function show(MidComissionSubject $MidComissionSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MidComissionSubject $MidComissionSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MidComissionSubject $MidComissionSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MidComissionSubject $MidComissionSubject)
    {
        //
    }
}

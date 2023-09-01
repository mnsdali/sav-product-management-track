<?php

namespace App\Http\Controllers;

use App\Models\TypePanne;
use Illuminate\Http\Request;

class TypePanneController extends Controller
{
    public function checkStatus(Request $request){
        // get id from json request
        $id = $request->input('typePanne');

        $typePanne = TypePanne::find($id)->first();
        $typePanne->isHidden = !$typePanne->isHidden;
        $typePanne->save();

        return response()->json(['typePanne' => $typePanne]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typesPanne = TypePanne::all();
        return view('types_pannes.index', compact('typesPanne'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('types_pannes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $desingations = $request->input('designations');
        foreach ($desingations as $desingation){
            $typePanne = new TypePanne;
            $typePanne->designation = $desingation;
            $typePanne->save();
        }

        //redirect to type_panne.index with success message
        return redirect()->route('type_panne.index')->with('success', 'Types de pannes ajoutés avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypePanne $typePanne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypePanne $typePanne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypePanne $typePanne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypePanne $typePanne)
    {
        //
    }
}

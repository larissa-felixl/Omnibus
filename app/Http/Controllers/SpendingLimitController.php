<?php

namespace App\Http\Controllers;

use App\Models\SpendingLimit;
use Illuminate\Http\Request;

class SpendingLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SpendingLimit::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $spendingLimit = SpendingLimit::create($request->all());
        return response()->json($spendingLimit, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return SpendingLimit::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $spendingLimit = SpendingLimit::findOrFail($id);
        $spendingLimit->update($request->all());
        return response()->json($spendingLimit, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SpendingLimit::destroy($id);
        return response()->json(['message' => 'Meta de gastos deletada com sucesso'], 200);
    }
}

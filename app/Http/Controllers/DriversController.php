<?php

namespace App\Http\Controllers;

use App\Models\Drivers;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Drivers::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $driver = Drivers::create($request->all());
        return response()->json($driver, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Drivers::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $driver = Drivers::findOrFail($id);
        $driver->update($request->all());
        return response()->json($driver, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Drivers::destroy($id);
        return response()->json(null, 204);
    }
}

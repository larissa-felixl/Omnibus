<?php

namespace App\Http\Controllers;

use App\Models\SpendingLimit;
use App\Http\Requests\StoreSpendingLimitRequest;
use App\Http\Requests\UpdateSpendingLimitRequest;
use Illuminate\Http\JsonResponse;

class SpendingLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $limits = SpendingLimit::with('user')->get();
        return response()->json($limits, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpendingLimitRequest $request): JsonResponse
    {
        $spendingLimit = SpendingLimit::create($request->validated());
        $spendingLimit->load('user');
        
        return response()->json([
            'message' => 'Limite de gastos cadastrado com sucesso.',
            'data' => $spendingLimit
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $spendingLimit = SpendingLimit::with('user')->findOrFail($id);
        return response()->json($spendingLimit, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpendingLimitRequest $request, string $id): JsonResponse
    {
        $spendingLimit = SpendingLimit::findOrFail($id);
        $spendingLimit->update($request->validated());
        $spendingLimit->load('user');
        
        return response()->json([
            'message' => 'Limite de gastos atualizado com sucesso.',
            'data' => $spendingLimit
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $spendingLimit = SpendingLimit::findOrFail($id);
        $spendingLimit->delete();
        
        return response()->json([
            'message' => 'Limite de gastos deletado com sucesso.'
        ], 200);
    }
}

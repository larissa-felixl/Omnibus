<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Illuminate\Http\JsonResponse;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $expenses = Expenses::with('driver')->latest()->get();
        return response()->json($expenses, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $expense = Expenses::create($request->validated());
        $expense->load('driver');
        
        return response()->json([
            'message' => 'Despesa cadastrada com sucesso.',
            'data' => $expense
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $expense = Expenses::with('driver')->findOrFail($id);
        return response()->json($expense, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, string $id): JsonResponse
    {
        $expense = Expenses::findOrFail($id);
        $expense->update($request->validated());
        $expense->load('driver');
        
        return response()->json([
            'message' => 'Despesa atualizada com sucesso.',
            'data' => $expense
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $expense = Expenses::findOrFail($id);
        $expense->delete();
        
        return response()->json([
            'message' => 'Despesa deletada com sucesso.'
        ], 200);
    }
}

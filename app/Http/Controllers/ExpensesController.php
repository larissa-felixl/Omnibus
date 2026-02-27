<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
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
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $expense = Expenses::with('driver')->findOrFail($id);
        return response()->json($expense, 200);
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

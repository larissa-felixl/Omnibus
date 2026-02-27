<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Http\Requests\StoreDriverExpenseRequest;
use App\Http\Requests\UpdateDriverExpenseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriverExpensesController extends Controller
{
    /**
     * Lista todas as despesas do motorista autenticado
     */
    public function index(Request $request): JsonResponse
    {
        $driver = $request->user();
        $expenses = $driver->expenses()->latest()->get();
        
        return response()->json($expenses, 200);
    }

    /**
     * Cadastra uma nova despesa para o motorista autenticado
     */
    public function store(StoreDriverExpenseRequest $request): JsonResponse
    {
        $driver = $request->user();
        $validated = $request->validated();
        
        $expense = Expenses::create([
            'driver_id' => $driver->id,
            'vehicle_plate' => $validated['vehicle_plate'],
            'value' => $validated['value'],
            'proof_of_payment' => $validated['proof_of_payment'],
        ]);

        return response()->json([
            'message' => 'Despesa cadastrada com sucesso.',
            'data' => $expense
        ], 201);
    }

    /**
     * Exibe uma despesa específica do motorista autenticado
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $driver = $request->user();
        $expense = $driver->expenses()->findOrFail($id);
        return response()->json($expense, 200);
    }

    /**
     * Atualiza uma despesa do motorista autenticado
     */
    public function update(UpdateDriverExpenseRequest $request, string $id): JsonResponse
    {
        $driver = $request->user();
        
        $expense = $driver->expenses()->findOrFail($id);
        $expense->update($request->validated());

        return response()->json([
            'message' => 'Despesa atualizada com sucesso.',
            'data' => $expense
        ], 200);
    }

    /**
     * Remove uma despesa do motorista autenticado
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        $driver = $request->user();
        $expense = $driver->expenses()->findOrFail($id);
        $expense->delete();

        return response()->json([
            'message' => 'Despesa deletada com sucesso.'
        ], 200);
    }

    /**
     * Retorna o total de despesas do motorista no mês atual
     */
    public function monthlyTotal(Request $request): JsonResponse
    {
        $driver = $request->user();
        
        $total = $driver->expenses()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('value');

        return response()->json([
            'month' => now()->format('m'),
            'year' => now()->format('Y'),
            'total' => $total
        ], 200);
    }
}

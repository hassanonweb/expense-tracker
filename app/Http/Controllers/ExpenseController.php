<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Models\PaymentMethod;
use App\Models\FrequencyOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        $categories = Category::all();
        $paymentMethods = PaymentMethod::all();
        $frequencyOptions = FrequencyOption::all();
        $totalSpending = Expense::sum('amount');
        return view('expenses.index', compact('expenses', 'totalSpending', 'categories', 'paymentMethods', 'frequencyOptions'));
    }

    public function create()
    {
        $categories = Category::all();
        $paymentMethods = PaymentMethod::all();
        $frequencyOptions = FrequencyOption::all();

        return view('expenses.create', compact('categories', 'paymentMethods', 'frequencyOptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'frequency_option_id' => 'required|exists:frequency_options,id',
            'description' => 'nullable|string',
        ]);

        Expense::create($validatedData);

        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    public function edit(Expense $expense)
    {
        $categories = Category::all();
        $paymentMethods = PaymentMethod::all();
        $frequencyOptions = FrequencyOption::all();

        return view('expenses.edit', compact('expense', 'categories', 'paymentMethods', 'frequencyOptions'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'frequency_option_id' => 'required|exists:frequency_options,id',
            'description' => 'nullable|string',
        ]);

        $expense->update($validatedData);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }

    
}

<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::auth()
            ->with('category')
            ->latest()
            ->get();

        return view('pages.expense.index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('pages.expense.save', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $expense = new Expense();
        $expense->user_id = Auth::id();
        $this->saveExpense($request, $expense);

        flash()->success('Your expense has been created successfully!');

        return redirect()->route('expenses.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $categories = Category::get();

        return view('pages.expense.save', compact('categories', 'expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $this->saveExpense($request, $expense);

        flash()->success('Your expense has been Updated successfully!');

        return redirect()->route('expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        flash()->success('Your expense has been deleted successfully!');

        return redirect()->route('expenses.index');
    }

    private function saveExpense($request, $expense): void
    {
        $expense->category_id = $request->category_id;
        $expense->title = $request->title;
        $expense->date = $request->date ?? now();
        $expense->amount = $request->amount;

        $expense->save();
    }

    public function monthlySummary()
    {
        $currentMonth = now()->month;
        $currentYear  = now()->year;

        $expenses = Expense::auth()
            ->select('category_id', DB::raw('SUM(amount) as total'))
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->groupBy('category_id')
            ->with('category')
            ->get();

        $total = $expenses->sum('total');

        return view('pages.expense.monthly-summary', compact('expenses', 'total'));
    }
}

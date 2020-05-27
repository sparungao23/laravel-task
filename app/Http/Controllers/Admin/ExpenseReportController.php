<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use App\Http\Controllers\Controller;

class ExpenseReportController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('expense_category');

        $expensesTotal   = $expenses->sum('amount');
        $groupedExpenses = $expenses->whereNotNull('expense_category_id')->orderBy('amount', 'desc')->get()->groupBy('expense_category_id');
        
        $expensesSummary = [];

        foreach ($groupedExpenses as $exp) {
            foreach ($exp as $line) {
                if (!isset($expensesSummary[$line->expense_category->name])) {
                    $expensesSummary[$line->expense_category->name] = [
                        'name'   => $line->expense_category->name,
                        'amount' => 0,
                    ];
                }

                $expensesSummary[$line->expense_category->name]['amount'] += $line->amount;
            }
        }

        $expenseSummaryJson = json_encode($expensesSummary);

        return view('admin.expenseReports.index', compact(
            'expensesSummary',
            'expensesTotal',
            'expenseSummaryJson'
        ));
    }
}

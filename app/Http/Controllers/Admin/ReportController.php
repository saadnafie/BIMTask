<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\TransactionStatusEnum;
use App\Enums\UserTypeEnum;
use App\Models\User;
use App\Models\Payment;
use App\Models\Transaction;
use DB;

class ReportController extends Controller
{
    public function dashboard()
    {
        $customer_count = User::where('user_type',UserTypeEnum::Customer)->count();
        $transaction_count = Transaction::count();
        $payment_count = Payment::count();
        $paid_amount = Payment::sum('amount');
        return view('admin/dashboard',compact('customer_count', 'transaction_count', 'payment_count', 'paid_amount'));
    }

    public function monthlyReport(Request $request){
        $from = (isset($request->from))?$request->from:(Transaction::min('due_on'));
        $to = (isset($request->to))?$request->to:(Transaction::max('due_on'));
        $transactions = DB::table('transactions')->select(DB::raw('MONTH(transactions.due_on) month, YEAR(transactions.due_on) year'),
        //DB::raw('sum(CASE WHEN transactions.amount = sum(payments.amount) THEN transactions.amount ELSE 0 END) as paid'),
        DB::raw('sum(CASE WHEN transactions.due_on < date("Y-m-d") THEN transactions.amount ELSE 0 END) as paid'),
        DB::raw('sum(transactions.amount) as outstanding'),
        DB::raw('sum(transactions.amount) as overdue'))
        ->groupby('year','month')
        ->whereBetween('transactions.due_on',[$from,$to])
        ->join('payments', 'transactions.id', '=', 'payments.transaction_id')
        ->get();
        return view('admin/report/reports',compact('transactions'));
    }
}

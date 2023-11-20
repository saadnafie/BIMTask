<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use App\Enums\UserTypeEnum;
use App\Http\Requests\Admin\TransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('customer')->paginate();
        //return $transactions;
        return view('admin/transaction/index',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = User::where('user_type',UserTypeEnum::Customer)->get();
        return view('admin/transaction/create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        Transaction::create([
            'amount' => $request->amount,
            'payer' => $request->payer,
            'due_on' => $request->due_on,
            'vat' => $request->vat,
            'is_vat_inclusive' => $request->is_vat_inclusive
        ]);

        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('payments','customer');
        return view('admin/transaction/show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

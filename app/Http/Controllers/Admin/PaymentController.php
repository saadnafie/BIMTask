<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Transaction;
use App\Http\Requests\Admin\PaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments  = Payment::with('transaction')->paginate();
        $payments->load('transaction.customer');
        return view('admin/payment/index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_transaction_payment(Transaction $transaction)
    {
        $transaction->load('customer');
        return view('admin/payment/create',compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        Payment::create([
            'transaction_id' => $request->transaction_id,
            'amount' => $request->amount,
            'paid_on' => $request->paid_on,
            'details' => $request->details
        ]);

        return redirect()->route('transactions.show', ['transaction' => $request->transaction_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

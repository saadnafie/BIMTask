@extends('admin.layouts.header')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between  mb-3">
                        <h1 class="h3 mb-2 text-gray-800">Transactions</h1>

                        <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add Transaction</span>
                        </a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Transactions List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount</th>
                                            <th>Payer</th>
                                            <th>Due on</th>
                                            <th>VAT</th>
                                            <th>Is VAT inclusive</th>
                                            <th>Status</th>
                                            <th>Setting</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $index => $transaction)
                                            <tr>
                                                <td>{{$index+1}}</td>
                                                <td>{{$transaction->amount}}</td>
                                                <td>{{$transaction->customer->name}}</td>
                                                <td>{{$transaction->due_on}}</td>
                                                <td>{{$transaction->vat}}%</td>
                                                <td>{{$transaction->is_inclusive}}</td>
                                                <td>{{$transaction->status}}</td>
                                                <td>
                                                    <a href="{{ route('transactions.show',['transaction' => $transaction->id]) }}" class="btn btn-info">Detail</a>
                                                    @if($transaction->canPay())
                                                    <a href="{{ route('create_transaction_payment',['transaction' => $transaction->id]) }}" class="btn btn-primary">Add Payment</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <p> There are no transactions </p>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $transactions->links() }}
                        </div>
                    </div>
                   
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           

            @endsection
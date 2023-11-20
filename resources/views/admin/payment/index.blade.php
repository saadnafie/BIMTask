@extends('admin.layouts.header')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Payments</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Payments List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Transaction ID</th>
                                            <th>Payer</th>
                                            <th>Amount</th>
                                            <th>Paid on</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $index => $payment)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$payment->transaction_id}}</td>
                                            <td>{{$payment->transaction->customer->name}}</td>
                                            <td>{{$payment->amount}}</td>
                                            <td>{{$payment->paid_on}}</td>
                                            <td>{{$payment->details}}</td>
                                        </tr>
                                        @empty
                                        <p>There are no payments</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $payments->links() }}
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @endsection
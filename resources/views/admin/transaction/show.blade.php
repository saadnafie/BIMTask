@extends('admin.layouts.header')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Transaction Detail</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Transaction Information</h6>
                        </div>
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                         <b class="mb-3"><u>Customer Info:</u></b>
                                    </div>  
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" style="width:150px;">Payer Name</span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$transaction->customer->name}}" style="background-color: white;" disabled>
                                    </div>
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" style="width:150px;">Email</span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$transaction->customer->email}}" style="background-color: white;" disabled>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <b><u>Transaction Info:</u></b>
                                    </div>    
  
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" style="width:150px;">Amount</span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$transaction->amount}}" style="background-color: white;" disabled>
                                    </div>
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" style="width:150px;">Due on</span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$transaction->due_on}}" style="background-color: white;" disabled>
                                    </div>
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" style="width:150px;">VAT</span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$transaction->vat}}%" style="background-color: white;" disabled>
                                    </div>
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" style="width:150px;">Is VAT inclusive</span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$transaction->is_inclusive}}" style="background-color: white;" disabled>
                                    </div>
                                    <div class="input-group mb-3 input-group-sm">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text" style="width:150px;">Status</span>
                                        </div>
                                        <input type="text" class="form-control" value="{{$transaction->status}}" style="background-color: white;" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Payment Records</h6>
                                        @if($transaction->canPay())
                                        <a href="{{ route('create_transaction_payment',['transaction' => $transaction->id]) }}" class="btn btn-primary btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span class="text">Add Payment</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Amount</th>
                                                    <th>Paid on</th>
                                                    <th>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($transaction->payments as $index => $payment)
                                                <tr>
                                                    <td>{{$index+1}}</td>
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
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @endsection
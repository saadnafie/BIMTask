@extends('admin.layouts.header')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex justify-content-between  mb-3">
                        <h1 class="h3 mb-2 text-gray-800">Add Payment</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add New Payment</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                <div class="d-flex justify-content-between  mb-3">
                                    <b style="color:blue;"><u>Transaction ID: #{{$transaction->id}}</u></b>
                                    <b style="color:blue;">Payer: {{$transaction->customer->name}}</b>
                                </div>
                                <hr>
                                    <form class="user" method="post" action="{{route('payments.store')}}">
                                        @csrf
                                        <input type="hidden" name="transaction_id" value="{{$transaction->id}}" />
                                        <div class="form-group">
                                            <lable>Amount</lable>
                                            <input type="text" class="form-control form-control-user" value="{{ old('amount') }}" id="amount" name="amount" required>
                                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                        </div>
                                        <div class="form-group">
                                            <lable>Paid on</lable>
                                            <input type="date" class="form-control form-control-user" value="{{ old('paid_on') }}" id="paid_on" name="paid_on" required>
                                            <x-input-error :messages="$errors->get('paid_on')" class="mt-2" />
                                        </div>
                                        <div class="form-group">
                                            <lable>Details</lable>
                                            <textarea cols="4" class="form-control form-control-user" id="Details" name="details">{{ old('details') }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Add Payment
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @endsection
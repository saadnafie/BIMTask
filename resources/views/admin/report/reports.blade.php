@extends('admin.layouts.header')
@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Reports</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">financial performance</h6>
                        </div>
                        <div class="card-body">
                        <form class="form-inline" action="#" style="margin:10px;">
                        <label for="email">from:</label>
                        <input type="date" class="form-control" name="from" required>
                        <label for="email">to:</label>
                        <input type="date" class="form-control" name="to" required>
                        <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        <hr>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Paid</th>
                                            <th>Outstanding</th>
                                            <th>Overdue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $index =>$transaction)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$transaction->month}}</td>
                                            <td>{{$transaction->year}}</td>
                                            <td>{{$transaction->paid}}</td>
                                            <td>{{$transaction->outstanding}}</td>
                                            <td>{{$transaction->overdue}}</td>
                                        </tr>
                                        @empty
                                        <p>There are no data</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @endsection
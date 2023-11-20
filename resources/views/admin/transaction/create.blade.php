@extends('admin.layouts.header')
@section('content')



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

<style>
    .select2-container .select2-selection--single {
        font-size: .8rem;
    padding: 1.5rem 1rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 10px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 50px;
}
</style>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between  mb-3">
            <h1 class="h3 mb-2 text-gray-800">Add Transaction</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Transaction</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        
                        <form class="user" method="post" action="{{route('transactions.store')}}">
                            @csrf
                            <div class="form-group">
                                <lable>Amount</lable>
                                <input type="text" class="form-control form-control-user" value="{{ old('amount') }}" id="amount" name="amount" required>
                                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                            </div>
                           
                            <div class="form-group">
                                <lable>Payer</lable><br>
                                <select type="text" class="form-control form-control-user js-example-basic-single" style="width:100%" id="Payer" name="payer">
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" {{ (old('payer') == $customer->id)?'selected':'' }}>{{$customer->name}}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('payer')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <lable>Due on</lable>
                                <input type="date" class="form-control form-control-user" value="{{ old('due_on') }}" id="Due_on" name="due_on" required>
                                <x-input-error :messages="$errors->get('due_on')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <lable>VAT</lable>
                                <input type="text" class="form-control form-control-user" value="{{ old('vat') }}" id="VAT" name="vat" required>
                                <x-input-error :messages="$errors->get('vat')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label>Is VAT inclusive	?</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="is_vat_inclusive" value="1" {{ (old('is_vat_inclusive') === null || old('is_vat_inclusive') === '1')?'checked':'' }}>Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="is_vat_inclusive" value="0" {{ (old('is_vat_inclusive') === '0')?'checked':'' }}>No
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Add Transaction
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

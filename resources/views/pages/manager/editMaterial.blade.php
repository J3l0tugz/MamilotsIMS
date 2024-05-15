@extends('layouts.app')

@section('content')
    <div class="container-fluid">


        <h1 class="h3 mb-2 text-white mx-3" style="font-weight: 700;">Edit Item</h1>
        <div class="col d-flex justify-content-center">
            <div class="card mb-4 col-12">
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{ route('material.index') }}" class="btn btn-sm shadow btn-warning mb-4"><div class="fa fa-arrow-alt-circle-left mr-lg-2 m-1"></div>Go back</a>
                    </div>
                    <div class="mt-5">
                        <form method="POST" action="{{ route('material.update', ['id' => $material->id]) }}">
                            @csrf
                            <h6 class="mb-0">Item Name<strong style="color:red">*</strong></h6>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user add-input p-2"
                                    name="name" placeholder="Item" value="{{ $material->name }}">
                                @error('name')
                                    <p class="mb-0" style="color: red; font-size:12px;">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                            <h6 class="mb-0">Description<strong style="color:red">*</strong></h6>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user add-input p-2"
                                    name="description" placeholder="e.g. unit of measurement(kg) etc." value="{{ $material->description }}">
                                @error('description')
                                    <p class="mb-0" style="color: red; font-size:12px;">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                            <h6 class="mb-0">Quantity<strong style="color:red">*</strong></h6>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user add-input p-2"
                                    name="quantity" placeholder="0" value="{{ $material->quantity }}">
                                @error('quantity')
                                    <p class="mb-0" style="color: red; font-size:12px;">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <h6 class="mb-0">Unit Price<strong style="color:red">*</strong>
                                        <input type="currency" class="form-control form-control-user add-input p-2"
                                            name="unit_price" placeholder="0.00" value="{{ $material->unit_price }}">
                                        @error('unit_price')
                                            <p class="mb-0" style="color: red; font-size:12px;">
                                                <strong>{{ $message }}</strong>
                                            </p>
                                        @enderror
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="mb-0">Supplier<strong style="color:red">*</strong></h6>
                                    <select name="supplier_id" class="custom-select add-input p-2">
                                        <option value="" **selected**>--Select--</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="myBtn" class="btn btn-primary btn-user p-2"
                                    style="font-size: 18px; width: 200px;" type="submit">
                                    <h6 class="mb-0">Submit</h6>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @if ($errors->any())
                <div class="col-12 bg-gradient-warning btn-icon-split shadow animated--grow-in"
                    style="border-radius: 8px; border: 0px;">
                    <span class="icon text-white-50">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text text-white">Failed to submit, please try again.</span>
                </div>
            @endif
        </div>
    </div>
    <script>
        // Salary input currency
        var currencyInput = document.querySelector('input[type="currency"]')
        var currency = 'PHP' // https://www.currency-iso.org/dam/downloads/lists/list_one.xml

        // format inital value
        onBlur({
            target: currencyInput
        })

        // bind event listeners
        currencyInput.addEventListener('focus', onFocus)
        currencyInput.addEventListener('blur', onBlur)


        function localStringToNumber(s) {
            return Number(String(s).replace(/[^0-9.,-]+/g, ""))
        }

        function onFocus(e) {
            var value = e.target.value;
            e.target.value = value ? localStringToNumber(value) : ''
        }

        function onBlur(e) {
            var value = e.target.value

            var options = {
                maximumFractionDigits: 2,
                currency: currency,
                style: "currency",
                currencyDisplay: "symbol"
            }

            e.target.value = (value || value === 0) ?
                localStringToNumber(value).toLocaleString(undefined, options) :
                ''
        }
    </script>
@endsection

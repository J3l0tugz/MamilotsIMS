@extends('layouts.appEmployee')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-white" style="font-weight: 700;">Raw Materials</h1>

        <!-- DataTales Example -->
        <div class="card mb-4">
            @if ($errors->all())
                <div class="bg-gradient-warning btn-icon-split shadow animated--grow-in"
                    style="border-radius: 8px 8px 0 0; border: 0px;">
                    <span class="icon text-white-50">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    <span class="text text-white">Failed to submit, please try again.</span>
                </div>
            @endif
            @if (@session()->has('create success'))
                <div class="bg-gradient-success btn-icon-split shadow animated--grow-in"
                    style="border-radius: 8px 8px 0 0; border: 0px;">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text text-white">A record was successfully created.</span>
                </div>
            @endif
            @if (@session()->has('updated'))
                <div class="bg-gradient-success btn-icon-split shadow animated--grow-in"
                    style="border-radius: 8px 8px 0 0; border: 0px;">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text text-white">The record was successfully updated.</span>
                </div>
            @endif
            @if (@session()->has('delete success'))
                <div class="bg-gradient-success btn-icon-split shadow animated--grow-in"
                    style="border-radius: 8px 8px 0 0; border: 0px;">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text text-white">The record was successfully deleted.</span>
                </div>
            @endif

            <div class="card-body">
                <div class="float-right">
                    <!--Add modal button-->
                    <button id="myBtn-add" class="btn-primary btn-circle px-3 mb-3">
                        <li class="fa fa-plus-circle"></li>
                    </button>
                    <!-- The Modal -->
                    <div id="myModal" class="modal-add animated--fade-in">
                        <!-- Modal content -->
                        <div class="modal-content-add">
                            <span class="close">&times;</span>
                            <div class="p-1 p-sm-5">
                                <h2 style="font-weight: 900; color: #222831;" class="mb-2 mb-md-5">Add Raw Material
                                </h2>
                                <form class="user" action="{{ route('material.saveEmployee') }}" method="POST">
                                    @csrf
                                    <h6 class="mb-0">Item Name<strong style="color:red">*</strong></h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user add-input p-2"
                                            name="name" placeholder="Item" value="{{ old('name') }}">
                                        @error('name')
                                            <p class="mb-0" style="color: red; font-size:12px;">
                                                <strong>{{ $message }}</strong>
                                            </p>
                                        @enderror
                                    </div>
                                    <h6 class="mb-0">Description<strong style="color:red">*</strong></h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user add-input p-2"
                                            name="description" placeholder="e.g. unit of measurement(kg) etc."
                                            value="{{ old('description') }}">
                                        @error('description')
                                            <p class="mb-0" style="color: red; font-size:12px;">
                                                <strong>{{ $message }}</strong>
                                            </p>
                                        @enderror
                                    </div>
                                    <h6 class="mb-0">Quantity<strong style="color:red">*</strong></h6>
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-user add-input p-2"
                                            name="quantity" placeholder="0" value="{{ old('quantity') }}">
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
                                                    name="unit_price" placeholder="0.00" value="{{ old('unit_price') }}">
                                                @error('unit_price')
                                                    <p class="mb-0" style="color: red; font-size:12px;">
                                                        <strong>{{ $message }}</strong>
                                                    </p>
                                                @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Supplier<strong style="color:red">*</strong></h6>
                                            <select name="supplier_id" class="custom-select add-input p-2">
                                                <option selected value="">--Select--</option>
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
                <div class="table-responsive p-1">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0vw">
                        <thead>
                            <tr style="color: #222831 !important;">
                                <th>ID</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Supplier</th>
                                <th>Listed at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>ID</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Supplier</th>
                            <th>Listed at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tfoot>
                        <tbody>
                            @foreach ($materials as $material)
                                <tr>
                                    <td class="text-center">{{ $material['id'] }}</td>

                                    <!--This should display first name and last name only-->
                                    <td>{{ $material['name'] }}</td>
                                    <td>{{ $material['description'] }}</td>
                                    <td>{{ $material['quantity'] }}</td>
                                    <td>₱{{ number_format($material->unit_price, 2) }}</td>
                                    <td>{{ $material->supplier->name }}</td>
                                    <td>{{ $material['created_at'] }}</td>
                                    <td>{{ $material['updated_at'] }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal"
                                            class="btn bg-danger text-white mb-1"
                                            style="border: 0px !important; box-shadow: 0 0.125rem 0.25rem 0 rgba(58, 59, 69, 0.2) !important;">
                                            <div class="fa fa-trash"></div>
                                        </a>
                                        {{-- Delete Confirmation Modal --}}
                                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation
                                                        </h5>
                                                        <div type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close" style="box-shadow: 0 !important;">
                                                            <span aria-hidden="true">×</span>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete the item?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <form
                                                            action="{{ route('material.delete', ['id' => $material->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn bg-gradient-danger shadow btn-block text-white"
                                                                style="border: 0px !important;">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('material.edit', $material['id']) }}" <button
                                            class="btn bg-primary mb-1 shadow text-white"
                                            style=" border: 0px !important; box-shadow: 0 0.125rem 0.25rem 0 rgba(58, 59, 69, 0.2) !important;">
                                            <div class="fa fa-pencil-alt"></div></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!--apply to all indexes----------------------------------------------->
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn-add");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it


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
    <!-- /.container-fluid -->
@endsection

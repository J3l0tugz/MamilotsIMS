@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-white" style="font-weight: 700;">Products</h1>

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
                    <!--Add button-->
                    <button id="myBtn-add" class="btn-primary btn-circle px-3 mb-3">
                        <a href="{{ route('product.scan') }}">
                            <li class="fa fa-plus-circle text-white"></li>
                        </a>
                    </button>
                    <!--Minus Button-->
                    <button id="myBtn-add" class="btn-primary btn-circle px-3 mb-3">
                        <a href="{{ route('product.scan.decrease') }}">
                            <li class="fa fa-minus-circle text-white"></li>
                        </a>
                    </button>
                </div>
                <div class="table-responsive p-1">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0vw">
                        <thead>
                            <tr style="color: #222831 !important;">
                                <th>ID</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Listed at</th>
                                <th>Updated at</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Listed at</th>
                            <th>Updated at</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tfoot>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">{{ $product['id'] }}</td>

                                    <!--This should display first name and last name only-->
                                    <td>{{ $product['product_name'] }}</td>
                                    <td>{{ $product['description'] }}</td>
                                    <td>{{ $product['quantity'] }}</td>
                                    <td>₱{{ $product['unit_price'] }}</td>
                                    <td>{{ $product['created_at'] }}</td>
                                    <td>{{ $product['updated_at'] }}</td>

                                    @if ($product['quantity'] > 70)
                                        <td class="bg-gradient-success text-white">High Stock</td>
                                    @elseif ($product['quantity'] > 15 && $product['quantity'] < 71)
                                        <td class="bg-gradient-info text-white">Near Low Stock</td>
                                    @elseif ($product['quantity'] > 0 && $product['quantity'] < 16)
                                        <td class="bg-gradient-warning text-white">Low Stock</td>
                                    @elseif ($product['quantity'] == 0)
                                        <td class="bg-gradient-danger text-white">Out of Stock</td>
                                    @endif

                                    <td> <a href="#" data-toggle="modal" data-target="#deleteModal"
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
                                                        <form action="{{ route('product.delete', ['id' => $product->id]) }}"
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
                                        <a href="{{ route('product.edit', $product['id']) }}" <button
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
    <!-- /.container-fluid -->
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid">


        <h1 class="h3 mb-2 text-white mx-3" style="font-weight: 700;">Edit Product Description</h1>
        <div class="col d-flex justify-content-center">
            <div class="card mb-4 col-12">
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{ route('product.index') }}" class="btn btn-sm shadow btn-warning mb-4">
                            <div class="fa fa-arrow-alt-circle-left mr-lg-2 m-1"></div>Go back
                        </a>
                    </div>
                    <div class="mt-5">
                        <form method="POST" action="{{ route('product.update', ['id' => $product->id]) }}">
                            @csrf
                            <h6 class="mb-0">Description<strong style="color:red">*</strong></h6>
                            <div class="form-group row">
                                <div class="col-sm-8 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user add-input p-2"
                                        name="description" placeholder="description" value="{{ $product->description }}">
                                    @error('description')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <h6 class="mb-0">Unit Price<strong style="color:red">*</strong></h6>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user add-input p-2"
                                        name="unit_price" placeholder="0.00" value="{{ $product->unit_price }}">
                                    @error('unit_price')
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
@endsection

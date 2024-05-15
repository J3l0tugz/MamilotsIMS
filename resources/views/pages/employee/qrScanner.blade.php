@extends('layouts.appEmployee')

@section('content')
    <div class="container">
        <h3 for="text" class="text-white"><strong>Scan to Add Product</strong></h3>
        <div class="float-right">
            <a href="{{ route('product.indexEmployee') }}" class="btn btn-sm shadow btn-warning mb-4">
                <div class="fa fa-arrow-alt-circle-left mr-lg-2 m-1"></div>Go back
            </a>
        </div>
        <div class="row">
            <div class="col-md-7 mb-0 p-0">
                <video id="preview" width="100%" style="border-radius: 8px 8px 0 0;"></video>
                @if ($errors->all())
                    <div class="bg-gradient-warning btn-icon-split shadow animated--grow-in"
                        style="border-radius: 8px 8px 0 0; border: 0px;">
                        <span class="icon text-white-50">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <span class="text text-white">Failed to submit, please try again.</span>
                    </div>
                @endif
                @if (@session()->has('create_success'))
                    <div class="bg-gradient-success btn-icon-split shadow animated--grow-in col-12 mt-0"
                        style="border-radius: 0 0 8px 8px; border: 0px;">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text text-white">{{ session('create_success') }}</span>
                    </div>
                @endif
                @if (@session()->has('updated'))
                    <div class="bg-gradient-success btn-icon-split shadow animated--grow-in"
                        style="border-radius: 8px 8px 0 0; border: 0px;">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text text-white">The product was successfully updated.</span>
                    </div>
                @endif
                @if (@session()->has('delete success'))
                    <div class="bg-gradient-success btn-icon-split shadow animated--grow-in"
                        style="border-radius: 8px 8px 0 0; border: 0px;">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text text-white">The product was successfully deleted.</span>
                    </div>
                @endif
            </div>
            <form id="qr-form" action="{{ route('product.saveEmployee') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="col-md-12">
                    <input type="hidden" name="text" id="text" placeholder="qr code" class="form-control"
                        style="background-color:lightgray; border-radius: 8px 8px 0 0;">
                </div>
            </form>
            <audio id="success-sound" src="{{ asset('media/beepSound.m4a') }}"></audio>
        </div>
    </div>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById("preview")
        });
        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }
        }).catch(function(e) {
            console.error(e)
        });

        scanner.addListener('scan', function(c) {
            document.getElementById("text").value = c;
            document.getElementById('qr-form').submit();
        });

        scanner.addListener('scan', function(c) {
            document.getElementById("text").value = c;
            document.getElementById('qr-form').submit();

            // Play the success sound
            const successSound = document.getElementById('success-sound');
            successSound.play();
        });
    </script>
@endsection

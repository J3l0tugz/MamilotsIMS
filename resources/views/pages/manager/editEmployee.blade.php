@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-white mx-3" style="font-weight: 700;">Edit @if ($employee['role'] == 0)
                employee
            @elseif ($employee['role'] == 1)
                manager
            @endif
        </h1>
        <div class="col d-flex justify-content-center">
            <div class="card mb-4 col-12">
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{ route('employee.index') }}" class="btn btn-sm shadow btn-warning mb-4">
                            <div class="fa fa-arrow-alt-circle-left mr-lg-2 m-1"></div>Go back
                        </a>
                    </div>
                    <div class="mt-5">
                        <form method="POST" action="{{ route('employee.update', ['id' => $employee->id]) }}">
                            @csrf
                            <h6 class="mb-0">Name<strong style="color:red">*</strong></h6>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user add-input p-2"
                                        name="first_name" placeholder="First Name" value="{{ $employee->first_name }}">
                                    @error('first_name')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user add-input p-2"
                                        name="middle_name" placeholder="Middle Name" value="{{ $employee->middle_name }}">
                                    @error('middle_name')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-user add-input p-2"
                                        name="last_name" placeholder="Last Name" value="{{ $employee->last_name }}">
                                    @error('last_name')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <h6 class="mb-0">Address<strong style="color:red">*</strong></h6>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user add-input p-2" name="address"
                                    placeholder="Home Address" value="{{ $employee->address }}">
                                @error('address')
                                    <p class="mb-0" style="color: red; font-size:12px;">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <h6 class="mb-0">Date of Birth<strong style="color:red">*</strong>
                                    </h6>
                                    <input type="date" class="form-control form-control-user add-input p-2"
                                        name="date_of_birth" placeholder="Date of Birth"
                                        value="{{ $employee->date_of_birth }}">
                                    @error('date_of_birth')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <div class="col-sm-4  mb-3 mb-sm-0">
                                    <h6 class="mb-0">Sex<strong style="color:red">*</strong></h6>
                                    <select name="sex" class="custom-select add-input p-2">
                                        <option value="" **selected**>--Select--</option>
                                        <option value="Male" {{ $employee->sex == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ $employee->sex == 'Female' ? 'selected' : '' }}>
                                            Female
                                        </option>
                                    </select>
                                    @error('sex')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <div class="col-sm-4">
                                    <h6 class="mb-0">Phone no.<strong style="color:red">*</strong>
                                    </h6>
                                    <input type="tel" class="form-control form-control-user add-input p-2"
                                        name="phone_no" placeholder="Phone no." value="{{ $employee->phone_no }}">
                                    @error('phone_no')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <h6 class="mb-0">Salary<strong style="color:red">*</strong></h6>
                                    <input type='currency' class="form-control form-control-user add-input p-2"
                                        name="salary" placeholder="0.00" value="{{ $employee->salary }}">
                                    @error('salary')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0 d-none d-md-block">

                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0 hide" id="passwordInput">
                                    <h6 class="mb-0">Reset Password<strong style="color:red">*</strong></h6>
                                    <input type='password' class="form-control form-control-user add-input p-2"
                                        name="password" placeholder="New Password">
                                    @error('password')
                                        <p class="mb-0" style="color: red; font-size:12px;">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button id="myBtn" class="btn btn-primary btn-user p-2 mb-3"
                                    style="font-size: 18px; width: 200px;" type="submit">
                                    <h6 class="mb-0">Submit</h6>
                                </button>
                            </div>
                        </form>
                        <div class="float-right">
                            <!--Add modal button-->
                            <button id="myBtn-add"
                                class="btn-primary p-2 px-3 mb-3 btn-circle fa fa-plus-circle"></button>
                            <!-- The Modal -->
                            <div id="myModal-password" class="modal-add animated--fade-in">
                                <!-- Modal content -->
                                <div class="modal-content-add" style="margin-top: 11vw; width: 50%;">
                                    <span class="close">&times;</span>
                                    <div class="p-1 p-sm-3">
                                        <h2 style="font-weight: 900; color: #222831;" class="mb-2 mb-md-5">Reset Password
                                        </h2>
                                        <form class="user"
                                            action="{{ route('employee.resetPassword', ['id' => $employee->id]) }}"
                                            method="POST">
                                            @csrf
                                            <h6 class="mb-0">New Password<strong style="color:red">*</strong></h6>
                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-3">
                                                    <input type="password"
                                                        class="form-control form-control-user add-input p-2"
                                                        name="password" placeholder="Password"
                                                        value="{{ old('password') }}">
                                                    @error('password')
                                                        <p class="mb-0" style="color: red; font-size:12px;">
                                                            <strong>{{ $message }}</strong>
                                                        </p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button id="myBtn-reset" class="btn btn-primary btn-user p-2"
                                                    style="font-size: 18px; width: 200px;" type="submit">
                                                    <h6 class="mb-0">Submit</h6>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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

        // Get the modal
        var modal = document.getElementById("myModal-password");

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
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-white" style="font-weight: 700;">Users</h1>

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
                    <button id="myBtn-add" class="btn-primary p-2 px-3 mb-3 btn-circle fa fa-plus-circle"></button>
                    <!-- The Modal -->
                    <div id="myModal" class="modal-add animated--fade-in">
                        <!-- Modal content -->
                        <div class="modal-content-add">
                            <span class="close">&times;</span>
                            <div class="p-1 p-sm-5">
                                <h2 style="font-weight: 900; color: #222831;" class="mb-2 mb-md-5">Add User
                                </h2>
                                <form class="user" action="{{ route('employee.save') }}" method="POST">
                                    @csrf
                                    <h6 class="mb-0">Name<strong style="color:red">*</strong></h6>
                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user add-input p-2"
                                                name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                                            @error('first_name')
                                                <p class="mb-0" style="color: red; font-size:12px;">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user add-input p-2"
                                                name="middle_name" placeholder="Middle Name"
                                                value="{{ old('middle_name') }}">
                                            @error('middle_name')
                                                <p class="mb-0" style="color: red; font-size:12px;">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user add-input p-2"
                                                name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                                            @error('last_name')
                                                <p class="mb-0" style="color: red; font-size:12px;">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <h6 class="mb-0">Address<strong style="color:red">*</strong></h6>
                                            </h6>
                                            <input type="text" class="form-control form-control-user add-input p-2"
                                                name="address" placeholder="Home Address" value="{{ old('address') }}">
                                            @error('address')
                                                <p class="mb-0" style="color: red; font-size:12px;">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Phone no.<strong style="color:red">*</strong></h6>
                                            <input type="tel" class="form-control form-control-user add-input p-2"
                                                name="phone_no" placeholder="Phone no." value="{{ old('phone_no') }}">
                                            @error('phone_no')
                                                <p class="mb-0" style="color: red; font-size:12px;">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <h6 class="mb-0">Date of Birth<strong style="color:red">*</strong>
                                            </h6>
                                            <input type="date" class="form-control form-control-user add-input p-2"
                                                name="date_of_birth" placeholder="Date of Birth"
                                                value="{{ old('date_of_birth') }}">
                                            @error('date_of_birth')
                                                <p class="mb-0" style="color: red; font-size:12px;">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <h6 class="mb-0">Sex<strong style="color:red">*</strong></h6>
                                            <select name="sex" class="custom-select add-input p-2">
                                                <option selected value="">--Select--</option>
                                                <option value="male {{ old('value') }}">Male</option>
                                                <option value="female {{ old('value') }}">Female</option>
                                            </select>
                                            @error('sex')
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
                                                name="salary" placeholder="0.00" value="{{ old('salary') }}">
                                            @error('salary')
                                                <p class="mb-0" style="color: red; font-size:12px;">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4  mb-3 mb-sm-0">
                                            <h6 class="mb-0">Password<strong style="color:red">*</strong>
                                            </h6>
                                            <input type="password" class="form-control form-control-user add-input p-2"
                                                name="password" placeholder="Password" value="{{ old('password') }}">
                                            @error('password')
                                                <p class="mb-0" style="color: red; font-size:12px;">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-4  mb-3 mb-sm-0">
                                            <h6 class="mb-0">Position<strong style="color:red">*</strong></h6>
                                            <select name="role" class="custom-select add-input p-2">
                                                <option selected value="">--Select--</option>
                                                <option value="0 {{ old('value') }}">Employee</option>
                                                <option value="1 {{ old('value') }}">Manager</option>
                                            </select>
                                            @error('role')
                                                <p class="mb-0" style="color: red; font-size:12px;">
                                                    <strong>{{ $message }}</strong>
                                                </p>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="employee_id"
                                            value="{{ generateRandomEmployeeID() }}">
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
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Phone no.</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Employee ID</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Phone no.</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Employee ID</th>
                            <th>Actions</th>
                        </tfoot>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td class="text-center">{{ $employee['id'] }}</td>

                                    <!--This should display first name and last name only-->
                                    <td>{{ $employee['first_name'] }} {{ $employee['last_name'] }}</td>
                                    <td>{{ $employee['sex'] }}</td>
                                    <td>{{ $employee['phone_no'] }}</td>
                                    <td>{{ $employee['address'] }}</td>
                                    <td>
                                        @if ($employee['role'] == 0)
                                            Employee
                                        @elseif ($employee['role'] == 1)
                                            Manager
                                        @endif
                                    </td>
                                    <td>{{ $employee['employee_id'] }}</td>
                                    <td><a href="{{ route('employee.view', $employee['id']) }}" <button
                                            class="btn bg-info mb-1 shadow text-white"
                                            style=" border: 0px !important; box-shadow: 0 0.125rem 0.25rem 0 rgba(58, 59, 69, 0.2) !important;"><i
                                                class="fa fa-id-card" aria-hidden="true"></i></button></a>
                                        <a href="{{ route('employee.edit', $employee['id']) }}" <button
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

    <!-- Employee-ID Generator -->
    <?php
    function generateRandomEmployeeID()
    {
        // Generate 3 random uppercase letters
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomLetters = substr(str_shuffle($letters), 0, 3);

        // Generate 3 random digits
        $randomDigits = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);

        // Combine letters, dash, and digits
        $employeeID = $randomLetters . '-' . $randomDigits;

        return $employeeID;
    }
    ?>


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

        // Salary input currency
        var currencyInput = document.querySelector('input[type="currency"]');
        var currency = 'PHP'; // ISO currency code (e.g., PHP)

        // Format initial value
        onBlur({
            target: currencyInput
        });

        // Bind event listeners
        currencyInput.addEventListener('focus', onFocus);
        currencyInput.addEventListener('blur', onBlur);

        function localStringToNumber(s) {
            // Remove all non-numeric characters except for periods and commas
            const cleanedValue = String(s).replace(/[^0-9.,-]+/g, '');

            // Convert the cleaned value to a number
            return Number(cleanedValue);
        }

        function onFocus(e) {
            var value = e.target.value;
            e.target.value = value ? localStringToNumber(value) : '';
        }

        function onBlur(e) {
            var value = e.target.value;
            var options = {
                maximumFractionDigits: 2,
                currency: currency,
                style: 'currency',
                currencyDisplay: 'symbol'
            };

            e.target.value = value || value === 0 ?
                localStringToNumber(value).toLocaleString(undefined, options) :
                '';
        }
        // When the user clicks anywhere outside of the modal, close it
    </script>
    <!-- /.container-fluid -->
@endsection

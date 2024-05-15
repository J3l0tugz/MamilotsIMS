@extends("layouts.app")

@section('content')
    <div class="content">
        <div class="content-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">New Employee</h3>
                                    <div class="float-right">
                                        <a href="{{ route('employee.index')}}" class="btn btn-sm btn-warning">Go Back</a>
                                    </div>
                                    </div>
                                    <form method="POST" action="{{ route('employee.save')}}">
                                        @csrf
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="firstname">First Name</label>
                                                    <input type="text" class="form-control" id="firstname" placeholder="First Name" name="first_name" value="{{ old('first_name')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lastname">Last Name</label>
                                                    <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="last_name" value="{{ old('last_name')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="middlename">Middle Name</label>
                                                    <input type="text" class="form-control" id="middlename" placeholder="Middle Name" name="middle_name" value="{{ old('middle_name')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="employeeId">Employee ID</label>
                                                    <input type="text" class="form-control" id="employeeId" placeholder="Employee Id" name="employee_id" value="{{ old('employee_id')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_of_birth">Date of Birth</label>
                                                    <input type="date" class="form-control" id="email" placeholder="Data of birth" name="date_of_birth" value="{{ old('date_of_birth')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="postition_name">Position Name</label>
                                                    <input type="text" class="form-control" id="email" placeholder="Position Name" name="position_name" value="{{ old('position_name')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sex">Sex</label>
                                                    <select name="sex" class="custom-select">
                                                        <option value="">--Select</option>
                                                        <option selected value="male {{ old('value') }}">Male</option>
                                                        <option selected value="female {{ old('value') }}">Female</option>
                                                    </select>

                                                <div class="form-group">
                                                    <label for="department">Department</label>
                                                    <input type="text" class="form-control" id="department" placeholder="Department" name="department">
                                                </div>
                                                <div class="form-group">
                                                    <label for="years">Years in Service</label>
                                                    <input type="text" class="form-control" id="years" placeholder="Years in Service" name="years_in_service">
                                                </div>
                                                <div class="form-group">
                                                    <label for="firstname">Salary</label>
                                                    <input type="salary" class="form-control" id="salary" placeholder="Salary" name="salary">
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-3 pr-0">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('dist/img/user4-128x128.jpg') }}"
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $employee->first_name }} {{ $employee->middle_name}} {{ $employee->last_name }}</h3>

                    <p class="text-muted text-center">{{ $employee->position_name }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Employee ID</b> <a class="float-right">{{ $employee->employee_id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Years in Service</b> <a class="float-right">{{ $employee->years_in_service }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Department</b> <a class="float-right">{{ $employee->department }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Salary</b> <a class="float-right">{{ number_format($employee->salary, 2) }}</a>
                        </li>
                    </ul>

                    <form action="{{ route('employee.delete', ['id' => $employee->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </div>
        <div class="col-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About Me</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fa fa-envelope mr-1" aria-hidden="true"></i>Email</strong>

                    <p class="text-muted">
                        {{ $employee->email }}
                    </p>

                    <hr>

                    <strong><i class="fa fa-venus-mars mr-1" aria-hidden="true"></i>Sex</strong>

                    <p class="text-muted">{{ $employee->sex }}</p>

                    <hr>

                    <strong><i class="fa fa-birthday-cake mr-1" aria-hidden="true"></i>Birthdate</strong>

                    <p class="text-muted">{{ $employee->date_of_birth }}</p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    </div>
@endsection

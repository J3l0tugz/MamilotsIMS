@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-0 ml-0 row">
            <h1 class="h3 mb-2 text-white" style="font-weight: 700;">User</h1>
            <div class="float-right">
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-warning shadow mr-3 mb-1"
                    style="margin-right: 12px !important; border: .35rem !important;"><img
                        src="{{ asset('media/arrow-go-back.png') }}" style="width: 20px;">Go back</a>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-4">

                <!-- Basic Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="text-center">
                            <!-- Only use square cropped photos for profile -->
                            <img src="{{ $employee->sex == 'Female' ? asset('media/female_profile.png') : asset('media/male_profile.png') }}"
                                alt="Profile Picture" class="img-profile rounded-circle o-hidden shadow"
                                style="width: 60%;">
                            <h4 class="text-center text-gray-900 mt-4 mb-0">{{ $employee->first_name }}
                                {{ $employee->middle_name }}
                                {{ $employee->last_name }}</h4>
                            <p class="text-muted text-center">
                                @if ($employee['role'] == 0)
                                    Employee
                                @elseif ($employee['role'] == 1)
                                    Manager
                                @endif
                            </p>
                        </div>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Employee ID</b> <a class="float-right">{{ $employee->employee_id }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Salary</b> <a class="float-right">₱{{ number_format($employee->salary, 2) }}</a>
                            </li>
                        </ul>

                        <a href="#" data-toggle="modal" data-target="#deleteModal"
                            class="btn bg-gradient-danger shadow text-white btn-block mb-1" style="border: 0px !important;">
                            Delete
                        </a>
                        {{-- Delete Confirmation Modal --}}
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation
                                        </h5>
                                        <div type="button" class="close" data-dismiss="modal" aria-label="Close"
                                            style="box-shadow: 0 !important;">
                                            <span aria-hidden="true">×</span>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the user?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <form action="{{ route('employee.delete', ['id' => $employee->id]) }}"
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
                        <!-- /.modal-content -->
                    </div>
                </div>

            </div>

            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Personal details</h6>
                    </div>
                    <div class="card-body">
                        <div class="card-body p-1">
                            <strong><i class="fa fa-venus-mars mr-1" aria-hidden="true"></i>Sex</strong>

                            <p class="text-muted">{{ $employee->sex }}</p>

                            <hr>

                            <strong><i class="fa fa-birthday-cake mr-1" aria-hidden="true"></i>Birthdate</strong>

                            <p class="text-muted">{{ $employee->date_of_birth }}</p>

                            <hr>

                            <strong><i class="fa fa-phone mr-1" aria-hidden="true"></i>Phone no.</strong>

                            <p class="text-muted">
                                {{ $employee->phone_no }}
                            </p>

                            <hr>

                            <strong><i class="fa fa-home mr-1" aria-hidden="true"></i>Home Address</strong>

                            <p class="text-muted mb-0">
                                {{ $employee->address }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    </div>
@endsection

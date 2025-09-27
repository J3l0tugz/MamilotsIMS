@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Employees</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('employee.dark') }}">Dark Mode</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if (@session()->has('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-2">Employees</h5>
                            <div class="float-right">
                                <a href="{{ route('employee.add') }}" class="btn btn-primary mb-2">New Employee</a>
                            </div>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <th>ID</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Employee ID</th>
                                    <th>Actions</th>
                                </thead>

                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td class="text-center">{{ $employee['id'] }}</td>
                                            <td>{{ $employee['first_name'] }}</td>
                                            <td>{{ $employee['last_name'] }}</td>
                                            <td>{{ $employee['email'] }}</td>
                                            <td>{{ $employee['department'] }}</td>
                                            <td>{{ $employee['employee_id'] }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('employee.info', ['id' => $employee['id']]) }}" <button
                                                    class="btn btn-info">View</button></a>
                                                <a href="{{ route('employee.edit', ['id' => $employee['id']]) }}" <button
                                                    class="btn btn-warning">Edit</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

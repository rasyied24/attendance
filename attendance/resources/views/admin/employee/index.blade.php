@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ul class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.create') }}" class="btn btn-icon btn-primary">
                                <i class="nav-icon fa fa-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Employee</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>DoB</th>
                                <th>City</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee as $i => $data)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $data->name ?? '-' }}</td>
                                    <td>{{ !empty($data->dob) ? $data->dob->format('d-m-Y') : '-'  }}</td>
                                    <td>{{ $data->city ?? '-' }}</td>
                                    <td>{{ $data->email ?? '-' }}</td>
                                    <td>
                                        @switch($data->status)
                                            @case(1)
                                                <span class="badge badge-pill badge-success">{{ $data->status_text }}</span>
                                                @break

                                            @case(2)
                                                <span class="badge badge-pill badge-danger">{{ $data->status_text }}</span>
                                                @break

                                            @default
                                                <span class="badge badge-pill badge-warning">{{ $data->status_text }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('employee.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

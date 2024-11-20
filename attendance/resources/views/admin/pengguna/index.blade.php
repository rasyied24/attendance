@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Create Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $i => $data)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $data->name ?? '-' }}</td>
                                    <td>{{ $data->email ?? '-' }}</td>
                                    <td>{{ !empty($data->create_date) ? $data->create_date->format('d-m-Y') : '-'  }}</td>
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

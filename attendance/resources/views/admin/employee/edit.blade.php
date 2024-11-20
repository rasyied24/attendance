@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Employee</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <!-- form start -->
                <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    @if (!empty($employee->id))
                        @method('PUT')
                    @endif

                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" autocomplete="off" value="{{ $employee->name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" autocomplete="off" value="{{ $employee->email ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="dob">DoB</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="dob" class="form-control" id="tanggal_lahir" data-target="#reservationdate" value="{{ $employee->dob->format('d-m-Y') ?? '' }}"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" class="form-control" id="city" placeholder="Enter city" autocomplete="off" value="{{ $employee->city ?? '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2" name="status" id="status">
                                        <option></option>
                                        <option value="1" {{ !empty($employee->status) && $employee->status == 1 ? ' selected="selected"' : '' }}>Active</option>
                                        <option value="2" {{ !empty($employee->status) && $employee->status == 2 ? ' selected="selected"' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#reservationdate').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                orientation: "bottom",
                endDate: "today"

            });
        });
    </script>
@endsection

@extends('layoutAdmin.main')
@section('useDataTable', '1')

@section('content')
    <section class="content">
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data For Table User</h3>
                    </div>
                    <div class="box-header">
                        <a href="/register" class="btn btn-primary btn-sm pull-left" style="margin-right: 5px;"><i
                                class="fa fa-user"></i>
                            Register</a>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">No</th>
                                    <th>Fullname</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    {{-- @dd($admin) --}}
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->Fullname }}</td>
                                        <td>{{ $admin->{'Phone Number'} ?: '-' }}</td>
                                        <td>{{ $admin->{'Email'} }}</td>
                                        <td>
                                            @if ($admin->Status == 'Non-active')
                                                <span class="badge alert-danger">Non-active</span>
                                            @else
                                                <span class="badge alert-success">Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

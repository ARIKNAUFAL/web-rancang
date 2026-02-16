@extends('layoutAdmin.main')
@section('useDataTable', '1')

@section('content')
    <section class="content">
        <div class="row" style="margin-top: 10px;">
            <div class="col-xs-12">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Success!</h4>
                    {{ session('success') }}
                </div>
                @endif
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data For Table User</h3>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 20px;">No</th>
                                    <th>Admin Id</th>
                                    <th>Audit Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($activity as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->admin_id }}</td>
                                        <td>{{ $data->audit_action }}</td>

                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

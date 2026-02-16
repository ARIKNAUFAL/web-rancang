@extends('layoutAdmin.main')

@section('content')
<section class="content">
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ session('success') }}
            </div>
            @endif
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Setting</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle"
                                        src="{{ $admin->photo_profile ? asset('userPhoto/'.$admin->photo_profile) : asset('templateAdmin/dist/image/avatar.png') }}" alt="User profile picture">

                                    <h3 class="profile-username text-center">{{ $admin->first_name.' '.$admin->last_name }}</h3>

                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>Email</b> <a class="pull-right">{{ $admin->email }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Phone Number</b> <a class="pull-right">{{ $admin->phone_number }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Gender</b> <a class="pull-right">{{ $admin->gender }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Address</b> <a class="pull-right">{{ $admin->address }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Status</b> <a class="pull-right">{{ $admin->status }}</a>
                                        </li>
                                    </ul>

                                    <a href="/update-profile-admin/{{ $admin->id }}"
                                        class="btn btn-primary btn-block"><b>Update My Profile</b></a>
                                    <a href="/change-password"
                                        class="btn btn-primary btn-block"><b>Change Password</b></a>
                                        <button type="button" class="btn btn-sm btn-danger btn btn-primary btn-block" data-toggle="modal"
                                        data-target="#delete"><i class="fa fa-trash"></i>
                                        Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Status Admin</h4>
            </div>
            <div class="modal-body">
                <p>Are you to delete this account ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <a href="/change-status-admin/{{ Session()->get('admin_id') }}" class="btn btn-danger">Yes</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@extends('layoutAdmin.main')

@section('content')
<section class="content">
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Form Change password</h3>
                    <a href="/profile-admin/{{ Session()->get('admin_id') }}" class="btn btn-default btn-sm pull-right"><i
                            class="fa fa-arrow-circle-left"></i>
                        Back</a>
                </div>
                <div class="box-body">
                    <div class="box box-primary">
                        <form action="/change-password/{{Session()->get('admin_id')}}" method="POST" role="form">
                            @csrf
                            <div class="box-body">
                                @if (session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Failed !</h4>
                                    {{ session('error') }}
                                </div>
                                @endif
                                @if (session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Success!</h4>
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input type="password" class="form-control" name="oldPassword"
                                                    placeholder="Enter Current Password">
                                                @error('oldPassword')
                                                    <span id="oldPassword" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" class="form-control" name="newPassword"
                                                placeholder="Enter new password">
                                            @error('newPassword')
                                                <span id="newPassword" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
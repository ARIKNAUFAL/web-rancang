@extends('layoutAdmin.main')

@section('content')
<section class="content">
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Form Update Profile</h3>
                    <a href="/profile-admin/{{ $admin->id }}" class="btn btn-default btn-sm pull-right"><i
                            class="fa fa-arrow-circle-left"></i>
                        Back</a>
                </div>
                <div class="box-body">
                    <div class="box box-primary">
                        <form action="/update-profile-admin/{{ $admin->id }}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="first_name"
                                                placeholder="Enter first name" value="{{ $admin->first_name }}">
                                            @error('first_name')
                                                <span id="first_name" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" name="last_name"
                                                placeholder="Enter first name" value="{{ $admin->last_name }}">
                                            @error('last_name')
                                                <span id="last_name" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                placeholder="Enter address" value="{{ $admin->address }}">
                                            @error('address')
                                                <span id="address" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="number" class="form-control" name="phone_number"
                                                placeholder="Enter phone number" value="{{ $admin->phone_number }}">
                                            @error('phone_number')
                                                <span id="phone_number" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="{{ $admin->gender }}">{{ $admin->gender }}</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            @error('gender')
                                                <span id="gender" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Enter email" value="{{ $admin->email }}">
                                            @error('email')
                                                <span id="email" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Photo</label>
                                            <input type="file" class="form-control" name="photo_profile"
                                                placeholder="Enter photo" id="preview_gambar">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Preview Photo</label><br>
                                            <img src="{{ $admin->photo_profile ? asset('userPhoto/'.$admin->photo_profile) : asset('templateAdmin/dist/image/avatar.png') }}" id="gambar_load" width="150"
                                                height="" alt="Photo">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
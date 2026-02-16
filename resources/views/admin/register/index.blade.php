@extends('layoutAdmin.main')

@section('content')
<section class="content">
    <div class="row" style="margin-top: 10px;">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Form Register User</h3>
                    <a href="/user-manage" class="btn btn-default btn-sm pull-right"><i
                            class="fa fa-arrow-circle-left"></i>
                        Back</a>
                </div>
                <div class="box-body">
                    <div class="box box-primary">
                        <form action="/register" method="POST" role="form">
                            @csrf

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        
                                        @if (session('success'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-check"></i> Success!</h4>
                                            {{ session('success') }}
                                        </div>
                                        @endif
                                        
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" value="{{ old('username') }}"
                                                placeholder="Enter username" required autofocus>
                                            @error('username')
                                                <span id="username" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                                placeholder="Enter Email" required>
                                            @error('email')
                                                <span id="email" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Enter Password" required>
                                            @error('password')
                                                <span id="password" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" name="confirmPassword"
                                                placeholder="Enter Confirm Password" required>
                                            @error('confrimPassword')
                                                <span id="confrimPassword" class="help-block" style="color: rgba(255, 0, 0, 0.882)">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('frontend.layout.main')

@section('title', 'Update Profile')

@section('css')
    <link rel="stylesheet" href="{{ asset('templateFrontend/resources/css/update-profile.css') }}">
@endsection

@section('script')
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/interactive-update-profile.js') }}"></script>
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/update-profile-responsive.js') }}"></script>
@endsection

@section('content')<section class="update-profile">
        <div class="stand-out">
            <img src="{{ asset($student_profile->photo_profile) }}" alt="Photo Profile">
            <h2>{{ $student_profile->full_name }}</h2>
        </div>
        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div>
                <label for="firstname">Firstname</label>
                <input type="text" name="first_name" id="firstname"
                    value="{{ old('first_name', $student_profile->first_name) }}" required autocomplete="off">
                @error('first_name')
                    <label class="text text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div>
                <label for="lastname">Lastname</label>
                <input type="text" name="last_name" id="lastname"
                    value="{{ old('last_name', $student_profile->last_name) }}" required autocomplete="off">
                @error('last_name')
                    <label class="text text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}" required
                    autocomplete="off">
                @error('email')
                    <label class="text text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div>
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $student_profile->address) }}"
                    required autocomplete="off">
                @error('address')
                    <label class="text text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="gender-field">
                <div class="radio-group">
                    <input type="radio" name="gender" id="male" value="Male"
                        @if ($student_profile->gender == 'Male') checked @endif required>
                    <label for="male">Male</label>
                </div>
                <div class="radio-group">
                    <input type="radio" name="gender" id="female" value="Female"
                        @if ($student_profile->gender == 'Female') checked @endif required>
                    <label for="female">Female</label>
                </div>
                @error('gender')
                    <label class="text text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div>
                <label for="phone_number">Phone Number</label>
                <input type="tel" name="phone_number" id="phone_number"
                    value="{{ old('phone_number', $student_profile->phone_number) }}" autocomplete="off">
                @error('phone_number')
                    <label class="text text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="last-field-group">
                <div class="info-image">
                    <label for="photo_profile">Choose Image</label>
                    <p>No file currently selected for upload</p>
                </div>
                <input type="file" name="photo_profile" id="photo_profile" accept=".jpg, .jpeg, .png">
                @error('photo_profile')
                    <label class="text text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="btn-group">
                <button type="submit">Save</button>
            </div>
        </form>
    </section>
@endsection

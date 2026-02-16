@extends('frontend.layout.main')

@section('title', 'Profile')

@section('script')
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/profile-responsive.js') }}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('templateFrontend/resources/css/profile.css') }}">
@endsection

@section('content')

    <section class="my-profile">
        <div class="stand-out">
            <img src="{{ asset($student_profile->photo_profile) }}" alt="Photo Profile">
            <h2>{{ $student_profile->full_name }}</h2>
        </div>
        <div class="data-profile">
            <p>Firstname</p>
            <p>{{ $student_profile->first_name }}</p>
        </div>
        <div class="data-profile">
            <p>Lastname</p>
            <p>{{ $student_profile->last_name ?: '-' }}</p>
        </div>
        <div class="data-profile">
            <p>Email</p>
            <p>{{ $student->email }}</p>
        </div>
        <div class="data-profile">
            <p>Address</p>
            <p>{{ $student_profile->address ?: '-' }}</p>
        </div>
        <div class="data-profile">
            <p>Gender</p>
            <p>{{ $student_profile->gender ?: '-' }}</p>
        </div>
        <div class="data-profile">
            <p>Phone Number</p>
            <p>{{ $student_profile->phone_number ?: '-' }}</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('profile.edit') }}">Update</a>
            <form action="{{ route('profile.destroy') }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
    </section>
@endsection

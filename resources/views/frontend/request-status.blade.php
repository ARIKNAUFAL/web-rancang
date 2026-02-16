@extends('frontend.layout.main')
@section('title', 'Request Status')

@section('css')
    <link rel="stylesheet" href="{{ asset('templateFrontend/resources/css/request-status.css') }}">
@endsection

@section('script')
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/request-modal.js') }}"></script>
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/color-request-status.js') }}"></script>
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/request-status-responsive.js') }}"></script>
@endsection

@section('content')
    <section class="list-request">
        <div class="requestGroup">
            @foreach ($request as $item)
                <div class="request">
                    <div class="content">
                        <div class="title">
                            <p>{{ $item->topic }}</p>
                            <p class="request-status" id="request-status">{{ $item->status }}</p>
                        </div>
                        <p class="message">{{ $item->message }}</p>
                        <p>{{ \Carbon\Carbon::parse($item->date)->diffForHumans() }}</p>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </section>
    <section class="container-modals">
        <dialog class="modal-request" id="ml-modal-request">
            <div class="header">
                <h2>Request Tutorial</h2>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"
                    id="ml-close-request-modal">
                    <path
                        d="M1.37691 14.6301L0.299988 13.5626L6.22306 7.69174L0.299988 1.82083L1.37691 0.753387L7.29999 6.6243L13.2231 0.753387L14.3 1.82083L8.37691 7.69174L14.3 13.5626L13.2231 14.6301L7.29999 8.75917L1.37691 14.6301Z"
                        fill="#30314B" />
                </svg>
            </div>
            <form action="{{ route('lesson.request') }}" method="post">
                @csrf
                <div class="group-field">
                    <label for="topic">Lesson</label>
                    <input type="text" name="topic" id="topic" required>
                </div>
                <div class="group-field">
                    <label for="reason">Reason</label>
                    <textarea name="reason" id="reason" required></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
        </dialog>
    </section>
    <footer>
        <p>DigiLearn is a platform to guide whom want to learn something. The tutorials completely free you don’t
            worry about it. The main goal is guiding someone to pick up the path and guide their learning.</p>
        <button id="ml-open-request-modal"><span>Feel free to request a tutorial if you want it</span></button>
        <hr>
        <p>DigiLearn Copyright © 2023 All rights reserved.</p>
    </footer>
@endsection

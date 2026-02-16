@extends('frontend.layout.main')

@section('title', 'My Learning')

@section('css')
    <link rel="stylesheet" href="{{ asset('templateFrontend/resources/css/my-learning.css') }}">
@endsection

@section('script')
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/request-modal.js') }}"></script>
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/my-learning-responsive.js') }}"></script>
@endsection

@section('content')
    <section class="categories" id="get-started">
        <div class="cateogry-slider">
            <form action="#" method="#">
                <div class="swiper swiper_categories">
                    <div class="swiper-wrapper">
                        <a href="{{ route('mylearning') }}" class="swiper-slide btn">ALL</a>
                        @foreach ($categories as $category)
                            <a href="{{ route('mylearning') }}?category_id={{ $category->id }}"
                                class="swiper-slide btn">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        <div class="lesson">
            @forelse ($lessons as $lesson)
                <a href="{{ route('lesson.show', $lesson->lesson->id) }}">
                    <div class="card">
                        <img src="{{ asset($lesson->lesson->thumbnail) }}" alt="thumbnail">
                        <div class="content">
                            <h3>{{ $lesson->lesson->name }}</h3>
                            <div class="view">
                                <svg width="10" height="7" viewBox="0 0 10 7" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.86667 5.17764C5.3902 5.17764 5.83447 4.99587 6.19947 4.63233C6.56447 4.2688 6.74697 3.82631 6.74697 3.30487C6.74697 2.78344 6.56447 2.34095 6.19947 1.97742C5.83447 1.61388 5.3902 1.43211 4.86667 1.43211C4.34313 1.43211 3.89886 1.61388 3.53386 1.97742C3.16886 2.34095 2.98636 2.78344 2.98636 3.30487C2.98636 3.82631 3.16886 4.2688 3.53386 4.63233C3.89886 4.99587 4.34313 5.17764 4.86667 5.17764ZM4.86667 4.53869C4.5201 4.53869 4.22699 4.41935 3.98735 4.18067C3.7477 3.94198 3.62788 3.65005 3.62788 3.30487C3.62788 2.9597 3.7477 2.66777 3.98735 2.42908C4.22699 2.1904 4.5201 2.07105 4.86667 2.07105C5.21323 2.07105 5.50634 2.1904 5.74599 2.42908C5.98563 2.66777 6.10545 2.9597 6.10545 3.30487C6.10545 3.65005 5.98563 3.94198 5.74599 4.18067C5.50634 4.41935 5.21323 4.53869 4.86667 4.53869ZM4.86667 6.60975C3.7901 6.60975 2.81677 6.30496 1.94667 5.6954C1.07657 5.08583 0.427677 4.28899 0 3.30487C0.427677 2.32076 1.07657 1.52391 1.94667 0.914348C2.81677 0.304783 3.7901 0 4.86667 0C5.94323 0 6.91657 0.304783 7.78667 0.914348C8.65677 1.52391 9.30566 2.32076 9.73333 3.30487C9.30566 4.28899 8.65677 5.08583 7.78667 5.6954C6.91657 6.30496 5.94323 6.60975 4.86667 6.60975ZM4.86667 5.94877C5.75889 5.94877 6.57922 5.70825 7.32765 5.22721C8.07609 4.74617 8.64571 4.10539 9.03652 3.30487C8.64571 2.50436 8.07609 1.86358 7.32765 1.38254C6.57922 0.901496 5.75889 0.660975 4.86667 0.660975C3.97444 0.660975 3.15412 0.901496 2.40568 1.38254C1.65725 1.86358 1.08394 2.50436 0.685758 3.30487C1.08394 4.10539 1.65725 4.74617 2.40568 5.22721C3.15412 5.70825 3.97444 5.94877 4.86667 5.94877Z"
                                        fill="#30314B" />
                                </svg>
                                <p>100,000</p>
                            </div>
                            <p class="short-copy">FREE</p>
                        </div>
                    </div>
                </a>
                <hr>
            @empty
                <p>No lesson.</p>
            @endforelse
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
                    <label for="topic">Topic</label>
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
        <p>DigiLearn Copyright © 2022 All rights reserved.</p>
    </footer>
@endsection

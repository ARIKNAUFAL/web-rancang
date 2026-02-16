@extends('frontend.layout.main')

@section('css')
    <link rel="stylesheet" href="{{ asset('templateFrontend/resources/css/video-lesson.css') }}">
@endsection

@section('script')
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/interactive-btn-comment.js') }}"></script>
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/video-lesson-responsive.js') }}"></script>
@endsection

@section('content')
    <section class="video">
        <iframe src="{{ $lesson->embed_link }}" allowfullscreen></iframe>
        <h2>{{ $lesson->name }}</h2>
        <p class="view">100,000 views</p>
        <p class="desc">
            {{ $lesson->desc }}
        </p>
        @if ($enrolled)
            <div class="add-btn">
                <button type="button">
                    <span>Enrolled</span>
                </button>
            </div>
        @else
            <div class="add-btn">
                <form action="{{ route('lesson.add', $lesson->id) }}" method="post">
                    @csrf
                    <button type="submit">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.2575 16.5H11.9075V11.935H16.5V10.285H11.9075V5.5H10.2575V10.285H5.5V11.935H10.2575V16.5ZM11 22C9.49667 22 8.07583 21.7113 6.7375 21.1338C5.39917 20.5563 4.23042 19.7679 3.23125 18.7688C2.23208 17.7696 1.44375 16.6008 0.86625 15.2625C0.28875 13.9242 0 12.4942 0 10.9725C0 9.46917 0.28875 8.04833 0.86625 6.71C1.44375 5.37167 2.23208 4.2075 3.23125 3.2175C4.23042 2.2275 5.39917 1.44375 6.7375 0.86625C8.07583 0.28875 9.50583 0 11.0275 0C12.5308 0 13.9517 0.28875 15.29 0.86625C16.6283 1.44375 17.7925 2.2275 18.7825 3.2175C19.7725 4.2075 20.5563 5.37167 21.1338 6.71C21.7113 8.04833 22 9.47833 22 11C22 12.5033 21.7113 13.9242 21.1338 15.2625C20.5563 16.6008 19.7725 17.7696 18.7825 18.7688C17.7925 19.7679 16.6283 20.5563 15.29 21.1338C13.9517 21.7113 12.5217 22 11 22ZM11.0275 20.35C13.6125 20.35 15.8125 19.4379 17.6275 17.6138C19.4425 15.7896 20.35 13.5758 20.35 10.9725C20.35 8.3875 19.4425 6.1875 17.6275 4.3725C15.8125 2.5575 13.6033 1.65 11 1.65C8.415 1.65 6.21042 2.5575 4.38625 4.3725C2.56208 6.1875 1.65 8.39667 1.65 11C1.65 13.585 2.56208 15.7896 4.38625 17.6138C6.21042 19.4379 8.42417 20.35 11.0275 20.35Z"
                                fill="#30314B" />
                        </svg>
                        <span>Add Lesson</span>
                    </button>
                </form>
            </div>
        @endif
        <p>{{ $feedback->count() }} Comments</p>
        @if(\Session::get('student_log'))
        <div class="comment">
            <img src="{{ asset($student_profile->photo_profile) }}" alt="photo-profile">
            <form action="{{ route('lesson.feedback', $lesson->id) }}" method="post">
                <input type="text" name="comment" id="give-comment" placeholder="Add a comment..." required
                    autocomplete="off">
                <div class="btn-group">
                    <button type="button">Cancel</button>
                    <button type="submit" id="submit-comment">Comment</button>
                </div>
                @csrf
            </form>
        </div>
        @endif
        <div class="list-comment">
            @forelse ($feedback as $item)
                <div class="comment-group">
                    <img src="{{ asset(\App\Models\ProfileStudent::where('student_id', $item->student_id)->first()->photo_profile) }}"
                        alt="photo-profile">
                    <div class="data">
                        <p>{{ \App\Models\ProfileStudent::where('student_id', $item->student_id)->first()->full_name }}
                            <span>{{ \Carbon\Carbon::parse($item->date_comment)->diffForHumans() }}</span>
                        </p>
                        <p>{{ $item->comment }}</p>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </section>
    <section class="next-video">
        <h2>Next Video</h2>
        <div class="swiper swiper_next_video">
            <div class="row swiper-wrapper">
                @foreach ($lessons as $lesson)
                    <a href="{{ route('lesson.show', $lesson->id) }}" class="swiper-slide">
                        <div class="card">
                            <img src="{{ asset($lesson->thumbnail) }}" alt="Thumbnail">
                            <div class="content">
                                <h3>{{ $lesson->name }}</h3>
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
                @endforeach
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
@endsection

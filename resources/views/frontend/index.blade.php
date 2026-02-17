<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn To Code - For Free</title>
    <!--** Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Permanent+Marker&display=swap"
        rel="stylesheet">
    <!--** Reset default CSS style -->
    <link rel="stylesheet" href="{{ asset('templateFrontend/vendors/normalize.css') }}">
    <!--** Preset Grid layout -->
    <link rel="stylesheet" href="{{ asset('templateFrontend/vendors/grid.css') }}">
    <!--** CSS properties -->
    <link rel="stylesheet" href="{{ asset('templateFrontend/resources/css/variables.css') }}">
    <!--** Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!--** External CSS -->
    <link rel="stylesheet" href="{{ asset('templateFrontend/resources/css/style.css') }}">
</head>

<body>
    <header>
        <button id="menu">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.21153 19.3844C0.542418 19.3844 0 18.842 0 18.1729C0 17.5038 0.542419 16.9614 1.21153 16.9614H18.7885C19.4576 16.9614 20 17.5038 20 18.1729C20 18.842 19.4576 19.3844 18.7885 19.3844H1.21153ZM1.21153 10.9037C0.542418 10.9037 0 10.3613 0 9.69222C0 9.02311 0.542419 8.48069 1.21153 8.48069H18.7885C19.4576 8.48069 20 9.02311 20 9.69222C20 10.3613 19.4576 10.9037 18.7885 10.9037H1.21153ZM1.21153 2.42306C0.542418 2.42306 0 1.88064 0 1.21153C0 0.542419 0.542419 0 1.21153 0H18.7885C19.4576 0 20 0.542419 20 1.21153C20 1.88064 19.4576 2.42306 18.7885 2.42306H1.21153Z"
                    fill="#30314B" />
            </svg>
        </button>
        <div>
            <button id="open-modal-login">Login</button>
        </div>
    </header>
    <section class="burger-menu">
        <dialog class="modal-burger-menu" id="modal-burger-menu">
            <div class="header">
                <h2>DigiLearn</h2>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"
                    id="close-modal-burger-menu">
                    <path
                        d="M1.37691 14.6301L0.299988 13.5626L6.22306 7.69174L0.299988 1.82083L1.37691 0.753387L7.29999 6.6243L13.2231 0.753387L14.3 1.82083L8.37691 7.69174L14.3 13.5626L13.2231 14.6301L7.29999 8.75917L1.37691 14.6301Z"
                        fill="#30314B" />
                </svg>
            </div>
            <hr>
            <div class="menu-group">
                <nav>
                    <p><a href="my-learning.html">My Learning</a></p>
                    <hr>
                    <p><a href="request-status.html">Request Status</a></p>
                    <hr>
                    <p><a href="notifications.html">Notification</a></p>
                    <hr>
                    <p><a href="profile.html">My Profile</a></p>
                    <hr>
                </nav>
                <form action="{{ route('student.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="logout"><span><svg width="9" height="9" viewBox="0 0 9 9"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.75 9C0.55 9 0.375 8.925 0.225 8.775C0.075 8.625 0 8.45 0 8.25V0.75C0 0.55 0.075 0.375 0.225 0.225C0.375 0.075 0.55 0 0.75 0H4.3875V0.75H0.75V8.25H4.3875V9H0.75ZM6.825 6.6875L6.2875 6.15L7.5625 4.875H3.1875V4.125H7.5375L6.2625 2.85L6.8 2.3125L9 4.5125L6.825 6.6875Z"
                                    fill="#30314B" />
                            </svg></span>Logout</button>
                    <hr>
                </form>
            </div>
        </dialog>
    </section>
    <section class="container-modals">
        <dialog class="modal-login" id="modal-login">
            <div class="container-form">
                <div class="header">
                    <h2>Login</h2>
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg" id="close-modal-login">
                        <path
                            d="M1.37691 14.6301L0.299988 13.5626L6.22306 7.69174L0.299988 1.82083L1.37691 0.753387L7.29999 6.6243L13.2231 0.753387L14.3 1.82083L8.37691 7.69174L14.3 13.5626L13.2231 14.6301L7.29999 8.75917L1.37691 14.6301Z"
                            fill="#30314B" />
                    </svg>
                </div>
                <form action="/prosesLoginStudent" method="post">
                    @csrf
                    <div class="group-field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="group-field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <button type="submit">Login</button>
                </form>
                <p>New DigiLearn? <span id="open-modal-register">Create Account</span></p>
            </div>
        </dialog>
    </section>
    <section class="container-modals">
        <dialog class="modal-register" id="modal-register">
            <div class="container-form">
                <div class="header">
                    <h2>Register</h2>
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg" id="close-modal-register">
                        <path
                            d="M1.37691 14.6301L0.299988 13.5626L6.22306 7.69174L0.299988 1.82083L1.37691 0.753387L7.29999 6.6243L13.2231 0.753387L14.3 1.82083L8.37691 7.69174L14.3 13.5626L13.2231 14.6301L7.29999 8.75917L1.37691 14.6301Z"
                            fill="#30314B" />
                    </svg>
                </div>
                <form action="/prosesRegister" method="post">
                    @csrf
                    <div class="group-field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="group-field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="group-field">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <button type="submit">Register</button>
                </form>
                <p>Already have an account? <span id="back-to-modal-login">Login</span></p>
            </div>
        </dialog>
    </section>
    <section class="menu-drop-down" id="menu-drop-down">
        <div>
            <a href="/profile">Profile</a>
            <hr>
            <a href="/request-status">Request Status</a>
            <hr>
        </div>
        <form action="{{ route('student.logout') }}" method="post">
            @csrf
            <button type="submit"><span><svg width="9" height="9" viewBox="0 0 9 9" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.75 9C0.55 9 0.375 8.925 0.225 8.775C0.075 8.625 0 8.45 0 8.25V0.75C0 0.55 0.075 0.375 0.225 0.225C0.375 0.075 0.55 0 0.75 0H4.3875V0.75H0.75V8.25H4.3875V9H0.75ZM6.825 6.6875L6.2875 6.15L7.5625 4.875H3.1875V4.125H7.5375L6.2625 2.85L6.8 2.3125L9 4.5125L6.825 6.6875Z"
                            fill="#F2E9E0" />
                    </svg></span>Logout</button>
        </form>
    </section>
    <section class="hero-text-box">
        <img src="{{ asset('templateFrontend/resources/css/images/Hero_Image.gif') }}" alt="Hero Image">
        <h1>Programming is super easy</h1>
        <p>This DigiLearn guide offers a series of simple, bite-sized explainers to help anyone understand what
            programming is, how it works and how it’s changing the world around us.</p>
        <a href="#get-started">
            <svg width="12" height="8" viewBox="0 0 12 8" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M10.59.59L6 5.17 1.41.59 0 2l6 6 6-6z" fill="#30314B" />
            </svg>
        </a>

    </section>
    <section class="recommended">
        <h2>Recommended for you</h2>
        <div class="swiper swiper_recommended">
            <div class="row swiper-wrapper">
                @foreach ($recommendation as $item)
                    <a href="{{ route('lesson.show', $item->id) }}" class="swiper-slide">
                        <div class="card">
                            <img src="{{ asset($item->thumbnail) }}" alt="Thumbnail" loading="lazy" decoding="async">
                            <div class="content">
                                <h3>{{ $item->name }}</h3>
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
    <section class="categories" id="get-started">
        <h2>Where do I get started?</h2>
        <p>Browse the lesson or choose one of the categories below.</p>
        <div class="cateogry-slider">
            <form action="#" method="#">
                <div class="swiper swiper_categories">
                    <div class="swiper-wrapper">
                        @foreach ($categories as $cat)
                            <a href="{{ route('category.show', $cat->id) }}"
                                class="swiper-slide btn">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        <div class="lesson">
            @forelse ($lessons as $lesson)
                <a href="{{ route('lesson.show', $lesson->id) }}">
                    <div class="card">
                        <img src="{{ asset($lesson->thumbnail) }}" alt="thumbnail" loading="lazy" decoding="async">
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
                <hr>
            @empty
                <p style="width: 100%">No {{ $category->name }} lesson found.</p>
            @endforelse
        </div>
    </section>
    <section class="container-modals">
        <dialog class="modal-request" id="ml-modal-request">
            <div class="header">
                <h2>Request Tutorial</h2>
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg" id="ml-close-request-modal">
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
        <p class="copyright">DigiLearn Copyright © 2022 All rights reserved.</p>
    </footer>
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script defer src="{{ asset('templateFrontend/vendors/JavaScript/swiper.js') }}"></script>
    <script src="{{ asset('templateFrontend/resources/JavaScript/app.js') }}"></script>
    <script defer src="{{ asset('templateFrontend/resources/JavaScript/request-modal.js') }}"></script>
    @if (session()->get('student_log'))
    <script>
    const maxWidth767 = window.matchMedia('(max-width:767px)');

    const fullname = document.createElement('p');
    @if ($student_profile)
        fullname.append("{{ $student_profile->full_name }}"); // Data dinamis
    @else
        fullname.append("Guest"); // Fallback jika tidak ada data
    @endif
    fullname.classList.add('fullname');

    const photoProfile = document.createElement('img');
    @if ($student_profile && $student_profile->photo_profile)
        photoProfile.setAttribute('src', "{{ str_replace('\\', '/', asset($student_profile->photo_profile)) }}");
    @else
        photoProfile.setAttribute('src', 'default-photo.jpg'); // Gambar default jika tidak ada foto
    @endif
    photoProfile.classList.add('photo-profile');

    const xmlns = "http://www.w3.org/2000/svg";
    const boxWidth = 24;
    const boxHeight = 15;

    const expandMore = document.createElementNS(xmlns, "svg");
    expandMore.setAttributeNS(null, "viewBox", "0 0 " + boxWidth + " " + boxHeight);
    expandMore.setAttributeNS(null, "width", boxWidth);
    expandMore.setAttributeNS(null, "height", boxHeight);

    const expandMorePath = document.createElementNS(xmlns, "path");
    expandMorePath.setAttributeNS(null, 'd', 'M12 14.15L0 2.15L2.15 0L12 9.9L21.85 0.0499992L24 2.2L12 14.15Z');
    expandMorePath.setAttributeNS(null, 'fill', "#30314B");

    expandMore.appendChild(expandMorePath);
    expandMore.setAttribute('class', 'expand-more');
    expandMore.setAttribute('id', 'expand-more');

    function removeLoginBtn(width) {
        if (width.matches) {
            loginBtn.style.display = 'none';
            navGroup.classList.add('login-state');
            navGroup.appendChild(photoProfile);
            navGroup.appendChild(fullname);
        } else {
            loginBtn.style.display = 'none';
            document.querySelector('header>div>svg').style.display = 'none';
            navGroup.appendChild(photoProfile);
            navGroup.appendChild(fullname);
            navGroup.appendChild(expandMore);
        }
    }

    removeLoginBtn(maxWidth767); // Call listener function at run time
    maxWidth767.addListener(removeLoginBtn); // Attach listener function on state changes

    const expandMoreIcon = document.querySelector('#expand-more');
    const menuDropDown = document.querySelector('#menu-drop-down');

    expandMoreIcon.addEventListener('click', () => {
        menuDropDown.style.display = 'block';
        setTimeout(() => {
            menuDropDown.style.display = 'none';
        }, 5000);
    });
</script>

    @endif

    @if (session('need_login'))
        <script>
            modalLogin.showModal();
        </script>
    @endif
</body>

</html>

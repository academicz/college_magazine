<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ==== Document Title ==== -->
    <title>@yield('title')</title>

    <!-- ==== Document Meta ==== -->
    <meta name="description" content="BloggyPress - Responsive Personal Blog HTML5 Template">
    <meta name="keywords"
          content="blog, blogging, personal, clean, modern, masonry, simple, html5, css3, template, responsive">
    <meta name="author" content="ThemeLooks">

    <!-- ==== Favicon ==== -->
    <link rel="icon" href="favicon.png" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700%7CPlayfair+Display:400,700">

    <!-- ==== Font Awesome ==== -->
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css')}}">

    <!-- ==== Bootstrap Framework ==== -->
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css')}}">

    <!-- ==== Owl Carousel Plugin ==== -->
    <link rel="stylesheet" href="{{ asset('public/css/owl.carousel.min.css')}}">

    <!-- ==== Magnific Popup Plugin ==== -->
    <link rel="stylesheet" href="{{ asset('public/css/magnific-popup.min.css') }}">

    <!-- ==== Main Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('public/style.css')}}">

    <!-- ==== Responsive Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('public/css/responsive-style.css')}}">

    <!-- ==== Color Scheme Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('public/css/colors/color-1.css')}}" id="changeColorScheme">

    <!-- ==== Custom Stylesheet ==== -->
    <link rel="stylesheet" href="{{ asset('public/css/custom.css')}}">

    <!-- ==== HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries ==== -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Preloader Start -->
<div id="preloader" class="bg-primary">
    <div class="preloader--inner"></div>
</div>
<!-- Preloader End -->

<!-- Wrapper Start -->
<div class="wrapper">

    @include('Public.Includes.header')

    @yield('contents')

    @include('Public.Includes.footer')

</div>
<!-- Wrapper End -->

<!-- ==== jQuery Library ==== -->
<script src="{{ asset('public/js/jquery-3.2.1.min.js') }}"></script>

<!-- ==== Bootstrap Framework ==== -->
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>

<!-- ==== Owl Carousel Plugin ==== -->
<script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>

<!-- ==== Magnific Popup Plugin ==== -->
<script src="{{ asset('public/js/jquery.magnific-popup.min.js') }}"></script>

<!-- ==== Validation Plugin ==== -->
<script src="{{ asset('public/js/jquery.validate.min.js') }}"></script>

<!-- ==== Match Height Plugin ==== -->
<script src="{{ asset('public/js/jquery.matchHeight-min.js') }}"></script>

<!-- ==== Isotope Plugin ==== -->
<script src="{{ asset('public/js/isotope.min.js')}}"></script>

<!-- ==== Footer Reveal Plugin ==== -->
<script src="{{ asset('public/js/footer-reveal.min.js') }}"></script>

<!-- ==== Retina Plugin ==== -->
<script src="{{ asset('public/js/retina.min.js') }}"></script>

<!-- ==== Main Script ==== -->
<script src="{{ asset('public/js/main.js')}}"></script>

<script src="{{ asset('public/js/app.js')}}"></script>

<!-- ==== Color Switcher Script ==== -->
<script src="{{ asset('public/js/color-switcher.min.js')}}"></script>

@yield('scripts')

</body>

</html>

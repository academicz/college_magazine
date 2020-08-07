@extends('Public.Layouts.Master')

@section('title')
    Home
@endsection

@section('contents')
    @include('Public.Includes.banner')

    <!-- Featured Section Start -->
    <section class="section pt--60 pb--30">
        <div class="container">
            <!-- Featured Posts Start -->
            <div class="featured--posts owl-carousel" data-owl-autoplay="false" data-owl-margin="30" data-owl-nav="true"
                 data-owl-loop="false"
                 data-owl-responsive='{"0": {"items": "1"}, "481": {"items": "2"}, "992": {"items": "3"}}'>
                <!-- Category Item Start -->
                <div class="category--item">
                    <a href="category.html" data-overlay="0.7" data-overlay-color="primary">
                        <img src="img/category-img/01.jpg" alt="">
                        <span>Technology</span>
                    </a>
                </div>
                <!-- Category Item End -->

                <!-- Category Item Start -->
                <div class="category--item">
                    <a href="category.html" data-overlay="0.7" data-overlay-color="primary">
                        <img src="img/category-img/02.jpg" alt="">
                        <span>Travel</span>
                    </a>
                </div>
                <!-- Category Item End -->

                <!-- Category Item Start -->
                <div class="category--item">
                    <a href="category.html" data-overlay="0.7" data-overlay-color="primary">
                        <img src="img/category-img/03.jpg" alt="">
                        <span>Lifestyle</span>
                    </a>
                </div>
                <!-- Category Item End -->

                <!-- Category Item Start -->
                <div class="category--item">
                    <a href="category.html" data-overlay="0.7" data-overlay-color="primary">
                        <img src="img/category-img/04.jpg" alt="">
                        <span>Music</span>
                    </a>
                </div>
                <!-- Category Item End -->
            </div>
            <!-- Featured Posts End -->
        </div>
    </section>
    <!-- Featured Section End -->

    @include('Public.Includes.blog_section')
@endsection

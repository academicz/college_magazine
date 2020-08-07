<!-- Header Section Start -->
<header class="header--section">
    <!-- Header Topbar Start -->
    <div class="header--topbar text-center text-white bg-dark fs--14">
        <div class="container">
            <!-- Header Date Start -->
            <div class="header--date">
                <p>{{ date('l') }} <span class="text-primary">{{ date('d F') }}</span> {{ date('Y') }}</p>
            </div>
            <!-- Header Date End -->


            <!-- Header Social Start -->
            @if(user())
                <div class="header--social">
                    <span><a href="{{ route('profile',['id'=>user()->id,'name'=>user()->name]) }}">{{user()->name }}</a></span>

                    <ul class="nav">
                        <li><a href="{{ route('logout') }}">
                                <small>Logout</small>
                            </a></li>
                    </ul>
                </div>
            @else
                <div class="header--social">
                    <ul class="nav">
                        <li><a href="{{ route('login') }}">Login</a></li>
                    </ul>
                </div>
        @endif
        <!-- Header Social End -->
        </div>
    </div>
    <!-- Header Topbar End -->

    <!-- Header Navbar Start -->
    <nav class="header--navbar navbar">
        <div class="container">
            <!-- Header Logo Start -->
            <div class="header--logo">
                <a href="index.html">
                    <img src="{{ asset('public/img/logo.jpg')}}" alt="">
                </a>
            </div>
            <!-- Header Logo End -->

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#headerNav">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div id="headerNav" class="navbar-collapse collapse text-center">
                <!-- Header nav Links Start -->
                <ul class="header--nav-links nav">
                    <li>
                        <a href="{{ route('home') }}">Home</a>

                    </li>
                    @if(user())
                        <li><a href="{{ route('addArticle') }}">New Article</a></li>
                        <li><a href="{{ route('profile',['id'=>user()->id]) }}">Profile</a></li>
                    @endif

                </ul>
                <!-- Header nav Links End -->
            </div>
        </div>
    </nav>
    <!-- Header Navbar End -->
</header>
<!-- Header Section End -->
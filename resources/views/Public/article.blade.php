@extends('Public.Layouts.Master')

@section('title')
    {{ $article->title }}
@endsection

@section('contents')

    <!-- Blog Section Start -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 pb--60">
                    <!-- Post Item Start -->
                    <div class="post--item post--single text-center">
                        <!-- Post Slider Start -->
                        <div class="post--img">
                            <a href="#"><img src="{{ asset($article->cover_image) }}" alt=""></a>
                        </div>
                        <!-- Post Slider End -->

                        <!-- Post Meta Start -->
                        <div class="post--meta clearfix">
                            <p class="float--left">
                                <i class="fa fa-clock-o text-primary"></i>
                                <span>{{ dateFromTimeStamp($article->created_at) }}</span>
                                <a href="author.html">{{ $article->user->name }}</a>
                            </p>
                            @if(user())
                                @if($article->user_like)
                                    <p class="float--left like-icon"><a
                                                href="{{ route('likeArticle',['article'=>$article->id,'status'=>0]) }}"><i
                                                    class="fa fa-thumbs-o-up fa-3x liked"></i></a></p>
                                @else
                                    <p class="float--left like-icon"><a
                                                href="{{ route('likeArticle',['article'=>$article->id,'status'=>1]) }}"><i
                                                    class="fa fa-thumbs-o-up fa-3x"></i></a></p>
                                @endif
                            @else
                                <p class="float--left like-icon"><a
                                            href="{{ route('likeArticle',['article'=>$article->id]) }}"><i
                                                class="fa fa-thumbs-o-up fa-3x"></i></a></p>
                            @endif

                            <p class="float--right">
                                <i class="fa fa-thumbs-o-up text-primary"></i>
                                <span>{{ $article->like->count() }}</span>
                            </p>

                            <p class="float--right">
                                <a href="#comments" class="btn-link">
                                    <i class="fa fa-comments-o text-primary"></i>
                                    <span>{{ $article->article_comment->count() }}</span>
                                </a>
                            </p>
                        </div>
                        <!-- Post Meta End -->

                        <!-- Post Title Start -->
                        <div class="post--title">
                            <h2 class="h2">{{ $article->title }}</h2>
                        </div>
                        <!-- Post Title End -->

                        <!-- Post Content Start -->
                        <div class="post--content clearfix">
                            <p>{!! $article->story !!} </p>
                        </div>
                        <!-- Post Content End -->

                        <!-- Post Footer Start -->
                        <div class="post--footer clearfix pt--40">
                            <!-- Post Categories Start -->
                            <ul class="post--cats nav text-primary">
                                <li><strong>Category:</strong></li>
                                <li><a href="#">{{ $article->article_category->category_name }}</a></li>
                            </ul>
                            <!-- Post Categories End -->

                            <!-- Post Tags Start -->
                            <ul class="post--tags nav float--left">
                                <li><strong>Tags:</strong></li>
                                <li><a href="#">{{ $article->article_category->category_name }}</a></li>
                            </ul>
                            <!-- Post Tags End -->

                        </div>
                        <!-- Post Footer End -->
                    </div>
                    <!-- Post Item End -->

                    <!-- Post Author Start -->
                    <div class="post--author clearfix pt--50">
                        <div class="img float--left">
                            <img src="{{ asset($article->user->image) }}" alt="" class="img-circle">
                        </div>

                        <div class="info ov--h">
                            <div class="header clearfix">
                                <h2 class="name h6"><a
                                            href="{{ route('profile',['id'=>$article->user->id,'name'=>$article->user->name]) }}"
                                            class="btn-link">{{ $article->user->name }}</a></h2>

                                <div class="social float--right">
                                    <ul class="nav">
                                        <li><a href="{{ $article->user->facebook }}"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li><a href="{{ $article->user->twitter }}"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li><a href="{{ $article->user->google_plus }}"><i
                                                        class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="bio">
                                <p>{{ $article->user->about }}</p>
                            </div>

                            <div class="action">
                                <a href="{{ route('profile',['id'=>$article->user->id,'name'=>$article->user->name]) }}">View
                                    all posts
                                    by Dylan Reyes</a>
                            </div>
                        </div>
                    </div>
                    <!-- Post Author End -->

                    <!-- Post Comments Start -->
                    <div id="comments" class="post--comments pt--40">
                        <div class="post--comments-title text-uppercase text-center">
                            <h2 class="h5">{{ $article->article_comment->count() }} Comments</h2>
                        </div>

                        <!-- Comment Items Start -->
                        <ul class="comment--items">
                            @foreach($article->article_comment as $comment)
                                <li>
                                    <!-- Comment Item Start -->
                                    <div class="comment--item clearfix">
                                        <div class="comment--img float--left">
                                            <img src="{{ asset($comment->user->image) }}" alt="" class="img-circle">
                                        </div>

                                        <div class="comment--info ov--h">
                                            <div class="comment--header clearfix">

                                                <h3 class="name h5">{{ $comment->user->name }}</h3>

                                                <p class="date">{{ date('F d Y \a\t h:i a',strtotime($comment->created_at)) }}</p>
                                            </div>

                                            <div class="comment--content">
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Comment Item End -->
                                </li>
                            @endforeach
                        </ul>
                        <!-- Comment Items End -->
                    </div>
                    <!-- Post Comments End -->

                    <!-- Post Comment Form Start -->
                    <div class="post--comment-form pt--40">
                        <!-- Comment Respond Start -->
                        <div class="comment--respond">
                            <div class="comment--respond-title text-uppercase text-center">
                                <h2 class="h5">Leave Comments</h2>
                            </div>

                            @if(user())
                                <form action="{{ route('postComment') }}" method="post" data-form="validate">
                                    <div class="form-group">
                                    <textarea name="comment" placeholder="Your Comment" class="form-control"
                                              required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-default">Post Comment</button>
                                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <h2>Login to comment</h2>
                            @endif
                        </div>
                        <!-- Comment Respond End -->
                    </div>
                    <!-- Post Comment Form End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection

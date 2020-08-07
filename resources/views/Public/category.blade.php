@extends('Public.Layouts.Master')

@section('title')
    {{ $category->category_name }}
@endsection

@section('contents')

    <!-- Blog Section Start -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page--title pb--50">
                        <h2 class="h3">Category: <span class="text-primary">{{ $category->category_name }}</span></h2>
                    </div>
                    <div class="row" data-trigger="masonry">

                        @foreach($articles as $article)
                            <div class="col-sm-4 col-xs-12 pb--60">
                                <!-- Post Item Start -->
                                <div class="post--item text-center">
                                    <!-- Post Image Start -->
                                    <div class="post--img">
                                        <a href="{{ route('getArticle',['id'=>$article->id,'title'=>str_replace(" ","-",$article->title)]) }}"><img
                                                    src="{{ asset($article->cover_image) }}"
                                                    alt=""></a>
                                    </div>
                                    <!-- Post Image End -->

                                    <!-- Post Category Start -->
                                    <div class="post--cat">
                                        <a href="#" data-overlay="0.5"
                                           data-overlay-color="primary">{{ $article->article_category->category_name }}</a>
                                    </div>
                                    <!-- Post Category End -->

                                    <!-- Post Title Start -->
                                    <div class="post--title">
                                        <h2 class="h3" style="display:inline-block;
                                            width:300px;
                                            white-space: nowrap;
                                            overflow:hidden !important;
                                            text-overflow: ellipsis;"><a
                                                    href="{{ route('getArticle',['id'=>$article->id,'title'=>str_replace(" ","-",$article->title)]) }}"
                                                    class="btn-link"
                                                    title="{{ $article->title }}">{{ $article->title }}</a></h2>
                                    </div>
                                    <!-- Post Title End -->

                                    <!-- Post Excerpt Start -->
                                    <div class="post--excerpt">
                                        <p>{!! $article->story !!} </p>
                                    </div>
                                    <!-- Post Excerpt End -->

                                    <!-- Post Action Start -->
                                    <div class="post--action">
                                        <a href="{{ route('getArticle',['id'=>$article->id,'title'=>str_replace(" ","-",$article->title)]) }}"
                                           class="btn btn-default">Read More</a>
                                    </div>
                                    <!-- Post Action End -->

                                    <!-- Post Meta Start -->
                                    <div class="post--meta clearfix">
                                        <p class="float--left">
                                            <i class="fa fa-clock-o text-primary"></i>
                                            <span>{{ dateFromTimeStamp($article->created_at) }}</span>
                                            <a href="{{ route('profile',['id'=>$article->user->id,'name'=>str_replace(" ","_",$article->user->name)]) }}">{{ $article->user->name }}</a>
                                        </p>

                                        <p class="float--right">
                                            <i class="fa fa-thumbs-o-up text-primary"></i>
                                            <span>{{ $article->like->count() }}</span>
                                        </p>

                                        <p class="float--right">
                                            <a href="blog-details.html#comments" class="btn-link">
                                                <i class="fa fa-comments-o text-primary"></i>
                                                <span>{{ $article->article_comment->count() }}</span>
                                            </a>
                                        </p>
                                    </div>
                                    <!-- Post Meta End -->
                                </div>
                                <!-- Post Item End -->
                            </div>
                        @endforeach
                    </div>

                    <!-- Pager Start -->
                    <div class="pager--wrapper pb--50">
                        <ul class="pager nav ff--primary">
                            {{ $articles->links() }}
                        </ul>
                    </div>
                    <!-- Pager End -->
                </div>

            </div>
        </div>
    </section>
    <!-- Blog Section End -->

@endsection

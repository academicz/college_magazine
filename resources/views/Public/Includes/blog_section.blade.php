<!-- Blog Section Start -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 pb--60">
            @if($articles->count())
                @foreach($articles as $article)
                    <!-- Post Item Start -->
                        <div class="post--item hover-item text-center">
                            <!-- Post Image Start -->
                            <div class="post--img">
                                <a href="{{ route('getArticle',['id'=>$article->id,'title'=>str_replace(" ","-",$article->title)]) }}"><img
                                            src="{{ asset($article->cover_image) }}" alt=""></a>
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
                                <h2 class="h3"><a
                                            href="{{ route('getArticle',['id'=>$article->id,'title'=>str_replace(" ","-",$article->title)]) }}"
                                            class="btn-link">{{ $article->title }}</a>
                                </h2>
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
                @endforeach


                <!-- Pager Start -->
                    <div class="pager--wrapper pt--50">
                        <ul class="pager nav ff--primary">
                            {{ $articles->links() }}
                        </ul>
                    </div>
                    <!-- Pager End -->
                @endif
            </div>

            <div class="col-md-4 pb--60">


                <!-- Widget Start -->
                <div class="widget">
                    <h2 class="h4 widget--title">Popular Posts</h2>

                    <!-- Posts Widget Start -->
                    <div class="posts--widget pb--10">
                        <ul class="nav">
                            @foreach($popularArticles as $popularArticle)
                                <li class="clearfix">
                                    <div class="img">
                                        <a href="{{ route('getArticle',['id'=>$popularArticle->id,'title'=>str_replace(" ","-",$popularArticle->title)]) }}"><img src="{{ $popularArticle->cover_image }}"
                                                                         alt=""></a>
                                    </div>

                                    <div class="info">
                                        <a href="#" class="cat" data-overlay="0.5"
                                           data-overlay-color="primary">{{ $popularArticle->article_category->category_name }}</a>

                                        <h3 class="h5" style="display:inline-block;
                                            width:400px;

                                            overflow:hidden !important;
                                            text-overflow: ellipsis;"><a href="{{ route('getArticle',['id'=>$popularArticle->id,'title'=>str_replace(" ","-",$popularArticle->title)]) }}" class="btn-link">{{ $popularArticle->title }}</a></h3>

                                        <p class="date"><i class="fa fa-clock-o text-primary"></i>
                                            <a href="#" class="btn-link">{{ dateFromTimeStamp($popularArticle->created_at) }}</a></p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Posts Widget End -->
                </div>
                <!-- Widget End -->

                <!-- Widget Start -->
                <div class="widget">
                    <h2 class="h4 widget--title">Categories</h2>

                    <!-- Links Widget Start -->
                    <div class="links--widget pb--10">
                        <ul class="nav">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('getCategory',['id'=>$category->id,'name'=>$category->category_name]) }}">
                                        <span class="text">{{ $category->category_name }}</span>
                                        <span class="count">{{ $category->articles->count() }}</span>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <!-- Links Widget End -->
                </div>
                <!-- Widget End -->

            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->
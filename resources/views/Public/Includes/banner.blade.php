<!-- Banner Section Start -->
<section class="banner--section">
    <!-- Banner Slider Start -->
    <div class="banner--slider owl-carousel" data-owl-dots="true" data-owl-center="true"
         data-owl-responsive='{"0": {"autoWidth": false}, "768": {"autoWidth": true}}'>

        @foreach($bannerArticles as $article)
            <div class="container">
                <!-- Banner Item Start -->
                <div class="banner--item style--1" data-bg-img="{{ $article->cover_image }}" data-overlay="0.5">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <!-- Banner Content Start -->
                            <div class="banner--content pt--180 pb--180 text-white text-center">
                                <div class="tag" data-overlay="0.5" data-overlay-color="primary">
                                    <p><a href="category.html"
                                          class="btn-link">{{ $article->article_category->category_name }}</a></p>
                                </div>

                                <div class="title">
                                    <h2 class="h2 text-white" style="display:inline-block;
                                            width:700px;
                                            white-space: nowrap;
                                            overflow:hidden !important;
                                            text-overflow: ellipsis;">
                                        <a href="{{ route('getArticle',['id'=>$article->id,'title'=>str_replace(" ","-",$article->title)]) }}"
                                           class="btn-link">{{ $article->title }}</a></h2>
                                </div>
                                <div class="desc post--excerpt" style="color: #fff;">
                                    <p>{!! $article->story !!} </p>
                                </div>

                                <div class="action">
                                    <a href="{{ route('getArticle',['id'=>$article->id,'title'=>str_replace(" ","-",$article->title)]) }}"
                                       class="btn btn-white">Read More</a>
                                </div>
                            </div>
                            <!-- Banner Content End -->
                        </div>
                    </div>
                </div>
                <!-- Banner Item End -->
            </div>
        @endforeach

    </div>
    <!-- Banner Slider End -->
</section>
<!-- Banner Section End -->
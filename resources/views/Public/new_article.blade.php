@extends('Public.Layouts.Master')

@section('title')
    Home
@endsection

@section('contents')

    <!-- Blog Section Start -->
    <section class="section section-pad">
        <div class="container">
            <div class="row">

                <form action="{{ route('postArticle') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-sm-8 col-sm-offset-2">
                        @include('Public.Includes.msgBox')
                        <div class="form-group">
                            <label for="category" class="control-label">Category</label>
                            <select name="category" id="category" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title" class="control-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="coverImage" class="control-label">Cover Picture</label>
                            <input type="file" name="coverImage" id="coverImage" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="summernote" class="control-label">Story</label>
                            <textarea name="story" id="summernote"  class="form-control"></textarea>

                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Add</button>
                        </div>
                    </div>
                    <div class="row col-md-12">

                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>
    <link href="{{ asset('plugins/summernote/summernote.min.css') }}" rel="stylesheet">
    <script>
        $(document).ready(function () {

            // SUMMERNOTE
            // =================================================================
            // Require Summernote
            // http://hackerwins.github.io/summernote/
            // =================================================================
            $('#summernote, #demo-summernote-full-width').summernote({
                height: '230px'
            });

        });
    </script>
@endsection

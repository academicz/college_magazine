@extends('Public.Layouts.Master')

@section('title')
    Home
@endsection

@section('contents')
    <!-- Blog Section Start -->
    <section class="section section-pad">
        <div class="container">
            <div class="row">

                <form action="{{ route('postLogin') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-sm-6 col-sm-offset-3">
                        @include('Public.Includes.msgBox')
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

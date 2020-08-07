@extends('Public.Layouts.Master')

@section('title')
    {{ $user->name }}
@endsection

@section('contents')

    <!-- Blog Section Start -->
    <section class="section" style="margin-bottom: 150px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form action="{{ route('postEditProfile') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name',$user->name) }}">
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email"
                                   value="{{ old('email',$user->email) }}">
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="text" name="phone"
                                   value="{{ old('phone',$user->phone) }}">
                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control" type="file" name="image"
                                   value="{{ old('image',$user->image) }}">
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                        </div>
                        <div class="form-group">
                            <label>Google Plus</label>
                            <input class="form-control" type="text" name="plus"
                                   value="{{ old('plus',$user->google_plus) }}">
                            <small class="text-danger">{{ $errors->first('plus') }}</small>
                        </div>
                        <div class="form-group">
                            <label>About</label>
                            <textarea class="form-control" name="about">{{ old('about',$user->about) }}</textarea>
                            <small class="text-danger">{{ $errors->first('plus') }}</small>
                        </div>
                        <div class="form-group">
                            <label>Facebook</label>
                            <input class="form-control" type="text" name="facebook"
                                   value="{{ old('facebook',$user->facebook) }}">
                            <small class="text-danger">{{ $errors->first('facebook') }}</small>
                        </div>
                        <div class="form-group">
                            <label>Twitter</label>
                            <input class="form-control" type="text" name="twitter"
                                   value="{{ old('twitter',$user->twitter) }}">
                            <small class="text-danger">{{ $errors->first('twitter') }}</small>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </form>
            </div>
        </div>
        </div>
    </section>
    <!-- Blog Section End -->

@endsection

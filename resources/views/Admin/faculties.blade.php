@extends('Admin.Layouts.Master')
@section('title')
    Admin | Students
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Faculties</h1>

        <!--Searchbox-->
        <div class="searchbox">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search..">
                <span class="input-group-btn">
                    <button class="text-muted" type="button"><i class="demo-pli-magnifi-glass"></i></button>
                </span>
            </div>
        </div>
        <!-- End Search Box -->

    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Faculties</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">
        <div class="col-sm-12" id="addFaculties">

        </div>
    </div>
    <!--End page content-->
@endsection

@section('scripts')
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

@endsection

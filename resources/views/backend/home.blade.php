@extends('backend.app')
@section('title')
Home page
@endsection
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Home page</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
{{--                            <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>--}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <a href="{{route('home_page')}}" class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                        <h6 class="text-white">Home</h6>
                    </div>
                </a>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <a href="{{route('locations.show')}}" class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                        <h6 class="text-white">Locations</h6>
                    </a>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                        <h6 class="text-white">Widgets</h6>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-6 col-lg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                        <h6 class="text-white">Tables</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- card -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Progress Box</h4>
                        <div class="mt-3">
                            <div class="d-flex no-block align-items-center">
                                <span>81% Clicks</span>
                                <div class="ms-auto">
                                    <span>125</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar"
                                     style="width: 81%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex no-block align-items-center mt-4">
                                <span>72% Uniquie Clicks</span>
                                <div class="ms-auto">
                                    <span>120</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                     style="width: 72%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex no-block align-items-center mt-4">
                                <span>53% Impressions</span>
                                <div class="ms-auto">
                                    <span>785</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                                     style="width: 53%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex no-block align-items-center mt-4">
                                <span>3% Online Users</span>
                                <div class="ms-auto">
                                    <span>8</span>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                     style="width: 3%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
@endsection

@section('css')

@endsection

@section('js')

@endsection

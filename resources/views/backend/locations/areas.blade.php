@extends('backend.app')
@section('title')
    Location Areas
@endsection
@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Location Areas</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Locations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Areas</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-head">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Area</th>
                                <th scope="col">Created date</th>
                                <th scope="col">Edited date</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">
                            @foreach($location_areas as $area)
                            <tr>
                                <td>{{$area->id}}</td>
                                <td>{{$area->name}}</td>
                                <td>{{$area->created_at}}</td>
                                <td>{{$area->updated_at}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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

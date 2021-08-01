@extends('backend.app')
@section('title')
    Locations
@endsection
@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Locations</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Locations</li>
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
                    <div class="card-body">
                        <button onclick="show_add_modal();" type="button" class="btn btn-success btn-sm text-white">
                            Add
                        </button>
                        <button onclick="show_update_modal();" type="button" class="btn btn-warning btn-sm">Update
                        </button>
                        <button onclick="del('{{route("locations.delete")}}');" type="button"
                                class="btn btn-danger btn-sm text-white">Delete
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" style="margin-bottom: 0 !important;">
                            <thead class="table-head">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Location</th>
                                <th scope="col">Area</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Contract</th>
                                <th scope="col">Payment type</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Created date</th>
                                <th scope="col">Edited date</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">
                            @php($today = \Carbon\Carbon::today()->toDateString())
                            @foreach($locations as $location)
                                <tr class="rows" id="row_{{$location->id}}" onclick="select_row({{$location->id}})">
                                    <td>{{$location->id}}</td>
                                    <td id="location_{{$location->id}}">{{$location->location}}</td>
                                    <td id="area_{{$location->id}}" area_id="{{$location->area_id}}">{{$location->area}}</td>
                                    <td id="activity_{{$location->id}}" activity_id="{{$location->activity_id}}">{{$location->activity}}</td>

                                    @if($location->contract_id != null)
                                        <td>
                                            @php($start_date = $location->start_date)
                                            @php($expiry_date = $location->expiry_date)

                                            @if($start_date <= $today)
                                                @if($today <= $expiry_date || $expiry_date == null)
                                                    @php($contract_color = 'limegreen')
                                                @else
                                                    @php($contract_color = 'red')
                                                @endif
                                            @else
                                                @php($contract_color = 'yellow')
                                            @endif

                                            <span style="color: {{$contract_color}};">{{$location->contract}}</span><br>

                                            @if($location->is_active != 1)
                                                <span style="color: red;">Paused</span><br>
                                            @endif

                                            <span style="color: {{$contract_color}};">{{$start_date}}</span><br>

                                            @if($expiry_date == null)
                                                <span style="color: {{$contract_color}};" class="mdi mdi-infinity"></span>
                                            @else
                                                <span style="color: {{$contract_color}};">{{$expiry_date}}</span>
                                            @endif
                                        </td>

                                        <td>{{$location->payment_type}}</td>
                                        <td>
                                            @if($location->payment_type_id == 1)
                                                {{--percent--}}
                                                {{$location->payment_percent}}%
                                            @else
                                                {{--cash or cart--}}
                                                @if($location->payment_price != null)
                                                    @php($price_penny = $location->payment_price / 100)
                                                    @php($payment_price = number_format((float) $price_penny, 2, '.', ''))
                                                    {{$payment_price}} {{$location->currency}}
                                                @else
                                                    0
                                                @endif
                                            @endif
                                        </td>
                                    @else
                                        <td style="text-align: center;">-</td>
                                        <td style="text-align: center;">-</td>
                                        <td style="text-align: center;">-</td>
                                    @endif
                                    <td id="contract_{{$location->id}}" contract_id="{{$location->contract_id}}">{{$location->created_at}}</td>
                                    <td id="payment_{{$location->id}}"
                                        payment_type_id="{{$location->payment_type_id}}"
                                        payment_percent="{{$location->payment_percent}}"
                                        payment_price="{{$location->payment_price}}"
                                        payment_currency_id="{{$location->currency_id}}">
                                        {{$location->updated_at}}
                                    </td>
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

    <!-- Modal -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add area</h5>
                    <button type="button" class="btn btn-danger btn-sm"  onclick="close_modal();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" class="add_or_update_form" action="#" method="post">
                    {{csrf_field()}}
                    <div id="form_item_id"></div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name"
                                           class="col-sm-3 text-end control-label col-form-label">Area <font style="color: red;">*</font></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" required=""
                                               maxlength="100" placeholder="Area">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                    <div class="modal-footer">
                        <p class="submit">
                            <button type="button" class="btn btn-danger btn-sm" onclick="close_modal();">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#form').ajaxForm({
                beforeSubmit: function () {
                    //loading
                    swal({
                        title: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Please wait...</span>',
                        text: 'Loading, please wait...',
                        showConfirmButton: false
                    });
                },
                success: function (response) {
                    form_submit_message(response);
                }
            });
        });

        function show_add_modal() {
            $('#form_item_id').html("");
            $(".add_or_update_form").prop("action", "{{route("locations.areas.add")}}");
            $('.modal-title').html('Add area');

            $("#name").val("");

            $('#add-modal').modal('show');
        }

        function show_update_modal() {
            let id = 0;
            id = row_id;
            if (id === 0) {
                swal(
                    'Warning',
                    'Please select item!',
                    'warning'
                );
                return false;
            }

            let id_input = '<input type="hidden" name="id" value="' + row_id + '">';

            $('#form_item_id').html(id_input);
            $(".add_or_update_form").prop("action", "{{route("locations.areas.update")}}");
            $('.modal-title').html('Update area');

            $("#name").val($("#name_" + row_id).text());

            $('#add-modal').modal('show');
        }
    </script>
@endsection

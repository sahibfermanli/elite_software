@extends('backend.app')
@section('title')
    Payment Types
@endsection
@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Payment Types</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home_page')}}">Home</a></li>
{{--                            <li class="breadcrumb-item"><a href="#">Payments</a></li>--}}
                            <li class="breadcrumb-item active" aria-current="page">Payments</li>
                            <li class="breadcrumb-item active" aria-current="page">Payment types</li>
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
                        <button onclick="del('{{route("payments.payment_types.delete")}}');" type="button"
                                class="btn btn-danger btn-sm text-white">Delete
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table" style="margin-bottom: 0 !important;">
                            <thead class="table-head">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Payment type</th>
                                <th scope="col">Created date</th>
                                <th scope="col">Edited date</th>
                            </tr>
                            </thead>
                            <tbody class="customtable">
                            @foreach($payment_types as $payment_type)
                                <tr class="rows" id="row_{{$payment_type->id}}" onclick="select_row({{$payment_type->id}})">
                                    <td>{{$payment_type->id}}</td>
                                    <td id="name_{{$payment_type->id}}">{{$payment_type->name}}</td>
                                    <td>{{$payment_type->created_at}}</td>
                                    <td>{{$payment_type->updated_at}}</td>
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
                    <h5 class="modal-title">Add payment type</h5>
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
                                           class="col-sm-3 text-end control-label col-form-label">Payment type <font style="color: red;">*</font></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" required=""
                                               maxlength="100" placeholder="Payment type">
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
            $(".add_or_update_form").prop("action", "{{route("payments.payment_types.add")}}");
            $('.modal-title').html('Add payment type');

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
            $(".add_or_update_form").prop("action", "{{route("payments.payment_types.update")}}");
            $('.modal-title').html('Update payment type');

            $("#name").val($("#name_" + row_id).text());

            $('#add-modal').modal('show');
        }
    </script>
@endsection

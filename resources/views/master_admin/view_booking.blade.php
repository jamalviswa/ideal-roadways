@extends('master_admin.templete')
@section('title','Master Booking ')
@section('style')
<!-- DataTables -->
<link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Ideal Roadways</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h5 class="page-title">View Branch</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">All Branch</h4>
                        @if(Session::has('message_update'))
                        <div class="alert alert-success">
                           {{ Session::get('message_update') }}
                        </div>
                        @endif
                           @if(Session::has('message_delete'))
                        <div class="alert alert-danger">
                           {{ Session::get('message_delete') }}
                        </div>
                        @endif
                           @if(Session::has('message'))
                        <div class="alert alert-warning">
                           {{ Session::get('message') }}
                        </div>
                        @endif
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Load Id</th>
                                <th>Load Name</th>
                                <th>Truck Number</th>
                                <th>Booked By</th>
                                <th>Cancel</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $book)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$book->My_load->id}}</td>
                                        <td>{{$book->My_load->name}}</td>
                                        <td>{{$book->My_Truck->truck_number}}</td>
                                        <td>
                                            @if($book->user_id==-1)
                                                Admin
                                            @else
                                                {{$book->post_by->name}}
                                            @endif

                                        </td>
                                        <td>
                                            <a href="#" data-load_id="{{$book->id}}" class="btn cancel btn-danger text-white btn-xs">Cancel</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <!-- end row -->


        <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"> Un Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{route('cancel-booking')}}">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks *</label>
                        <textarea name="remark" required class="form-control"></textarea>
                        <input type="hidden" name="load_id" id="load_id">
                        @csrf()
                    </div>
                     
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </div><!-- container fluid -->

</div>  
@endsection
@section('scripts')
 <!-- Required datatable js -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/pages/datatables.init.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $("#datatable-buttons_filter").addClass('float-right');
        $("#datatable-buttons_paginate").addClass('float-right');
    });



    
    $(document).on('click','.cancel',function(){
            $("#load_id").val($(this).attr('data-load_id'));

        $(".bs-example-modal-lg1").modal()


        })
</script>
@endsection
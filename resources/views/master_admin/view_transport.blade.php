@extends('master_admin.templete')
@section('title','Master View Transport')
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
                <h5 class="page-title">View Transport</h5>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body table-responsive">
                        <h4 class="mt-0 header-title">All Transport</h4>
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
                        <table id="datatable-buttons" class="table table-striped table-bordered  " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th rowspan="2">S.No</th>
                                <th width="20%" rowspan="2">Name</th>
                                <th rowspan="2">State</th>
                                <th rowspan="2">District</th>
                                <th rowspan="2">Address</th>
                                <th rowspan="2">Phone</th>
                                <th colspan="3" class="text-center">Action</th>
                            </tr>
                            <tr>
                                <td>Truck</td>
                                <td>Update</td>
                                <td>Delete</td>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($transports as $trans)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>Name :{{$trans->name}}<br>Transport Phone:{{$trans->owner_phone}}</td>
                                        <td>
                                            {{$trans->MyState->state}}
                                        </td>
                                        <td>
                                            {{$trans->MyDistrict->district}}
                                        </td>
                                        <td>{{$trans->location}}</td>
                                        <td>{{$trans->phone}}</td>
                                        <td>
                                            <a href="{{route('add-truck',[$trans->id])}}" class="btn btn-primary">Add Truck</a>

                                            <a href="{{route('view-truck',[$trans->id])}}" class="btn btn-info">View Truck</a>
                                        </td>
                                        <td>
                                            <a href="{{route('transport_update',[$trans->id])}}" class="btn btn-warning text-white btn-xs">update</a>
                                        </td>
                                        <td>
                                            <a href="{{route('transport_delete',$trans->id)}}" class="btn btn-danger     text-white btn-xs">delete</a>
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
</script>
@endsection
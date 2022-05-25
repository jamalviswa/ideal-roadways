@extends('transport.templete')
@section('title','Master Add Branch')
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
                        <table id="datatable-buttons" class="table table-striped table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th >S.No</th>
                                <th >TruckInfo</th>
                                <th >Location</th>
                                <th  class="text-center">Update</th>
                             
                                
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($trucks as $truck)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>
                                            Number:{{$truck->truck_number}}
                                           <br> Mobile:{{$truck->phone}}
                                            <br>Model:{{$truck->model}}
                                        
                                        </td>
                                        <td>{{$truck->current_location}}</td>
                                       <td>
                                            <a href="{{route('transport_truck_update',[$truck->id])}}" class="btn btn-warning text-white btn-xs">update</a>
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
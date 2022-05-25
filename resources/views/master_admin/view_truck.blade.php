@extends('master_admin.templete')
@section('title','Master View Truck')
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
                                <th rowspan="2">TruckInfo</th>
                                <th rowspan="2">password</th>
                                <th rowspan="2">Location</th>
                                <th colspan="3" class="text-center">Action</th>
                            </tr>
                            <tr>
                                <td>Logout</td>
                                <td>Update</td>
                                <td>Delete</td>
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
                                            <br>Driver Name:{{$truck->d_name}}
                                        
                                        </td>

                                        <td>{{$truck->password}}</td>
                                        <td>{{$truck->current_location}}</td>
                                        <td>
                                            <a href="{{route('reset_password',[$truck->id])}}" class="btn btn-info text-white btn-xs">Logout</a>
                                        </td>
                                        <td>
                                            <a href="{{route('truck_update',[$truck->id])}}" class="btn btn-warning text-white btn-xs">update</a>
                                        </td>
                                        <td>
                                            <a href="{{route('truck_delete',$truck->id)}}" class="btn btn-primary text-white btn-xs">delete</a>
                                        </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="row" >
            <div class="col-12">
                <div class="card">
                    <form method="POST">
                        @csrf
                        </form>
                    <div class="card-header">
                        <div class="float-right col-md-4">
                            <label>State</label>
                            <select class="form-control">
                                <option value="">All</option>
                                @foreach($states as $state)
                                <option value="{{$state->state}}">{{$state->state}}</option>

                                @endforeach
                            </select>
                        </div>  
                    </div>
                    <div class="card-body" id="map" style="height: 100vh;border:1px solid red  ">

                    </div>
                </div>
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



<script
      src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API')}}&callback=initMap&libraries=&v=weekly"
      async
    ></script>

<script>
    let object=[];
let arr=[];

let pos={}
<?php  
    foreach($trucks as $truck)

    {

        ?>
          pos={ lat: '{{$truck->latitude}}', lng:'{{$truck->longitude}}' };
        var num='{{$truck->truck_number}}'
        
         arr=[pos,num]
        object.push(arr)
        <?php 
    }
?>
    function initMap(center={ lat: 20.5937, lng: 78.9629 },zoom=8) {
    

  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: zoom,
    center: center,
  });
  for(var i=0;i<object.length;i++)
  {
    object[i][0]['lat']=parseFloat(object[i][0]['lat'])
    object[i][0]['lng']=parseFloat(object[i][0]['lng'])
    var marker = new google.maps.Marker({
        position: object[i][0],
        map,
        title: object[i][1],
    });
    console.log(object[i][0])
  }
}
$(document).ready(function() {
        $('select').select2();
    });

$(document).on('change','select',function(){
    var val=$(this).val();
    if(val=='all')
    {
        return false;
    }
    $.ajax({
        url:`https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURI(val)}&key={{env('MAP_API')}}
            `,
        method:"POST",
        success:function(data){
            data=data['results'][0]['geometry']['location']
            initMap(data,zoom=8)
        }
    })
})
</script>
@include('pusher');

@endsection
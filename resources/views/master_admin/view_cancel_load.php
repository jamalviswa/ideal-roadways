@extends('master_admin.templete')
@section('title','Master View Load')
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
                        <li class="breadcrumb-item"><a href="#">{{env('APP_NAME')}}</a></li>
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
                                <th >S.No</th>
                                <th >Date</th>
                                <th >Load</th>
                                <th >From</th>
                                <th >To</th>
                                <th >Remark</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($loads as $load)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$load->date}}</td>
                                        <td>{{$load->name}}</td>
                                        <td>
                                            {{$load->from_address}}
                                        </td>
                                        <td>
                                            {{$load->to_address}}
                                        </td>
                                        <td>{{$load->remark}}</td>
                                        
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
<style type="text/css">
           * element that contains the map. */
#map {
  height: 100vh;
}

</style>
        <!-- end row -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"> Direction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="map" style="height: 400px;">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel"> Direction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="POST" action="{{route('load_cancel_post')}}">
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
            
        <input type="hidden" id="from_address">
        <input type="hidden" id="to_address">
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
      function initMap() {
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: { lat: 20.5937, lng: 78.9629 },
        });
        directionsRenderer.setMap(map);

        const onChangeHandler = function () {
          calculateAndDisplayRoute(directionsService, directionsRenderer);
        };
          calculateAndDisplayRoute(directionsService, directionsRenderer);
       
      }
    $(".map").click(function(){
        $(".bs-example-modal-lg").modal()
        var from_address=$(this).attr('data-from')
        var to_address=$(this).attr('data-to')
        $("#from_address").val(from_address);
        $("#to_address").val(to_address);
        initMap();
    });
      function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        directionsService.route(
          {
            origin: {
              query:$('#from_address').val(),
            },
            destination: {
              query:$("#to_address").val(),
            },
            travelMode: google.maps.TravelMode.DRIVING,
          },
          (response, status) => {
            if (status === "OK") {
              directionsRenderer.setDirections(response);
            } else {
              window.alert("Directions request failed due to " + status);
            }
          }
        );
      }
    </script>

 <script
      src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API')}}&callback=initMap&libraries=&v=weekly"
      async
    ></script>
@endsection
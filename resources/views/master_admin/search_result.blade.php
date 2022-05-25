@extends('master_admin.templete')
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
                        <li class="breadcrumb-item"><a href="#">Drixo</a></li>
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
                    <div class="card-body">

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
                        <div class="float-right col-md-6">
                            <form method="POST">
                                @csrf()
                                <div class="form-group row">
                                    <div class="col">
                                        <label>Distance</label>
                                        <select name="distance" id="distance" class="form-control">
                                            <option value="10">10 km below</option>
                                            <option value="25">25 km below</option>
                                            <option value="50">50 km below</option>
                                            <option value="100">100 km below</option>
                                            <option value="150">150 km below</option>
                                            <option value="200">200 km below</option>
                                            <option value="250">250 km below</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Location</label>
                    			        <input type="text" value="{{ old('location') }}" name="location" id="location" class="form-control">
                                        
                                        @error('location')
                                            <div class="error">{{ $message }}</div>
                                            
                                        @enderror 
                                    </div>
                                </div>
@if(isset($info))
<a class="btn btn-danger float-right mb-2 ml-2" href="{{route('search')}}">Reset</a>
@endif
<input type="submit" class="btn btn-success float-right mb-2" value="Search"/>

                            </form>
                        </div>
                        <div class="table-responsive">
                            
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Transport</th>
                                    <th>Truck</th>
                                    <th>Model</th>
                                    <th>Location</th>
                                    <th>Distance</th>

                                </tr>
                                
                                </thead>
                                <tbody>
                                    @if(isset($results))
                                        @foreach($results as $truck)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>
                                                Name :{{$truck['transport_name']}}
                                            <br> Mobile :{{$truck['transport_mobile']}}

                                            </td>
                                            <td>
                                                Number :{{$truck['truck_number']}}
                                                <br> Mobile : {{$truck['truck_mobile']}}
                                            </td>
                                            <td>{{$truck['truck_model']}}</td>
                                            <td>{{$truck['truck_location']}}</td>
                                            <td>{{$truck['distance']}}</td>
                                            
                                        </tr>
                                        @endforeach
                                    @else
                                    @foreach($trucks as $truck)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>

                                            <td>
                                                Name :{{$truck->MyTransport->name}}
                                            <br> Mobile :{{$truck->MyTransport->phone}}

                                            </td>
                                            <td>
                                                Number :{{$truck->truck_number}}
                                                <br> Mobile : {{$truck->phone}}
                                            </td>
                                            <td>{{$truck->model}}</td>
                                            <td>{{$truck->current_location}}</td>
                                            <td>
                                                -
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                   
                                    
                                </tbody>
                            </table>

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
<script src="{{asset('assets/pages/datatables.init.js')}}"></script>
<script src="//maps.googleapis.com/maps/api/js?key={{env('MAP_API')}}&sensor=false&libraries=places&language=en" type="text/javascript"></script>

<script type="text/javascript">
    $(function(){
        $("#datatable-buttons_filter").remove();
        $("#datatable-buttons_paginate").addClass('float-right');
    });
     var darection = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        google.maps.event.addDomListener(window, 'load', function () {
            new google.maps.places.SearchBox(document.getElementById('location'));
        });
    
    $(document).ready(function() {
        $('select').select2();
    });

    <?php
    if(isset($info))
    {
        ?>
        $("#location").val("<?php echo $info[0]?>");
        $("#distance").val("<?php echo $info[1]?>");
        <?php
    }
    
    ?>
</script>
@endsection
@extends('master_admin.templete')
@section('title','  Dashboard')
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
                <h5 class="page-title">Dashboard</h5>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 bg-primary  text-white">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-cube-outline float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">Total Branch</h6>
                    </div>
                    <div class="card-body">
                        <div class=" text-center ">
                            <h3>{{$record['branch']}}</h3>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 bg-primary text-white">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-account-network float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">Total Transport</h6>
                    </div>
                  <div class="card-body">
                        <div class=" text-center ">
                            <h3>{{$record['transport']}}</h3>

                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 bg-primary text-white">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-tag-text-outline float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">Total Truck</h6>
                    </div>
                 <div class="card-body">
                        <div class=" text-center ">
                            <h3>{{$record['truck']}}</h3>

                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat m-b-30">
                    <div class="p-3 bg-primary text-white">
                        <div class="mini-stat-icon">
                            <i class="mdi mdi-cart-outline float-right mb-0"></i>
                        </div>
                        <h6 class="text-uppercase mb-0">Total Loads</h6>
                    </div>
                  <div class="card-body">
                        <div class=" text-center ">
                            <h3>{{$record['load']}}</h3>

                        </div>
                        
                    </div>
                </div>
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
        <!-- end row -->


    </div><!-- container fluid -->

</div>  
@endsection
@section('scripts')
 <script
      src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API')}}&callback=initMap&libraries=&v=weekly"
      async
    ></script>

<script>
    let object=[];
let arr=[];

<?php
    foreach($trucks as $truck)
    {
        ?>
        var pos={ lat: '{{$truck["lat"]}}', lng:'{{$truck["lng"]}}' };
        var num='{{$truck["number"]}}'
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

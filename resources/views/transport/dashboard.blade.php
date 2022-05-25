@extends('transport.templete')
@section('title','Transport | Dashboard')
@section('content')
<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="float-right page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{config('app.name')}}</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    
<br>
                </div>
                <h5 class="page-title">Dashboard</h5>
            </div>
        </div>
        <!-- end row -->
<style type="text/css">
    #map {
  height: 100%;
}
</style>
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  My Trucks
                <div>

                <div class="card-body" id="map" style="height: 100vh;border:1px solid red  ">

                </div>
              </div>
            </div>
         </div>
         <form method="POST">
         @csrf
         </form>
        <!-- end row -->


    </div><!-- container fluid -->
{{-- {{$my_location->}} --}}
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
    object[i][0]['lat']=parseInt(object[i][0]['lat'])
    object[i][0]['lng']=parseInt(object[i][0]['lng'])
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

 
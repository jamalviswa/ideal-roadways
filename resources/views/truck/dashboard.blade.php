@extends('truck.templete')
@section('title','Truck | Dashboard')
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
            <div class="col-12 mb-2">
                         
            </div>
            <div class="col-md-6" >
              <div class="card">
                <div class="card-header">
                   <form method="POST" class="float-right" action="{{route('update_truck_location')}}">
                      @csrf
                      <input type="hidden" name="lat" id="lat"/>
                      <input type="hidden" name="long" id="long"/>
                      <button class="btn btn-primary text-white" type="submit">Update My Location</button><br>

                  </form>
                     <a id="cd" class="btn btn-info " target="_blank">My Location</a>

                </div>
                <div class="card-body" style="height: 100vh;" id="map"></div>

              </div>

            </div> 
            <div class="col-md-6" >
              
 
              <div class="card">
                <div class="card-header">
                  Load Information
                </div>
               
                    <div class="card-body">
                      <div class="list-group" style="margin: 0">
                @foreach ($data as $user)
                     <div  class=" list-group-item list-group-item-action">
                  
                        <table>
                          <tbody>
                            <tr>
                              <td>Load Id</td>
                              <td>{{$user['id']}}</td>
                            </tr>
                            <tr>
                              <td>Load Name</td>
                              <td>{{$user['name']}}</td>
                            </tr>
                            <tr>
                              <td>From Address</td>
                              <td>{{$user['from_address']}}</td>
                            </tr>
                           <tr>
                              <td>To Address</td>
                              <td>{{$user['to_address']}}</td>
                            </tr>
                            <tr>
                              <td>Distance</td>
                              <td>{{$user['distance']}}</td>
                            </tr>
                            <tr>
                              <td>Empty</td>
                              <td>{{$user['distance_1']}} km</td>
                            </tr>
                            <tr>
                              <td><button data-to="{{$user['to_address']}}" data-from="{{$user['from_address']}}" class="btn  btn-info map">Route</button></td>
                              <td>
                                <a href="tel:{{$user['call']}}"><i class="fa fa-phone"></i>&nbsp;{{$user['call']}}</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <span class="float-right">
                          {{$user['post_by']}}

                            </span>

                    </div>
                @endforeach             
              </div>
              <input type="hidden" id="from_address">
              <input type="hidden" id="to_address">
                    </div>
                    <div class="card-footer" style="justify-content: space-around;">
         {{ $loads->links() }}
                      
                    </div>
              </div>
         </div>
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
    <script type="text/javascript">
    $(function(){
      $(".map").click(function(){
        $(".bs-example-modal-lg").modal()
        var from_address=$(this).attr('data-from')
        var to_address=$(this).attr('data-to')
        $("#from_address").val(from_address);
        $("#to_address").val(to_address);
        initMap();
      });
    })
        function initMap(route=false) {

  const myLatLng = { lat: <?php echo $my_location[0]?>, lng:<?php echo $my_location[1]?> }
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: myLatLng,
  });
   const image ="https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
  
  new google.maps.Marker({
    position: myLatLng,
    map,
    icon:image,
    title: "My Location",
  });
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer();
     

  directionsRenderer.setMap(map);
  
const onChangeHandler = function () {
  calculateAndDisplayRoute(directionsService, directionsRenderer);
};
  calculateAndDisplayRoute(directionsService, directionsRenderer);

}
function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        
        directionsService.route(
          {
            origin: {
              query:"{{$my_location[2]}}"
             ,
            },
            destination: {
              query:$("#to_address").val(),
            },
            waypoints: [
            {location: $('#from_address').val()}
          ],  
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
get_live('cd','d')
function get_live(id,hide)
    {
   var log ='';
   var lat='';
  const successCallback=(position)=>
  {
    log=position["coords"]["longitude"];
    lat=position["coords"]["latitude"]
    console.log(position)
   var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(lat, log);
    geocoder.geocode({
    'latLng': latlng
}, function(results, status) {
  console.log(results)
    if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
            var add = results[0].formatted_address;
                // $('#'+id).text(add);
                // alert(add)
             $("#"+hide).val(add);
        } else {
            alert("address not found");
        }
    } else {
    }
});
    var loc1=`https://www.google.com/maps/search/?api=1&query=`+position["coords"]["latitude"]+`,`+position["coords"]["longitude"]; 
   $('#'+id).attr('href',loc1);
   $("#lat").val(position["coords"]["latitude"]);
   $("#long").val(position["coords"]["longitude"]);
  };
  const errorCallback=(error)=>
  {
    // alert()
    console.error(error)
  };
  navigator.geolocation.watchPosition(successCallback,errorCallback);


}
var flex=$(".flex");
flex.removeClass();
flex.attr('id','flex');
$("#flex a").removeClass().addClass('btn btn-primary ');
$("#flex span").removeClass().addClass('btn btn-secondary btn-disabled float-right');

</script>
<!-- start webpushr code --> <script>(function(w,d, s, id) {if(typeof(w.webpushr)!=='undefined') return;w.webpushr=w.webpushr||function(){(w.webpushr.q=w.webpushr.q||[]).push(arguments)};var js, fjs = d.getElementsByTagName(s)[0];js = d.createElement(s); js.id = id;js.async=1;js.src = "https://cdn.webpushr.com/app.min.js";fjs.parentNode.appendChild(js);}(window,document, 'script', 'webpushr-jssdk'));webpushr('setup',{'key':'BD1RV_xlcqWuYKMRT4ARVIej9HeK3oowqHEyylkX6RnK40hShMBQv-Wj_CMjpA_B_XuRsNBVixv2mi3bqeJ0ka8' ,'integration':'popup' });</script><!-- end webpushr code -->
<script>
    function _webpushrScriptReady(){
    webpushr('fetch_id',function (sid) { 
      console.log(sid)
      var _token=$("input[name*='_token']").val();

        $.ajax({
            url:'{{route('save_push_id')}}',
            method:"POST",
            data:{
                _token:_token,
                sid:sid
            },
            success:function(data)
            {
                console.log(data);
            }
             
        });
       
    });
}
</script>
@include('pusher')
@endsection

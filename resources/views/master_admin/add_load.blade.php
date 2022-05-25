@extends('master_admin.templete')
@section('title','Add Load')
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
                <h5 class="page-title">Dashboard</h5>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-md-7" style="margin: auto;">
                <div class="card m-b-30">
                	<div class="p-2 bg-primary text-white">
                        <h4 class="header-title">Add  Load</h4>
                		
                	</div>
                    <div class="card-body">
                    	<form method="POST" action="{{route('load_add_post')}}">
                    		@csrf
                    		<div class="form-group">
                    			<label>Load Name</label>
                    			<input type="text" value="{{ old('name') }}" name="name" class="form-control">
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                    		</div>
                    		<div class="form-group">
                                <label>From Address</label>
                                <textarea autocomplete="off" class="form-control" id="from_address" name="from_address">{{old('from_address')}}</textarea>
                    	      @error('from_address')
                                    <div class="error">{{ $message }}</div>
                                    
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label>To Address</label>
                                <textarea autocomplete="off" class="form-control" id="to_address" name="to_address">{{old('from_address')}}</textarea>
                                @error('to_address')
                                    <div class="error">{{ $message }}</div>
                                    
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="date" value="{{old('date')}}" class="form-control">
                                @error('date')
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                            </div>

                            <input type="submit" name="save" value="Save" class="btn btn-primary">
                    	</form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->


    </div><!-- container fluid -->

</div>  
@endsection
@section('scripts')
 <script src="//maps.googleapis.com/maps/api/js?key={{env('MAP_API')}}&sensor=false&libraries=places&language=en" type="text/javascript"></script>
    <script>
     var darection = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        google.maps.event.addDomListener(window, 'load', function () {
            new google.maps.places.SearchBox(document.getElementById('to_address'));
            new google.maps.places.SearchBox(document.getElementById('from_address'));
        });
    
    </script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').select2();
    });
    // function getDistrict(type)
    // {
    //     var state_id='state';
    //     var district_con='district_con';
    //     var district='district';
    //     if(type=='to')
    //     {
    //         district='to_district';
    //         state_id='to_state';
    //         district_con='to_district_con';
    //     }
    //     var state=$("#"+state_id).val();
    //     var _token=$("input[name*='_token']").val();
    //     if(state=='')
    //     {
    //         $("#"+district_con).hide();
    //         $("#"+district).html('<option>Select District</option>');
    //         return false;
    //     }
    //     $.ajax({
    //         url:"{{route('district')}}",
    //         method:"POST",
    //         data:{
    //             state:state,
    //             _token:_token
    //         },
    //         beforeSend:function(){
    //             //$("#status").show();
    //             //$("#preloader").show();
    //             // alert()
    //         },
    //         success:function(data)
    //         {
    //             $("#"+district_con).show();
    //             $("#"+district).html(data)
    //         }
    //     });
    // }
</script>
@endsection
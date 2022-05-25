@extends('master_admin.templete')
@section('title','Master Update  Truck')
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
                <h5 class="page-title">Dashboard</h5>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-7" style="margin: auto;">
                <div class="card m-b-30">
                	<div class="p-2 bg-primary text-white">
                        <h4 class="header-title">Update  Truck</h4>
                		
                	</div>
                    <div class="card-body">
                        
                    	<form method="POST" action="{{route('truck_update_post',['id'=>$trucks->id])}}">
                    		@csrf
                    		   <div class="form-group">
                                <label>Truck Name</label>
                                <input type="text" value="{{$login[0]->name }}" name="name" class="form-control">
                                @error('name')                                                                                                                                              
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                            </div>
                                <div class="form-group">
                                <label>Truck Number</label>
                                <input type="text" value='{{    $trucks->truck_number }}' name="number" class="form-control">
                                @error('number')                                                                                                                                              
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label>Truck Model</label>
                                <input type="text" value="{{ $trucks->model }}" name="model" class="form-control">
                                @error('model')                                                                                                                                              
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label>Driver Name</label>
                                <input type="text" value="{{ $trucks->d_name }}" name="d_name" class="form-control">
                                @error('d_name')                                                                                                                                              
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" value="{{ $trucks->phone }}" name="phone" class="form-control">
                                @error('phone')                                                                                                                                              
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address">{{ $trucks->current_location }}</textarea>
                                 @error('address')                                                                                                                                              
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label>User name</label>
                                <input type="text" name="username" value="{{ $login[0]->username }}" class="form-control">
                               @error('username')
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
<script type="text/javascript">
    $(document).ready(function() {
        $('select').select2();
    });
    function getDistrict()
    {
        var state=$("#state").val();
        var _token=$("input[name*='_token']").val();
        if(state=='')
        {
            $("#district_con").hide();
            $("#district").html('<option>Select District</option>');
            return false;
        }
        $.ajax({
            url:"{{route('district')}}",
            method:"POST",
            data:{
                state:state,
                _token:_token
            },
            beforeSend:function(){
                //$("#status").show();
                //$("#preloader").show();
                alert()
            },
            success:function(data)
            {
            $("#district_con").show();

                $("#status").hide();
                $("#preloader").hide();
                $("#district").html(data)
            }
        });
    }
</script>
@endsection
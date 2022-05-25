@extends('master_admin.templete')
@section('title','Master Add Transport')
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
                        <h4 class="header-title">Add  Transport</h4>
                		
                	</div>
                    <div class="card-body">
                    	<form method="POST" action="{{route('transport_add_post')}}">
                    		@csrf
                    		<div class="form-group">
                    			<label>Transport Name</label>
                    			<input type="text" value="{{ old('name') }}" name="name" class="form-control">
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                    		</div>
                    		<div class="form-group">
                                <label>State</label>
                    		    <select class="form-control" name="state" id="state" onchange="getDistrict()">
                                    <option value="">Select District</option>
                                    @foreach($states as $state)
                                        @if($state->id==old('state'))
                                        <option selected="" value="{{$state->id}}">{{$state->state}}</option>
                                        @else
                                        <option value="{{$state->id}}">{{$state->state}}</option>
                                        @endif
                                    @endforeach
                                </select> 
                                @error('state')
                                    <div class="error">{{ $message }}</div>
                                    
                                @enderror 
                            </div>
                            <div class="form-group"  id="district_con">
                                <label>District</label>
                                <select class="form-control" id="district" name="district">
                                    <option value="">Select District</option>
                                   
                                </select>

                                @error('district')
                                    <div class="error">{{ $message }}</div>
                                    
                                @enderror  
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                @error('phone')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Owner Phone Number</label>
                                <input type="text" name="owner_phone" value="{{ old('owner_phone') }}" class="form-control">
                                @error('owner_phone')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address">{{old('address')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>User name</label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control">
                               @error('username')
                                    <div class="error">{{ $message }}</div>
                                    
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" value="{{ old('password') }}">
                               @error('password')
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
                // alert()
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
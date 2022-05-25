@extends('master_admin.templete')
@section('title','Add Load')
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
            <div class="col-md-7" style="margin: auto;">
                <div class="card m-b-30">
                	<div class="p-2 bg-primary text-white">
                        <h4 class="header-title">Load Booking</h4>
                		
                	</div>
                    <div class="card-body">
                    	<form method="POST" action="{{route('save_booking')}}">
                    		@csrf
                    		<div class="form-group">
                    			<label>Load Id</label>
                                <select class="form-control" name="load" id="load" >
                                    <option value="">Select Load Id</option>
                                    @foreach($loads as $load)
                                        @if($load->id==old('load'))
                                        <option selected="" value="{{$load->id}}">{{$load->id}}</option>
                                        @else
                                        <option value="{{$load->id}}">{{$load->id}}</option>
                                        @endif
                                    @endforeach
                                </select> 
                                @error('load')
                                    <div class="error">{{ $message }}</div>
                                @enderror 
                    		</div>
                            <div class="form-group">
                    			<label>truck Id</label>
                                <select class="form-control"  name="truck" id="truck" >
                                    <option value="">Select truck Id</option>
                                    @foreach($trucks as $truck)
                                        @if($truck->id==old('truck'))
                                        <option selected="" value="{{$truck->id}}">{{$truck->truck_number}}</option>
                                        @else
                                        <option value="{{$truck->id}}">{{$truck->truck_number}}</option>
                                        @endif
                                    @endforeach
                                </select> 
                                @error('truck')
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
   
</script>
@endsection
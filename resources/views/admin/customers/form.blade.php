@extends('admin.layouts.app')
@section('title', 'Customers')
<!--begin::Content-->
@section('subheader')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
   <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <!--begin::Info-->
      <div class="d-flex align-items-center flex-wrap mr-2">
           <!--begin::Page Title-->
         <a href="{{route('admin.home')}}"><h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            Dashboard                           
         </h5></a>
         <!--end::Page Title-->
         <!--begin::Actions-->
         <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
         <!--begin::Page Title-->
         <a href="{{route('admin.customers.index')}}">
         <span class="text-muted font-weight-bold mr-4">
          Customers                          
         </span></a>
         <!--end::Page Title-->
         <!--begin::Actions-->
         <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
         <span class="text-muted font-weight-bold mr-4">{{$customer->id ? 'Edit Customer': 'Add Customer'}}</span> 
         <!--end::Actions-->
      </div>
      <!--end::Info-->
      <!--begin::Toolbar-->
      <div class="d-flex align-items-center">
         <!-- toolbar -->
      </div>
      <!--end::Toolbar-->
   </div>
</div>
<!--end::Subheader-->
@endsection
@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class=" container ">
   <div class="card card-custom gutter-b example example-compact">
      <div class="card-header">
         <h3 class="card-title">{{$customer->id ? 'Edit Customer': 'Add Customer'}}</h3>
      </div>
      <!--begin::Form-->
      <form class="form" action="{{$customer->id ? route('admin.customers.update',$customer->id) : route('admin.customers.store') }}" id="unit-class-form" method="POST" enctype="multipart/form-data">
         {{ $customer->id ? method_field('PUT') : '' }}
         @csrf
         <input type="hidden" name="type" value="{{ $customer->type }}">
         <div class="card-body">
            <div class="row">
                
               <div class="col-lg-6 form-group">
                  <label>Name<span class="text-danger">*</span> :</label>
                  <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{ old('name', $customer->name) }}">
                  @if($errors->has('name'))
                  <div class="fv-plugins-message-container">
                                   <div  class="fv-help-block">{{ $errors->first('name')}}</div>
                                  </div>
                  @endif
               </div>
               
               <!--<input type="hidden" name="phone_prefix" value="+91">-->
               
               <div class="col-lg-6 form-group">
                  <label>Phone<span class="text-danger">*</span> :</label>
                  <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}">
                  @if($errors->has('phone'))
                  <div class="fv-plugins-message-container">
                     <div  class="fv-help-block">{{ $errors->first('phone')}}</div>
                  </div>
                  @endif
               </div>
               
                <div class="col-lg-6 form-group">
                  <label>Email<span class="text-danger">*</span> :</label>
                  <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email', $customer->email) }}">
                  @if($errors->has('email'))
                  <div class="fv-plugins-message-container">
                                   <div  class="fv-help-block">{{ $errors->first('email')}}</div>
                                  </div>
                  @endif
                </div>
               
                <div class="form-group col-lg-6" style="display: flex;">
                    <div class="col-lg-9">
                        <label>Password @if(!$customer->password)<span class="text-danger">*</span>@endif :</label>
                        <input type="text" name="password" placeholder="Password" class="form-control" id="password" minlength="8" value="{{old('password')}}"/>
                        @if($errors->has('password'))
                            <div class="fv-plugins-message-container">
                                <div  class="fv-help-block">{{ $errors->first('password') }}</div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-3">
                        <button type="button" class="btn btn-info" id="generate-pswd">Generate<br>Password</button>
                    </div>
                </div>
               
               {{-- <div class="col-lg-6 form-group">
                  <label>Password Confirmation:</label>
                  <input type="password" class="form-control" placeholder="Confirm Password"  name="password_confirmation" id="confirm_password">
                  @if($errors->has('password_confirmation'))
                  <div class="fv-plugins-message-container">
                                   <div  class="fv-help-block">{{ $errors->first('password_confirmation')}}</div>
                                  </div>
                  @endif
               </div> --}}
                
                <div class="col-lg-3 form-group">
                    <label>Status :</label>
                    <span class="switch switch-outline switch-icon switch-success"> 
                        <label>
                            <input type="checkbox" {{ $customer->status ==1 ? 'checked' : '' }} name="checkbox1" id="check1" value="0" >
                            <input type="hidden" name="status" id="val1" value="@if($customer->id){{ old('status', $customer->status) }} @else 0 @endif">
                            <span></span>
                        </label>
                    </span>   
                    @if($errors->has('status'))
                        <div class="fv-plugins-message-container">
                            <div  class="fv-help-block">{{ $errors->first('status') }}</div>
                        </div>
                    @endif
                </div>
                
                <div class="col-lg-3 form-group">
                    <label>Verification Status :</label>
                    <span class="switch switch-outline switch-icon switch-success"> 
                        <label>
                            <input type="checkbox" {{ $customer->verification_status ==1 ? 'checked' : '' }} name="checkbox2" id="check2" value="0" >
                            <input type="hidden" name="verification_status" id="val2" value="@if($customer->id){{ old('verification_status', $customer->verification_status) }} @else 0 @endif">
                            <span></span>
                        </label>
                    </span>   
                    @if($errors->has('verification_status'))
                        <div class="fv-plugins-message-container">
                            <div  class="fv-help-block">{{ $errors->first('verification_status') }}</div>
                        </div>
                    @endif
                </div>
                
            </div>
            <div class="card-footer">
               <div class="row">
                  <div class="col-lg-6">
                  </div>
                  <div class="col-lg-6 text-right">
                     <button type="submit" class="btn btn-primary mr-2">Save</button>
                     <a class="btn btn-secondary" href="{{route('admin.customers.index')}}">Cancel</a>
                  </div>
               </div>
            </div>
        </div>
      </form>
      <!--end::Form-->
      </div>
      <!--begin::Row-->
   </div>
</div>
<!--end::Entry-->
<!--end::Content-->
@endsection
@push('styles')

@endpush

@push('scripts')

<script type="text/javascript">
    $(document).ready(function () {
        //if ( $("#password").val().length > 0 )
        $("#password").keypress(function(){
               $('#confirm_password').removeAttr('disabled');
        });
        $("#password").keydown(function(){
             //alert($("#password").val().length);
         if ( $("#password").val().length == 1 ){
            $('#confirm_password').attr('disabled','disabled'); 
         }
        });
         
    });
</script>
      
<script type="text/javascript">
    $(document).ready(function() {
        
        $('#check1').click(function(){
       
            if ($('#check1').is(":checked"))
            {
                   $("#val1").attr( "value", "1" );
            } 
       
            else{
                $("#val1").attr( "value", "0" );
            }
        });
          
           
        $('#check2').click(function(){
       
            if ($('#check2').is(":checked"))
            {
                   $("#val2").attr( "value", "1" );
            } 
       
            else{
                $("#val2").attr( "value", "0" );
            }
        });
           
           
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        
        $('#generate-pswd').click(function(){
             var randomString = Math.random().toString(36).slice(-8);
             $('#password').val(randomString);
        });
    
   });
</script>

@endpush
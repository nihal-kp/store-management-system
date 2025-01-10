@extends('admin.layouts.app')
@section('Title', 'Customer Details')
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
          <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
         <!--begin::Page Title-->
         <a href="{{route('admin.customer.index')}}">
         <span class="text-muted font-weight-bold mr-4">
          Customers                          
         </span></a>
         <!--begin::Actions-->
         <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
         <span class="text-muted font-weight-bold mr-4">Customer Details</span>
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
<div class="container">
   <!--Begin:: Portlet-->
   <div class="row">
      <div class="col-lg-12 order-1 order-xxl-2">
         <div class="card card-custom">
            <div class="kt-portlet">
               <div class="kt-portlet__body">
                  <div class="card-body">
                     <div class="kt-widget__top">
                        <div class="kt-widget__media kt-hidden">
                        </div>
                        <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-bolder kt-font-light" style="    margin-right: 15px;">
                           <span class="text-uppercase">{{substr($customer->name, 0, 2)}}</span>
                        </div>
                        <div class="kt-widget__content">
                           <div class="kt-widget__head">
                              <div class="kt-widget__user">
                                 
                                 <span class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--unified-success" style="padding-right: 10px;"> <i class="flaticon2-user"></i> Name: </span><a href="#" class="kt-widget__username">
                                 {{$customer->name}}                     
                                 </a>
                              </div>
                           </div>
                           <div class="kt-widget__subhead">
                              <i class="flaticon2-envelope"></i> Email : {{$customer->email}} 
                           </div>
                           <div class="kt-widget__subhead">
                              <i class="flaticon2-phone"></i> Phone : {{$customer->phone}}  
                           </div>
                           <div class="kt-widget__info">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--End:: Portlet-->
            <!--Begin:: Portlet-->
            <div class="card-body">
               <div class="kt-portlet__head">
                  <div class="kt-portlet__head-toolbar">
                     <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" data-toggle="tab" href="#kt_contacts_view_tab_1" role="tab">
                           <i class="flaticon2-calendar-3"></i> Personal
                           </a>
                        </li>
                          <li class="nav-item">
                           <a class="nav-link " data-toggle="tab" href="#kt_contacts_view_tab_2" role="tab">
                           <i class="flaticon2-calendar-3"></i> Orders
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="kt-portlet__body">
                  <div class="tab-content  kt-margin-t-20">
                     <!--Begin:: Tab Content-->
                     <div class="tab-pane active" id="kt_contacts_view_tab_1" role="tabpanel">
                        <form class="kt-form kt-form--label-left" action="">
                           <div class="kt-form__body">
                              <div class="kt-section kt-section--first">
                                 <div class="kt-section__body">
                                    <div class="row" style=" width: 100%; margin-top: 20px;float: left;">
                                       <div class="col-md-6">
                                          <div class="row">
                                             <!--<label class="col-xl-3"></label>-->
                                             <div class="col-lg-9 col-xl-6">
                                                <h3 class="kt-section__title kt-section__title-md">Personal Info:</h3>
                                             </div>
                                          </div>
                                          <div class="form-group row ">
                                             <label class="col-md-4 col-form-label"> ID :</label>
                                             <div class="col-md-6">
                                                <span class="form-control-plaintext kt-font-bolder">{{$customer->id}}</span>
                                             </div>
                                          </div>
                                          <div class="form-group row ">
                                             <label class="col-md-4 col-form-label"> Name :</label>
                                             <div class="col-md-6">
                                                <span class="form-control-plaintext kt-font-bolder">{{$customer->name}}</span>
                                             </div>
                                          </div>
                                         
                                          <div class="form-group row">
                                             <label class="col-md-4 col-form-label">Phone :</label>
                                             <div class="col-md-6">
                                                <span class="form-control-plaintext kt-font-bolder"> {{$customer->phone_prefix}} {{$customer->phone}}</span>
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                             <label class="col-md-4 col-form-label">Email :</label>
                                             <div class="col-md-6">
                                                <span class="form-control-plaintext kt-font-bolder"> {{$customer->email}}</span>
                                             </div>
                                          </div>
                                          <!--                          <div class="form-group row">-->
                                          <!--<label class="col-md-4 col-form-label">Login Type :</label>-->
                                          <!--                              <div class="col-md-6">-->
                                          <!--                                <span class="form-control-plaintext kt-font-bolder">  -  </span>-->
                                          <!--                              </div>-->
                                          <!--                          </div>-->
                                          
                                          @if($customer->gst_number)
                                          <div class="form-group row">
                                             <label class="col-md-4 col-form-label">GST Number :</label>
                                             <div class="col-md-6">
                                                <span class="form-control-plaintext kt-font-bolder"> {{$customer->gst_number}}</span>
                                             </div>
                                          </div>
                                          @endif
                                          
                                          <div class="form-group row">
                                             <label class="col-md-4 col-form-label">Account Status :</label>
                                             <div class="col-md-6">
                                                <span class="form-control-plaintext kt-font-bolder"> {{ $customer->status != 1 ? 'Disabled' : 'Enabled' }}</span>
                                             </div>
                                          </div>
                                          
                                          <div class="form-group row">
                                             <label class="col-md-4 col-form-label">Verification Status :</label>
                                             <div class="col-md-6">
                                                <span class="form-control-plaintext kt-font-bolder"> {{ $customer->verification_status != 1 ? 'Not Verified' : 'Verified' }}</span>
                                             </div>
                                          </div>
                                          
                                       </div>
                                       <div class="col-md-6">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                           <div class="kt-form__actions">
                           </div>
                        </form>
                     </div>
                     <!--End:: Tab Content-->
                    <!--Begin:: Tab Content-->
			<div class="tab-pane" id="kt_contacts_view_tab_2" role="tabpanel">				
                
                   <div class="kt-portlet kt-portlet--mobile" style="float: left;    width: 100%;    margin-top: 25px;">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-brand flaticon2-line-chart"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Order
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                         
                        </div>
                    </div>
            
                    <div class="kt-portlet__body" style="padding:15px 0;">
                       
                       
                     		<!--begin: Datatable-->
										<table class="table table-separate table-head-custom table-checkable" id="order-table">
											<thead>
												<tr>
											
				                                    <th>Invoice Id</th>
							                        
							                        <th>Order Date</th>
							                        <th>Customer Name</th>
							                        <th>Amount</th>
							                        <th>Order Status</th>
							                        <th>Payment Method</th>
							                       
							                        <th>View</th>
												</tr>
											</thead>
											<tbody>
										
				
											</tbody>
										</table>
										<!--end: Datatable-->
                         
                     
                    </div>
                 </div>
                 
			</div>
                     <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                     <div class="kt-form__actions">
                     </div>
                  </div>
                  <!--End:: Tab Content-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
 $(function() {
    $('#order-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.customer.show",$customer->id) }}',
        columns: [ 
			{ data: 'id', orderable: false },
             { data: 'created_at' },
              { data: 'name' },
            { data: 'total' },
            { data: 'status' },
            { data: 'payment_method', name:'payment_method' },
            { data: 'action', orderable: false}
        ]
    });
 });
 </script>
 @endpush
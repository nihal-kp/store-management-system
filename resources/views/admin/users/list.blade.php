@extends('admin.layouts.app')
@section('title', ' Users')
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
         <span class="text-muted font-weight-bold mr-4">Users</span>
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
<!-- begin:: Content -->
@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <!--begin::Container-->
   <div class="container">
      <!--begin::Card-->
      <div class="card card-custom">
         <div class="card-header flex-wrap py-5">
            <div class="card-title">
               <h3 class="card-label">
               Users
               <!--<span class="d-block text-muted pt-2 font-size-sm">extended pagination options</span></h3>-->
            </div>
            <div class="card-toolbar">
                @if(Auth::guard('admin')->user()->id==1 || auth()->user()->hasPermissionTo('Create User'))
                  <a href="{{route('admin.users.create')}}" class="btn btn-primary font-weight-bolder">
                      <i class="la la-plus"></i>
    				Add
                  </a>
               @endif
               <!--begin::Dropdown-->
            </div>
         </div>
         <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="admin_table">
               <thead>
                  <tr>
                     <th width="30%">Name</th>
                     <th width="25%">Email</th>
                     <th width="15%">Phone</th>
                     <th width="15%">Status</th>
                     <th width="15%">Actions</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
            <!--end: Datatable-->
         </div>
      </div>
      <!--end::Card-->
   </div>
   <!--end::Container-->
</div>
<!--end::Entry-->
<div class="modal fade" id="admin-delete" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
         </div>
         <div class="modal-body">
            <p>Do you want to delete selected Data ?<br/>This Process cannot be Rolled Back</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger btn_delete_admin "><i class="flaticon-delete-1"></i>Delete</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
@endsection
<!-- end:: Content -->
@push('scripts')
<script type="text/javascript">
   $(function() {
   
     $adminTable= $('#admin_table').DataTable({
   
         processing: true,
   
         serverSide: true,
   
         ajax: '{{ route("admin.users.index") }}',
   
         columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name:'email' },
            { data: 'phone', name:'phone'},
            { data: 'status', name:'status'},
            { data: 'action', orderable: false}
   
         ]
   
     });
     $('table').on('click','.admin-delete', function(e){
           var admin_href=$(this).data('href');

        $('.btn_delete_admin').off().click(function() {
      $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
          type: 'DELETE',
          //data:{},
          dataType : 'JSON', 
          url : admin_href,
          success: function(response){ 
            $('#admin-delete').modal('hide');
            $('#admin_table').DataTable().ajax.reload();
            toastr.success("Admin deleted successfully", "Success"); 
             
          } 
        }); 

    });
    });
   });
   setTimeout(function() 
   
   {
   
     $('#success_msg').fadeOut();
   
     },4000);
   
   
</script>
@endpush
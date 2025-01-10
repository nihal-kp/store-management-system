@extends('layouts.app')

@section('content')
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
    <div class="mobile-menu-handle"></div>
    <div class="container">
            <!-- Button trigger modal -->
    <div class="right-home">
        <h1>My Dashboard / <span> Settings</span></h1>
        <div class="bg1">
        <div class="top-ctry-sec">
        <div class="reset-box">
            <h2>Change Password</h2>
            <!--<p>Enter your username or email to reset your password.-->
            <!--You will receive an email with instructions on how to reset your password.</p>-->
            <form method="post" action="{{ route('account.updatePassword', auth('customer')->user()->id) }}" id="change-password">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <input type="password" name="current_password" placeholder="Enter your current password">
                    <div class="error_msg" id="error-current_password"></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <input type="password" name="password" placeholder="Enter your new password">
                    <div class="error_msg" id="error-password"></div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <input type="password" name="password_confirmation" placeholder="Re-enter new password">
                    <div class="error_msg" id="error-password_confirmation"></div>
                </div>
            </div>
            <button type="submit">Update</button>
            </form>
        </div>
        </div>
        </div>

        <div class="ftr-last">
            <p>Store Management System | Powered by <a href="#">Nihal K P</a></p>
        </div>
    </div>
    </div>    
@endsection

@push('scripts')
@if(session("success"))
<script type="text/javascript">
   toastr.info("Password updated successfully",{positionClass:"toast-bottom-right",containerId:"toast-bottom-right"});
</script>
@endif
<script>
$('#change-password').on('submit', function(e) {
        e.preventDefault();
        $this = $(this);
        $('#change-password').find('button').attr('disabled', true);
        $('.error_msg').html('').hide();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'PUT',
            dataType: 'JSON',
            data: $this.serialize(),
            url: $this.attr('action'),
            
            success: function(response) {
                if (response.intended != null) {
                    window.location.href = response.intended;
                    toastr.success(response.message, "Success");
                } else {
                    location.reload();
                    toastr.success(response.message, "Success");
                }
            },

            error: function(response) {
                $('#change-password').find('button').attr('disabled', false);
                $.each(response.responseJSON.errors, function(key, value) {

                    $('#error-' + key).html(value).show();

                });
            }

        });

    });
</script> 
@endpush
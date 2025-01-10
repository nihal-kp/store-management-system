<!doctype html>
<html class="no-js" lang="en">
    
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Store Management System</title>
        <meta name="description" content="Store Management System">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:title" content="Store Management System">
        <meta property="og:description" content="Store Management System">
        <meta property="og:image" content="{{ asset('assets/front/images/favi-icon.webp') }}">
        <link rel="shortcut icon" type="image/webp" href="{{ asset('assets/front/images/favi-icon.webp') }}"/>
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="{{ asset('assets/front/css/vendor.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/fonts/line-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/fonts/feather.css') }}">
    </head>
    <body>
<div class="login-full">
<div class="container">
    <!--<img src="images/New Project (10).png">-->
    <div class="login-white" style="display:block !important;">
<div class="login-left-text">
<h1>Welcome to Stores</h1>
<!-- <p></p> -->
</div>
</div>
<div class="login-box">

<div class="login-blue" id="signin">
<form class="" id="login-form" method="POST" action="{{ route('login') }}">
<input type="hidden" class="target" name="intended" value="{{ route('welcome') }}">
<h1>Login / Sign up</h1>
<div class="login-field">
<label>Email ID</label>
<input type="text" name="email" placeholder="Enter your registered email id">
<div class="error_msg error" id="error-email"></div>
</div>
<div class="login-field">
<label>Password</label>
<input type="password" name="password" placeholder="Enter your registered password">
<div class="error_msg error" id="error-password"></div>
<a href="#" class="frgt reset-psw">Forgot Password?</a>
</div>
<!-- <button class="login-blue-button">LogIn</button> -->
<!--<a href="home.php" class="login-blue-button">Login</a>-->
<button type="submit" class="login-blue-button submit_frm">Login</button>
<a href="#" class="sign-new new-user">Not a Member? Sign up</a>
</form>
</div>


<div class="login-blue" id="signup" style="display: none;">
<form class="" id="register-form" method="POST" action="{{ route('register') }}">
<input type="hidden" class="target" name="intended" value="{{ route('account-under-verification') }}">
<h1>Login / Sign up</h1>
<div class="login-field">
<label>Name</label>
<input type="text" name="name" placeholder="Enter your name">
<div class="error_msg error" id="reg-error-name"></div>
</div>
<div class="login-field">
<label>Mobile Number</label>
<input type="text" name="phone" class="phone" placeholder="Enter your mobile number">
<div class="error_msg error" id="reg-error-phone"></div>
</div>
<div class="login-field">
<label>Email ID</label>
<input type="text" name="email" placeholder="Enter your email id">
<div class="error_msg error" id="reg-error-email"></div>
</div>
<div class="login-field">
<label>Password</label>
<input type="password" name="password" placeholder="Enter your password">
<div class="error_msg error" id="reg-error-password"></div>
</div>
<button type="submit" class="login-blue-button">Sign up</button>
<a href="#" class="sign-new exist-user">Login</a>
</form>
</div>


<div class="login-blue" id="reset-password" style="display: none;">
                        
    <h1>Reset Password</h1>
   
    <form class="" id="reset-password-form" method="POST" action="{{ route('password.email') }}">
      <input type="hidden" name="_token" value="">
      <div class="login-field">
        <label>Enter Email ID</label>
        <input type="text" name="email" placeholder="Enter your email id">
        <div id="loader-aj" style="display: none"></div>
        <div class="success_msg" id="reset-password-success" style="display: none"></div>
        <div class="error error_msg" id="reset-password-error" style="display: none"></div>
      </div>
      <button type="submit" class="login-blue-button">Reset Password</button>
    </form>
<!--         <a class="sign-new new-user" href="#">Sign In</a>
 --><a href="#" class="sign-new exist-user">Login</a>
          </div>
</div>
</div>
</div>
<!-- Reference block for JS -->

<script src="{{ asset('assets/front/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/front/js/vendor.js') }}"></script>
<script src="{{ asset('assets/front/js/app.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
        signin();

    $(".new-user").click(function() {
        signup();
    });

    $(".exist-user").click(function() {
        signin();
    });

    $(".reset-psw").click(function() {
        resetPassword();
    });

    function signin() {
        $("#signin").css("display", "inline-block").siblings().css("display", "none");
        $("html, body").animate({scrollTop: 0}, 1000);
    }

    function signup() {
        $("#signup").css("display", "inline-block").siblings().css("display", "none");
        $("html, body").animate({scrollTop: 0}, 1000);
    }

    function resetPassword() {
        $("#reset-password").css("display", "inline-block").siblings().css("display", "none");
        $("html, body").animate({scrollTop: 0}, 1000);
    }

});
</script>


<script type="text/javascript">
  $('#login-form').on('submit', function(e) {
        
      e.preventDefault();
      $this = $(this);
      $('#login-form').find('button').attr('disabled', true);
      $('.error').html('').hide();

      $.ajax({

          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          dataType: 'JSON',
          data: $this.serialize(),
          url: $this.attr('action'),

          success: function(response) {
              // loginCheck();
              $('#login-form').find('button').attr('disabled', false);

              if (response.error) {
                  $('#error-email').html(response.error).show();
                  $('#login-form').trigger('reset');
              } else {
                  if (response.otp_verification_status != 1) {
                      $('#response-phone').html(response.phone);
                      $('#user_id').val(response.customer);
                      $('.error_msg').hide();
                    //   $('#response-verification_otp').html('The OTP to log in to your account is ' + response.otp);
                    //   otpVerification();
                      $('meta[name="csrf-token"]').attr('content', response.csrf);

                  } else {
                      if (response.intended != null) {
                          window.location.href = response.intended;
                      } else {
                          location.reload();
                      }
                  }
              }
          },

          error: function(response) {
              $('meta[name="csrf-token"]').attr('content', response.responseJSON.csrf);
              $('#login-form').find('button').attr('disabled', false);
              $.each(response.responseJSON.errors, function(key, value) {
                  $('#error-' + key).html(value).show();
              });
          }

      });

  });


  $('#register-form').on('submit', function(e) {

      e.preventDefault();
      $this = $(this);
      $('#register-form').find('button').attr('disabled', true);
      $('.error').html('').hide();
        
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          dataType: 'JSON',
          data: $this.serialize(),
          url: $this.attr('action'),
          
          beforeSend: function() {
             $('#signup-spinner-loader').show();
          },

          success: function(response) {

            //   otpVerification();
            //   $('#login_type').val(response.type);
             // $('#otp-show').html('Your OTP is ' + response.otp);
            //   $('#response-verification_otp').html('The OTP to log in to your account is ' + response.otp);
            //   $('#user_id').val(response.customer);
            //   $('#response-phone').html(response.phone);
            window.location.href = response.intended;
          },
          
          complete: function() {
              $('#signup-spinner-loader').hide();
          },

          error: function(response) {
              $('#signup-spinner-loader').hide();
              $('#register-form').find('button').attr('disabled', false);
              $.each(response.responseJSON.errors, function(key, value) {
                  $('#reg-error-' + key).html(value).show();
              });
          }

      });

  });


  $('#reset-password-form').on('submit', function(e) {
      
      e.preventDefault();
      $('#reset-password-success').hide();  
      $('#reset-password-error').hide();  
      $this = $(this);
      $('#loader-aj').html('Please wait...')
      $('#loader-aj').show();
      $('#register-form').find('button').attr('disabled', true);

      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'POST',
          dataType: 'JSON',
          data: $this.serialize(),
          url: $this.attr('action'),

          success: function(response) {
              if (response.status) {
                  $('#reset-password-success').html(response.status).show();
              }
              else {
                  $('#reset-password-error').html(response.error).show();
              }

          },
          complete: function() {
              $('#loader-aj').hide();
          },

          error: function(response) {
              $('#register-form').find('button').attr('disabled', false);
              $.each(response.responseJSON.errors, function(key, value) {
                $('#reset-password-error').html(value).show();
              });
          }
      });
  });
</script>
 
</body>
</html>
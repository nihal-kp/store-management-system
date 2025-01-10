<!doctype html>
<html class="no-js" lang="en">
   <head>
      <meta http-equiv="content-type" content="text/html;charset=utf-8" />
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>EVIZAX </title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/png" href="images/fav-icon.png"/>
      <!-- Place favicon.ico in the root directory -->
      <link rel="stylesheet" href="/css/vendor.css">
      <link rel="stylesheet" href="/css/evizax.css">
      <link rel="stylesheet" href="/css/bootstrap.min.css">
      <link rel="stylesheet" href="/fonts/feather.css">
<!--       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 -->
       <script src="/js/jquery-3.3.1.min.js"></script>
      <script src="/js/bootstrap.min.js"></script>
     
   </head>
   <body>
<div class="main-header">
<section id="panel-one">
<div class="container-width">
<div class="tel-b2b">
<a href="tel:+91 804 8070 318" class="support"> <img src="{{ asset('images/support.png') }}">+91 804 8070 318</a>  
<a href="" class="mail" style="border-right:none;"> <img src="{{ asset('images/mail.png') }}">info@evizax.com</a> 
</div>  
</div>  
</section>



<section id="cart-bg" class="pt35">
<a href="{{route('welcome')}}" class="logo"><h2 style="text-align: center;font-size: 40px;">evizax.com</h2>         </a>

<div class="container">

<div class="b2b-bg">
    
   <div class="log_box" id="signin">
        <form class="log_form" id="password-update-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="col-md-12 left">
                <div class="log_set">
                    <label>Email </label>
                  
                    <input type="text" name="email" value="{{ $email ?? old('email') }}"
                        placeholder="Enter email">

                    <div class="error error_msg" id="reset-error-email"></div>
                </div>

            </div>
            
            <div class="col-md-12 left">
                <div class="log_set">
                    <label>Enter Password </label>
                    
                    <input type="password" name="password" placeholder="****">
                    <div class="error error_msg" id="reset-error-password"></div>
                </div>
                
            </div>
            
            <div class="col-md-12 left">
                <div class="log_set">
                    <label>Confirm Password </label>
                    
                    <input type="password" name="password_confirmation" placeholder="****">
                    <div class="error error_msg" id="reset-error-password_confirmation"></div>
                </div>

            </div>
      
            <div class="col-lg-12 col-md-12 float-left">
                <button type="submit" class="submit_frm">Reset Password</button>
            </div>

      </form>
               
    </div>
</div>
</div>
</section>

<section id="footer">
<div class="ftr-last" style="float:left;text-align:center;">
<p style="text-align:center;width:100%;">© Copyright 2024 evizax All Rights Reserved | Powered by <a href="https://tnmonlinesolutions.com/" target="_blank">TNM Online Solutions</a></p>
</div>
</section>
</div>
</div>
         </div>
          </div>
      </div>
     
      <script src="/js/vendor.js"></script>
      <script src="/js/app.js"></script>
       <script type="text/javascript" src="/js/horizontal-scroll.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<script type="text/javascript">
    $('#password-update-form').on('submit', function(e) {

        e.preventDefault();

        $this = $(this);

        // signup();


        $.ajax({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type: 'POST',

            dataType: 'JSON',

            data: $this.serialize(),

            url: $this.attr('action'),


            success: function(response) {
                
                if (response.intended != null) {
                    window.location.href = response.intended;
                } else {
                    window.location.href = '{{ route('login') }}';
                }

            },
            complete: function() {
                $('#loader-aj').hide();
            },

            error: function(response) {

                // console.log(response);


                $('.error').html('').hide();
                $.each(response.responseJSON.errors, (key, value) => {

                    $('#reset-error-' + key).html(value).show();
                });



            }

        });

    });
</script>
      
   </body>
</html>

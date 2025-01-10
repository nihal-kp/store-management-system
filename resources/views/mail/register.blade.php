<html lang="en" class="no-js">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title> Store Management System </title>
      <link rel="shortcut icon" type="image/png" href="../images/fav-icon.png">
      <meta name="description" content="">
      <meta name="keywords" content=" ">
      <meta name="author" content="">
      <meta property="og:image" content="">
      <meta property="og:site_name" content="">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
   </head>
   </head>
   <body style="background: aliceblue;     margin: 0px;">
      <!--special-offer-section-->
      <table width="" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" class="MainContainer">
         <tbody style="display:inline-block;">
            <tr style="width: 100%;">
               <td style="width: 100%;">
                  <table border="0" width="100%" style="border: none;background:#133766;">
                     <tbody>
                        <tr style="width: 100%;">
                           <td style="width: 50%">
                              <table border="0" style="width: 100%;float: left;text-align: left;border-color:;margin: 0 0 0px;">
                                 <tbody>
                                    <tr style="width: 100%; text-align: center;">
                                       <td style="width:20%;vertical-align: middle;">
                                          {{-- <img src="{{ asset('assets/front/images/logo-eviza.png') }}" style="width:55%;"> --}}
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr style="width: 100%;">
               <td style="width: 100%;">
                  <table border="0" cellpadding="0" style="width: 100%;border: solid 1px transparent;font-family: 'Roboto', sans-serif;">
                     <tbody>
                        <tr style="width: 100%;">
                           <td style="width:100%;float: left;">
                              <table width="100%" cellpadding="5" border="0" style="border: none;">
                                 <tbody>
                                    <tr style="width: 100%">
                                       <th style="">
                                          {{-- <img src="{{asset('assets/front/images/unnamed1.png')}}" style="  /* float: left; */width:96px;   "> --}}
                                       </th>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr style="width: 100%;">
               <td style="width: 100%;">
                  <table border="0" cellpadding="0" style="width: 100%;border: solid 1px transparent;font-family: 'Roboto', sans-serif;">
                     <tbody>
                        <tr style="width: 100%;">
                           <td style="width:100%;float: left;">
                              <table width="100%" cellpadding="5" border="0" style="border: none;">
                                 <tbody>
                                    <tr style="width: 100%">
                                       <th style="font-size:19px;line-height: 28px;font-weight: 600;color: #000;padding: 5px 0px;text-align:center;">Hi {{ ucfirst($customer->name) }}, Welcome To  Stores</th>
                                    </tr>
                                    <tr style="width: 100%">
                                        @if($customer->verification_status != 1)
                                        <th style="font-size:14px;line-height: 25px;font-weight:400;color:#504848;padding: 5px 0px;text-align:center;"> Thank you for creating your account at  Stores! We are so happy to have you here with us. <br>Your account is under verification. Our team will get in touch with you shortly.</th>
                                        @else
                                        <th style="font-size:14px;line-height: 25px;font-weight:400;color:#504848;padding: 5px 0px;text-align:center;"> Thank you for creating your account at  Stores! <br>We are so happy to have you here with us.</th>
                                        @endif
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr style="width: 100%;height: 30px;"></tr>  
            
            @if($customer->verification_status == 1)
            <tr>
              <td style="outline:none;width:100%;margin:0;padding:0" align="left" valign="top">
                                                                                             <a href="{{ route('login') }}" style="background-color:#5484ee;color:#ffffff;display:block;font-family: 'Roboto', sans-serif;font-size:14px;font-style:normal;font-weight:500;text-align:center;text-decoration:none;word-spacing:0;border-radius:25px;padding:15px 20px;width:98px;margin:auto;display:block;" target="_blank">
                                                                                             <span>Click to login</span>
                                                                                             </a>
                                                                                          </td>
            </tr>
            <tr style="width: 100%;height: 30px;"></tr>
            @endif
            
            <tr>
               <td style="width:100%;float: left;">
                  <table class="table" border="1" cellpadding="5" cellspacing="0" style="width: 100%;float: left; border: none;;font-family: 'Roboto', sans-serif;">
                     <tbody>
                     </tbody>
                  </table>
               </td>
            </tr>
            <tr style="width: 100%;height: 35px;"></tr>
            <tr>
               <td style="width:100%;float: left;     background-color: #fff;    border-top: 1px solid #ccc;">
                  <table class="table" border="1" cellpadding="5" cellspacing="0" style="
                     width: 100%;
                     float: left;
                     border: none;
                     font-family: 'Roboto', sans-serif;
                     margin-top: 14px;
                     background-color: #fff;
                     margin-bottom: 14px;
                     ">
                     <tbody>
                        {{-- <tr style="width: 100%;background: #fff;">
                           <td style="font-size: 14px;line-height: 20px;font-weight: 400;color: #fff; text-align: center;     border: #fff;">
                              <a href="" style="color:#fff; text-decoration:none; font-size: 13px; 
                                 padding-right:10px;">
                              <img src="{{asset('assets/media/mail/fb.png')}}" style="position:relative; top:3px; margin-right:5px;"></a>
                              <a href="" style="color:#fff; text-decoration:none; font-size:13px; padding-right:10px;">
                              <img src="{{asset('assets/media/mail/inst.png')}}" style="position:relative; top:3px; margin-right:5px;"></a>
                           </td>
                        </tr>
                        <tr style="width: 100%;height:10px;"></tr> --}}
                        <tr style="width: 100%;background: #fff;">
                           <td style="font-size: 13px;line-height: 20px;font-weight: 400;color: #000; text-align: center;     border: #fff;">
                              Copyrights {{ date('Y') }} Store Management System. All rights reserved  
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
      <!--special-offer-section-->
   </body>
</html>
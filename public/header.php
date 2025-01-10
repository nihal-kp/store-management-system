 <header class="header">
               <div class="header-block header-block-collapse d-lg-none d-xl-none">
                  <button class="collapse-btn" id="sidebar-collapse-btn">
                  <i class="feather-menu"></i>
                  </button>
               </div>
               <div class="header-block header-block-nav">
                  <ul class="nav-profile">
                     
                     <li class="profile dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                           <!--<div style="float: left;margin-top:-1px;">-->
                           <!--   <div class="img" style="background-image: url('images/user.png')"> </div>-->
                           <!--</div>-->
                           <span style="font-weight: 300;" class="name">Hi <?php echo Auth::guard('travel_agent')->user()->name; ?>,</span><br>
                           <span class="name" style="top:-10px;"> Welcome </span>
                        </a>
                        <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
<!--                            <a class="dropdown-item" href="#">
 -->                           <!-- <i class="feather-user"></i> Profile </a>
                           <a class="dropdown-item" href="#">
                           <i class="feather-bell"></i> Notifications </a>
                           <a class="dropdown-item" href="#">
                           <i class="feather-settings"></i> Settings </a> -->
<!--                            <div class="dropdown-divider"></div>
 -->                           <a class="dropdown-item" href="logout">
                           <i class="feather-logout"></i> Logout </a>
                        </div>
                     </li>
                  </ul>
               </div>
            </header>
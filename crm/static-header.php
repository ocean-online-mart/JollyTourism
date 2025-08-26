<?php
$username = $_SESSION['username'];
$crm_id = $_SESSION['jt_id'];
$query  = "SELECT * FROM tb_admin WHERE username='".$username."' AND admin_id='".$crm_id."'";
echo $query;
$res_query = mysqli_query($conn,$query);
$fetch = mysqli_fetch_object($res_query);
$uname=strtolower($fetch->name);
$name_photo = substr($uname, 0, 1);
$adminpositions = $fetch->position;
if ($adminpositions == 1) {
 $types = 'Super Admin';
}
elseif ($adminpositions == 2) {
 $types = 'Admin';
}
elseif ($adminpositions == 3) {
 $types = 'Booking Admin';
}
?>
<div class="page-header">
  <div class="header-wrapper row m-0">
   
    <div class="header-logo-wrapper col-auto p-0">  
      <div class="logo-wrapper"> <a href="index.html"><img class="img-fluid for-light" src="assets/images/logo/logo_dark.png" alt="logo-light"><img class="img-fluid for-dark" src="assets/images/logo/logo.png" alt="logo-dark"></a></div>
      <div class="toggle-sidebar"> <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
      <div> <a class="toggle-sidebar" href="#"> <i class="iconly-Category icli"> </i></a>
        <div class="d-flex align-items-center gap-2 ">
          <h4 class="f-w-600">Welcome <?php echo ucwords($uname); ?></h4><img class="mt-0" src="assets/images/hand.gif" alt="hand-gif">
        </div>
      </div>
      <div class="welcome-content d-xl-block d-none"><span class="text-truncate col-12">Have a great day today! All the best for a fantastic day! </span></div>
    </div>
    <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
      <ul class="nav-menus"> 
        <li class="d-md-block d-none"> 
          <div class="form search-form mb-0">
            <div class="input-group"><span class="input-icon">
                <svg>
                  <use href="assets/svg/icon-sprite.svg#search-header"></use>
                </svg>
                <input class="w-100" type="search" placeholder="Search"></span></div>
          </div>
        </li>
        <li class="d-md-none d-block"> 
          <div class="form search-form mb-0">
            <div class="input-group"> <span class="input-show"> 
                <svg id="searchIcon">
                  <use href="assets/svg/icon-sprite.svg#search-header"></use>
                </svg>
                <div id="searchInput">
                  <input type="search" placeholder="Search">
                </div></span></div>
          </div>
        </li>
        
        <li> 
          <div class="mode"><i class="moon" data-feather="moon"> </i></div>
        </li>
        <li class="onhover-dropdown notification-down">
          <div class="notification-box"> 
            <svg> 
              <use href="assets/svg/icon-sprite.svg#notification-header"></use>
            </svg><span class="badge rounded-pill badge-secondary">4 </span>
          </div>
          <div class="onhover-show-div notification-dropdown"> 
            <div class="card mb-0"> 
              <div class="card-header">
                <div class="common-space"> 
                  <h4 class="text-start f-w-600">Notitications</h4>
                  <div><span>4 New</span></div>
                </div>
              </div>
              <div class="card-body">
                <div class="notitications-bar">
                  <div class="user-message"> 
                        <div class="cart-dropdown notification-all">
                          <ul>
                          <li>
                            <div class="user-alerts">
                              <div class="user-name">
                                <div> 
                                  <h6><a class="f-w-500 f-14" href="tour-package-unpaid-today">New Booking - <b>#JT310525001</b></a></h6><span class="f-light f-w-500 f-12">Tour Package at 04 Jun 2025</span>
                                </div>
                                <div> 
                                  <svg>
                                    <use href="assets/svg/icon-sprite.svg#more-vertical"></use>
                                  </svg>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="user-alerts">
                              <div class="user-name">
                                <div> 
                                  <h6><a class="f-w-500 f-14" href="boat-booking-unpaid-today">New Booking - <b>#JT310525002</b></a></a></h6><span class="f-light f-w-500 f-12">Boating Adventure at 04 Jun 2025</span>
                                </div>
                                <div> 
                                  <svg>
                                    <use href="assets/svg/icon-sprite.svg#more-vertical"></use>
                                  </svg>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="profile-nav onhover-dropdown"> 
          <div class="media profile-media"><img class="b-r-10" src="assets/images/dashboard/profile.png" alt="">
            <div class="media-body d-xxl-block d-none box-col-none">
              <div class="d-flex align-items-center gap-2"> <span><?php echo ucwords($uname); ?> </span><i class="middle fa fa-angle-down"> </i></div>
              <p class="mb-0 font-roboto"><?php echo ucwords($types); ?></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li><a href="#"><i data-feather="user"></i><span>My Profile</span></a></li>
            <li><a class="btn btn-pill btn-outline-primary btn-sm" href="logout">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
      </div>
</div>
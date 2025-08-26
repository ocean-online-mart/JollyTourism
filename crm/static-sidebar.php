<div class="sidebar-wrapper" data-layout="stroke-svg">
  <div class="logo-wrapper"><a href="dashboard"><img class="img-fluid" src="assets/images/logo/logo.png" alt=""></a>
    <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
  </div>
  <div class="logo-icon-wrapper"><a href="dashboard"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a></div>
  <nav class="sidebar-main">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div id="sidebar-menu">
      <ul class="sidebar-links" id="simple-bar">
        <li class="back-btn"><a href="dashboard"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a>
          <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
        </li>
        <li class="pin-title sidebar-main-title">
          <div> 
            <h6>Pinned</h6>
          </div>
        </li>
        <li class="sidebar-main-title">
          <div>
            <h6 >General</h6>
          </div>
        </li>
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="dashboard">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
            </svg>
           <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-home"></use>
            </svg><span>Dashboard</span></a></li>
        
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon"> 
              <use href="assets/svg/icon-sprite.svg#stroke-calendar"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-calendar"></use>
            </svg><span>Activity Date</span></a>
          <ul class="sidebar-submenu">
            <li><a href="activity_date_active">Active Date</a></li>
            <li><a href="activity_date_inactive">Inactive Date</a></li>
            <li><a href="activity_date_past">Past Date</a></li>
            <li><a href="add_activitydate">Add Activity Date</a></li>
          </ul>
        </li>
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-to-do"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-to-do"></use>
            </svg><span>Activity Slot</span></a>
          <ul class="sidebar-submenu">
            <li><a href="activity_slot_active">Active Slot</a></li>
            <li><a href="activity_slot_inactive">Inactive Slot</a></li>
            <li><a href="activity_slot_past">Past Slot</a></li>
          </ul>
        </li>
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="direct-booking">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-starter-kit"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-starter-kit"></use>
            </svg><span>Direct Booking</span></a>
        </li>
        <li class="sidebar-main-title">
          <div>
            <h6 >Paid Booking</h6>
          </div>
        </li>
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-ecommerce"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-ecommerce"></use>
            </svg><span>Boating Adventure</span></a>
          <ul class="sidebar-submenu">
            <li><a href="boat-booking-paid-today">Today Booking</a></li>
            <li><a href="boat-booking-paid-yesterday">Yesterday Booking</a></li>
            <li><a href="boat-booking-paid-month"><?php echo date('F'); ?> Booking</a></li>
            <li><a href="boat-booking-paid-all">Overall Booking</a></li>
          </ul>
        </li>
       
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-board"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-board"></use>
            </svg><span>Tour Package</span></a>
          <ul class="sidebar-submenu">
            <li><a href="tour-package-paid-today">Today Booking</a></li>
            <li><a href="tour-package-paid-yesterday">Yesterday Booking</a></li>
            <li><a href="tour-package-paid-month"><?php echo date('F'); ?> Booking</a></li>
            <li><a href="tour-package-paid-all">Overall Booking</a></li>
          </ul>
        </li>
        
        
        <li class="sidebar-main-title"> 
          <div>
            <h6>Unpaid Booking</h6>
          </div>
        </li>
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-faq"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-faq"></use>
            </svg><span>Boating Adventure</span></a>
          <ul class="sidebar-submenu">
            <li><a href="boat-booking-unpaid-today">Today Booking</a></li>
            <li><a href="boat-booking-unpaid-yesterday">Yesterday Booking</a></li>
            <li><a href="boat-booking-unpaid-month"><?php echo date('F'); ?> Booking</a></li>
            <li><a href="boat-booking-unpaid-all">Overall Booking</a></li>
          </ul>
        </li>
       
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-learning"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-learning"></use>
            </svg><span>Tour Package</span></a>
          <ul class="sidebar-submenu">
            <li><a href="tour-package-unpaid-today">Today Booking</a></li>
            <li><a href="tour-package-unpaid-yesterday">Yesterday Booking</a></li>
            <li><a href="tour-package-unpaid-month"><?php echo date('F'); ?> Booking</a></li>
            <li><a href="tour-package-unpaid-all">Overall Booking</a></li>
          </ul>
        </li>

        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-knowledgebase"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-knowledgebase"></use>
            </svg><span>Cancellation Request</span></a>
          <ul class="sidebar-submenu">
            <li><a href="cancel-request-today">Today Request</a></li>
            <li><a href="cancel-request-yesterday">Yesterday Request</a></li>
            <li><a href="cancel-request-monthly"><?php echo date('F'); ?> Request</a></li>
            <li><a href="cancel-request-oveall">Overall Request</a></li>
          </ul>
        </li>
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-social"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-social"></use>
            </svg><span>Refund</span></a>
          <ul class="sidebar-submenu">
            <li><a href="#">Today Refund</a></li>
            <li><a href="#"><?php echo date('F'); ?> Refund</a></li>
            <li><a href="#">Overall Refund</a></li>
          </ul>
        </li>
        <li class="sidebar-main-title">
          <div>
            <h6>Master Creation</h6>
          </div>
        </li>
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="main_category">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-starter-kit"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-starter-kit"></use>
            </svg><span>Main Category</span></a>
        </li>

        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="activity">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-job-search"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-job-search"></use>
            </svg><span>Activity</span></a>
        </li>

        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="hotel">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-blog"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-blog"></use>
            </svg><span>Hotel & Resorts</span></a>
        </li>

        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="offers_upload">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-others"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-others"></use>
            </svg><span>Offers</span></a>
        </li>

        <li class="sidebar-main-title">
          <div>
            <h6>Customers & Support</h6>
          </div>
        </li>
        <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon"> 
              <use href="assets/svg/icon-sprite.svg#stroke-user"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-user"></use>
            </svg><span>Customers</span></a>
          <ul class="sidebar-submenu">
            <li><a href="customer-today">Today Customers</a></li>
            <li><a href="customer-yesterday">Yesterday Customers</a></li>
            <li><a href="customer-month"><?php echo date('F'); ?> Customers</a></li>
            <li><a href="customer-overall">Overall Customers</a></li>
          </ul>
        </li>
        <li class="sidebar-list"> <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title" href="#">
            <svg class="stroke-icon"> 
              <use href="assets/svg/icon-sprite.svg#stroke-knowledgebase"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-knowledgebase"></use>
            </svg><span>Reservation</span></a>
          <ul class="sidebar-submenu">
            <li><a href="reservation-today">Today Reservation</a></li>
            <li><a href="reservation-yesterday">Yesterday Reservation</a></li>
            <li><a href="reservation-month"><?php echo date('F'); ?> Reservation</a></li>
            <li><a href="reservation-upcoming">Upcoming Reservation</a></li>
            <li><a href="reservation-past">Past Reservation</a></li>
          </ul>
        </li>

        <li class="sidebar-list"> <i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="#">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-search"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-search"></use>
            </svg><span>Search Filter</span></a></li>
        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="logout">
            <svg class="stroke-icon">
              <use href="assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
            </svg>
            <svg class="fill-icon">
              <use href="assets/svg/icon-sprite.svg#fill-support-tickets"></use>
            </svg><span>Logout</span></a></li>
      </ul>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
  </nav>
</div>
<?php
error_reporting(0);
include("store_db_con.php");
$conn = dbconnect();
?>

<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Jolly Tourism – Pondicherry’s Ultimate Boating Adventure</title>
      <meta name="author" content="Jolly Tourism">
      <meta name="description" content="Jolly Tourism - Discover the essence of sea adventure with Jolly Tourism, Pondicherry’s leading tourism company. For over six years, we have been curating exceptional tour packages that combine adventure, exploration, and relaxation, ensuring each experience is both innovative and memorable. ">
      <meta name="keywords" content="Jolly Tourism, Pondicherry tourism, Pondicherry tour packages, sea adventure Pondicherry, water sports Pondicherry, eco-tourism Pondicherry, beach house stay Pondicherry, villa rental Pondicherry, hut stay Pondicherry, Pondicherry resorts, comfort stay Pondicherry, tourism in Pondicherry, adventure tours Pondicherry, best tour operator Pondicherry, nature tours Pondicherry, sustainable tourism India, travel agency Pondicherry">
      <meta name="robots" content="INDEX,FOLLOW">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
      <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicons/favicon.png">
      <meta name="theme-color" content="#ffffff">
      <link rel="preconnect" href="https://fonts.googleapis.com/">
      <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
      <link rel="preconnect" href="https://fonts.googleapis.com/">
      <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;family=Manrope:wght@200..800&amp;family=Montez&amp;display=swap" rel="stylesheet">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assets/vendor/flatpickr/flatpickr.min.css">
      <link rel="stylesheet" href="assets/css/fontawesome.min.css">
      <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
      <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
      <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
      <?php include('header.php'); ?>
         <div class="about-area position-relative overflow-hidden overflow-hidden space" id="about-sec">
        <div class="container">
            <div class="row">
                <div class="col-xl-7"> 
                    <div class="img-box3">
                        <div class="img1"><img src="assets/img/gallery/1.jpg" alt="About"></div>
                        <!-- <div class="img2"><img src="assets/img/gallery/2.jpg" alt="About"></div>
                        <div class="img3 movingX"><img src="assets/img/gallery/3.jpg" alt="About"></div> -->
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="ps-xl-4">
                        <div class="title-area mb-20"><span class="sub-title style1">Welcome To Tourm</span>
                            <h2 class="sec-title mb-20 pe-xl-5 me-xl-5 heading">We are world reputeted travel agency
                            </h2>
                        </div>
                        <p class="pe-xl-5">Dive into adventure with Ocean Online Mart’s exclusive offers on private experiences in Pondicherry! Our curated deals bring you the best of coastal thrills at unbeatable prices. Whether it’s 
                            kayaking through serene mangroves, speeding across the waves, or 
                            unwinding at our luxurious resorts, we have the perfect package to make your trip unforgettable.</p>
                        <p class="mb-30 pe-xl-5">From exhilarating boating adventures and serene mangrove kayaking to relaxing resort getaways, 
                            our special offers are designed to make your moments in Pondicherry unforgettable. 
                            Perfect for families, couples, or groups, our curated experiences blend excitement and relaxation along the stunning shores of Puducherry. 
                            Check out our latest promotions and start planning your next adventure today!</p>
                        <div class="about-item-wrap">
                            <div class="about-item style2">
                                <div class="about-item_img"><img src="assets/img/icon/about_1_1.svg" alt=""></div>
                                <div class="about-item_centent">
                                    <h5 class="box-title">Exclusive Trip</h5>
                                    <p class="about-item_text">There are many variations of passages of available but
                                        the majority.</p>
                                </div>
                            </div>
                            <div class="about-item style2">
                                <div class="about-item_img"><img src="assets/img/icon/about_1_2.svg" alt=""></div>
                                <div class="about-item_centent">
                                    <h5 class="box-title">Safety First Always</h5>
                                    <p class="about-item_text">There are many variations of passages of available but
                                        the majority.</p>
                                </div>
                            </div>
                            <div class="about-item style2">
                                <div class="about-item_img"><img src="assets/img/icon/about_1_3.svg" alt=""></div>
                                <div class="about-item_centent">
                                    <h5 class="box-title">Professional Guide</h5>
                                    <p class="about-item_text">There are many variations of passages of available but
                                        the majority.</p>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="shape-mockup movingX d-none d-xxl-block" data-top="0%" data-left="-18%"><img
                    src="assets/img/shape/shape_2_1.png" alt="shape"></div>
            <div class="shape-mockup jump d-none d-xxl-block" data-top="28%" data-right="-15%"><img
                    src="assets/img/shape/shape_2_2.png" alt="shape"></div>
            <div class="shape-mockup spin d-none d-xxl-block" data-bottom="18%" data-left="-112%"><img
                    src="assets/img/shape/shape_2_3.png" alt="shape"></div>
            <div class="shape-mockup movixgX d-none d-xxl-block" data-bottom="18%" data-right="-12%"><img
                    src="assets/img/shape/shape_2_4.png" alt="shape"></div>
        </div>
    </div>
      <div class="overflow-hidden space" id="gallery-sec">
        <div class="container-fuild">
            <div class="title-area mb-30 text-center"><span class="sub-title">Explore Us</span>
                <h2 class="sec-title">Offers currelty in live</h2>
            </div>
            <div class="row gy-4 gallery-row4">
                    <?php
                        $offer_query = "SELECT image_url FROM offer_banners WHERE is_active = 1 ORDER BY banner_id DESC";
                        $mc_rec = mysqli_query($conn, $offer_query);
                            if (mysqli_num_rows($mc_rec) > 0) {
                                while ($mc_row = mysqli_fetch_object($mc_rec)) {
                                $img_path = $mc_row->image_url;
                            ?>
                            <div class="col-auto">
                                <div class="gallery-box style5">
                                    <div class="gallery-img global-img">
                                        <img src="crm/uploads/<?php echo htmlspecialchars($img_path); ?>" alt="gallery image">
                                        <a href="crm/uploads/<?php echo htmlspecialchars($img_path); ?>" class="icon-btn popup-image">
                                            <i class="fal fa-magnifying-glass-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        } else {
                            ` <div class="col-auto">
                                <p>No active banners found.</p>
                            </div>`;
                        }
                        ?>
              
            </div>
        </div>
    </div>
</body>
</html>
 <?php include('footer.php'); ?>
      
     <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/swiper-bundle.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/jquery.magnific-popup.min.js"></script>
      <script src="assets/js/jquery.counterup.min.js"></script>
      <script src="assets/js/jquery-ui.min.js"></script>
      <script src="assets/js/imagesloaded.pkgd.min.js"></script>
      <script src="assets/js/isotope.pkgd.min.js"></script>
      <script src="assets/js/gsap.min.js"></script>
      <script src="assets/js/circle-progress.js"></script>
      <script src="assets/js/matter.min.js"></script>
      <script src="assets/js/matterjs-custom.js"></script>
      <script src="assets/js/nice-select.min.js"></script>
      <script src="assets/js/main.js"></script>
      <script src="assets/vendor/flat-pickr/flatpickr.js"></script> 
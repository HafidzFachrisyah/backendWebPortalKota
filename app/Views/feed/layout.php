<?php
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $segment = explode('/', $actual_link); 

    if(count($segment)<6){
      $segment[5] = '';
    }
?>
<!--
=========================================================
* Soft UI Dashboard - v1.0.5
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="refresh" content="120">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url().SITE_URL ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= getSiteLogo() ?>">
  <title>
    <?= getSiteName() ?>
  </title>
  
  <script src="<?= base_url().SITE_URL ?>assets/js/jquery.min.js"></script>
  <!-- <script src="<?= base_url().SITE_URL ?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/core/bootstrap.min.js"></script>  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!--     Fonts and icons     -->
  <link href="<?= base_url().SITE_URL ?>assets/font/open-sans.css" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url().SITE_URL ?>assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url().SITE_URL ?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script type="text/javascript" src="<?= base_url().SITE_URL ?>assets/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/fontawesome.js" crossorigin="anonymous"></script>
  <link href="<?= base_url().SITE_URL ?>assets/css/fontawesome.css" rel="stylesheet" />
  <link href="<?= base_url().SITE_URL ?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Icon Picker -->
  <link rel="stylesheet" href="<?= base_url().SITE_URL ?>assets/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css" />
<script type="text/javascript" src="<?= base_url().SITE_URL ?>assets/bootstrap-iconpicker/js/bootstrap-iconpicker.js"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url().SITE_URL ?>assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />
   <!--toast-->
   <link rel="stylesheet" href="<?= base_url().SITE_URL ?>assets/css/jquery.toast.min.css">
   <!--sweet alert-->
   <link rel="stylesheet" href="<?= base_url().SITE_URL ?>assets/css/sweetalert2.min.css">
  <!-- Tiny MCE -->
  <script src="<?= base_url().SITE_URL ?>vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

  
 
</head>

<style>
  body {
    background-color:#cdd1cf;
    overflow: hidden;
  }
@media (max-width: 480px) { /* use the max to specify at each container level */
    .specifictd {    
        width:360px;  /* adjust to desired wrapping */
        display:table;
        white-space: pre-wrap; /* css-3 */
        white-space: -moz-pre-wrap; /* Mozilla, since 1999 */
        white-space: -pre-wrap; /* Opera 4-6 */
        white-space: -o-pre-wrap; /* Opera 7 */
        word-wrap: break-word; /* Internet Explorer 5.5+ */
    }
}
</style>

<body class="g-sidenav-show">
  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none position-sticky blur shadow-blur border-radius-xl mt-4 left-auto top-1 z-index-sticky" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
  
        <nav aria-label="breadcrumb">
          <a href="<?= getFrontEndUrl() ?>"><h6 class="font-weight-bolder mb-0"><img src="<?= getSiteLogo() ?>" class="w-6 me-2" alt="main_logo"> Portal Berita Kota Magelang</h6></a>
        </nav>
        
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-3">
      
    <?= $this->renderSection('content') ?>

      
      <footer class="footer pt-0">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                by
                <a href="http://diskominsta.magelangkota.go.id/" class="font-weight-bold" target="_blank">Diskominsta Kota Magelang</a>
              </div>
            </div>
           
          </div>
        </div>
      </footer>

    </div>
  </main>
  <!--   Core JS Files   -->
  
  <script src="<?= base_url().SITE_URL ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/plugins/chartjs.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/jquery.toast.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/sweetalert2.min.js"></script>

  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

 
  <!-- Github buttons -->
  <script src="<?= base_url().SITE_URL ?>assets/js/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url().SITE_URL ?>assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>
  

</body>

</html>

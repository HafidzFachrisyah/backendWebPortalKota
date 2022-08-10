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
<?php 
  $email = '';
  $password = ''; 
  if(session()->getFlashdata('inputs')){ 
    $inputs = session()->getFlashdata('inputs');
    $email =  $inputs['email'];
    $password =  $inputs['password']; 
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url().SITE_URL ?>assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= getSiteLogo() ?>">
  <title>
    <?= getSiteName() ?>
  </title>
  <!--     Fonts and icons     -->
  <link href="<?= base_url().SITE_URL ?>assets/font/open-sans.css" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url().SITE_URL ?>assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url().SITE_URL ?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="<?= base_url().SITE_URL ?>assets/js/fontawesome.js" crossorigin="anonymous"></script>
  <link href="<?= base_url().SITE_URL ?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url().SITE_URL ?>assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />
  <!--toast-->
  <link rel="stylesheet" href="<?= base_url().SITE_URL ?>assets/css/jquery.toast.min.css">
  <!-- google chapta -->
  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid pe-0">
            <img src="<?= getSiteLogo() ?>" class="d-none d-lg-block" width="3%"/>
            <img src="<?= getSiteLogo() ?>" class="d-none d-md-block d-lg-none" width="5%"/>
            <img src="<?= getSiteLogo() ?>" class="d-none d-sm-block d-md-none" width="7%"/>
            <img src="<?= getSiteLogo() ?>" class="d-block d-sm-none" width="9%"/>
            &nbsp;
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 d-none d-sm-block" href="<?= base_url().SITE_URL ?>pages/dashboard.html">
              LOGIN || <?= getSiteName() ?>
            </a>
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 d-block d-sm-none" href="<?= base_url().SITE_URL ?>pages/dashboard.html">
              LOGIN
            </a>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
               
               
               
              </ul>
              <li class="nav-item d-flex align-items-center">
                <a class="btn btn-round btn-sm mb-0 btn-outline me-2" target="_blank" href="<?= getFrontEndUrl() ?>">Goto Website</a>
              </li>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-custom">Selamat Datang</h3>
                  <p class="mb-0">Silahkan masukan e-mail dan password</p>
                </div>
                <div class="card-body">
                  <form role="form" action="auth" name="form_login" method="POST">
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" value="<?= $email ?>" required>
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" value="<?= $password ?>" required>
                    </div>
                    <div class="g-recaptcha" data-sitekey="<?= SITE_KEY ?>"></div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-custom text-white w-100 mt-4 mb-0">Log In</button>
                    </div>
                  </form>
                </div>
               
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('<?= base_url().SITE_URL ?>assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Diskominsta Kota Magelang.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="<?= base_url().SITE_URL ?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/jquery.min.js"></script>
  <script src="<?= base_url().SITE_URL ?>assets/js/jquery.toast.min.js"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

  </script>

  <?php  if(session()->getFlashdata('error')){ ?>
    <script>
         $.toast({
        heading: 'Gagal',
        text: '<?=session()->getFlashdata('error')?>',
        showHideTransition: 'fade',
        icon: 'error',
        hideAfter : false,
        showHideTransition: 'plain',
        position: 'top-left',
        })

    </script>
  <?php }  ?>
  <!-- Github buttons -->
  <script src="<?= base_url().SITE_URL ?>assets/js/buttons.js"></script>
   <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
   <script src="<?= base_url().SITE_URL ?>assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>
</body>

</html>
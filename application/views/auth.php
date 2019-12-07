<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Login | Standar</title>
  <link rel="apple-touch-icon" href="<?= base_url() ?>assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="<?= base_url() ?>assets/base/assets/images/favicon.ico">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/base/assets/css/site.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/base/assets/examples/css/pages/login-v3.css">
  <!-- Fonts -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/global/fonts/brand-icons/brand-icons.min.css">
  <!-- <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'> -->
  <!--[if lt IE 9]>
    <script src="<?= base_url() ?>assets/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="<?= base_url() ?>assets/global/vendor/media-match/media.match.min.js"></script>
    <script src="<?= base_url() ?>assets/global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="<?= base_url() ?>assets/global/vendor/breakpoints/breakpoints.js"></script>
  <script>
    Breakpoints();
  </script>
</head>

<body class="animsition page-login-v3 layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
      <div class="panel">
        <div class="panel-body">
          <div class="brand">
            <img class="brand-img" src="assets/logo/logostd.png" alt="..." width="25%" height="25%">
            <h2 class="brand-text">Sistem Informasi</h2>
            <h4 class="brand-text font-size-18">Standar Penerbangan dan Antariksa</h4>
          </div>
          <form method="post" action="<?= base_url('auth'); ?>">
            <?= $this->session->flashdata('message'); ?>
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="email" class="form-control" name="email" value="<?= set_value('email'); ?>" />
              <label class="floating-label">Email</label>
            </div>
            <div class="form-group form-material floating" data-plugin="formMaterial">
              <input type="password" class="form-control" name="password" />
              <label class="floating-label">Password</label>
            </div>
            <button type="submit" style="cursor:pointer;" class="btn btn-primary btn-block btn-lg mt-10">Sign in</button>
          </form>
          <p>Belum punya akun? Silahkan <a href="<?= base_url('auth/registrasi'); ?>">Registrasi</a></p>
          <p>Tidak bisa login? Klik <a href="<?= base_url('auth/forgot_password'); ?>">Lupa Password</a> </p>
        </div>
      </div>
      <footer class="page-copyright page-copyright-inverse">
        <?php $date = date('Y') ?>
        <p>©<?= $date; ?>. All RIGHT RESERVED.</p>
      </footer>
    </div>
  </div>
  <!-- End Page -->
  <!-- End Page -->
  <!-- Core  -->
  <script src="<?= base_url() ?>assets/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/jquery/jquery.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/tether/tether.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/bootstrap/bootstrap.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/animsition/animsition.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/asscrollable/jquery-asScrollable.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
  <!-- Plugins -->
  <script src="<?= base_url() ?>assets/global/vendor/switchery/switchery.min.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/intro-js/intro.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/screenfull/screenfull.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="<?= base_url() ?>assets/global/vendor/jquery-placeholder/jquery.placeholder.js"></script>
  <!-- Scripts -->
  <script src="<?= base_url() ?>assets/global/js/State.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Component.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Base.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Config.js"></script>
  <script src="<?= base_url() ?>assets/base/assets/js/Section/Menubar.js"></script>
  <script src="<?= base_url() ?>assets/base/assets/js/Section/GridMenu.js"></script>
  <script src="<?= base_url() ?>assets/base/assets/js/Section/Sidebar.js"></script>
  <script src="<?= base_url() ?>assets/base/assets/js/Section/PageAside.js"></script>
  <script src="<?= base_url() ?>assets/base/assets/js/Plugin/menu.js"></script>
  <script src="<?= base_url() ?>assets/global/js/config/colors.js"></script>
  <script src="<?= base_url() ?>assets/base/assets/js/config/tour.js"></script>
  <script>
    Config.set('assets', '<?= base_url() ?>assets');
  </script>
  <!-- Page -->
  <script src="<?= base_url() ?>assets/base/assets/js/Site.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin/asscrollable.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin/slidepanel.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin/switchery.js"></script>
  <script src="<?= base_url() ?>assets/global/js/Plugin/jquery-placeholder.js"></script>
  <script>
    (function(document, window, $) {
      'use strict';
      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);
  </script>
</body>

</html>
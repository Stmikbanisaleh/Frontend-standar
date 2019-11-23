<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">
    <title>Registrasi</title>
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
    <link rel="stylesheet" href="<?= base_url() ?>assets/base/assets/examples/css/pages/register-v3.css">
    <!-- Fonts -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
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

<body class="animsition page-register-v3 layout-full"></body>
<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
<!-- Page -->
<div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
        <div class="panel">
            <div class="panel-body">
                <div class="brand">
                    <img class="brand-img" src="<?= base_url() ?>assets/logo/logostd.png" width="25%" width="25%" alt="...">
                    <h2 class="brand-text font-size-18">Form Registrasi</h2>
                </div>
                <form method="post" action="<?= base_url('auth/registrasi'); ?>">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- One "tab" for each step in the form: -->
                            <?= $this->session->flashdata('message'); ?>
                            <div class="row mr-5">
                                No. KTP
                                <input type="text" class="form-control mb-15" name="no_ktp" id="no_ktp" placeholder="No KTP" value="<?= set_value('no_ktp'); ?>">
                                <small class="form-text text-danger"><?= form_error('no_ktp'); ?></small>
                            </div>
                            <div class="row mr-5">
                                Nama Lengkap
                                <input type="text" class="form-control mb-15" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?= set_value('nama_lengkap'); ?>">
                                <small class="form-text text-danger"><?= form_error('nama_lengkap'); ?></small>
                            </div>
                            <div class="row mr-5">
                                Email
                                <input type="text" class="form-control mb-15" name="email" id="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                <small class="form-text text-danger"><?= form_error('email'); ?></small>
                            </div>
                            <div class="row mr-5">
                                <div class="col-6">
                                    <div class="row">
                                        Password
                                        <input type="password" class="form-control mb-15 mr-10" name="password1" id="password1" placeholder="Password">
                                        <small class="form-text text-danger"><?= form_error('password1'); ?></small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        Konfirmasi Pasword
                                        <input type="password" class="form-control mb-15" name="password2" id="password2" placeholder="Password">

                                    </div>
                                </div>
                            </div>
                            <div class="row mr-5">
                                No. Handphone
                                <input type="text" class="form-control mb-15" name="no_handphone" id="no_handphone" placeholder="No Handphone/Telepon" value="<?= set_value('no_handphone'); ?>">
                                <small class="form-text text-danger"><?= form_error('no_handphone'); ?></small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row ml-5">
                                Fax
                                <input type="text" class="form-control mb-15" name="fax" id="fax" placeholder="Fax" value="<?= set_value('fax'); ?>">

                            </div>
                            <div class="row ml-5">
                                Stakeholder
                                <input type="text" class="form-control mb-15" name="stakeholder" id="stakeholder" placeholder="Stakeholder" value="<?= set_value('fax'); ?>">
                                <small class="form-text text-danger"><?= form_error('stakeholder'); ?></small>
                            </div>
                            <div class="row ml-5">
                                Alamat
                                <textarea class="form-control mb-15" name="alamat" id="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>"></textarea>
                                <small class="form-text text-danger"><?= form_error('alamat'); ?></small>
                            </div>
                            <div class="row ml-5">
                                Provinsi
                                <select id="id_provinsi" class="form-control mb-15" name="id_provinsi" value="<?= set_value('id_provinsi'); ?>">
                                    <option value="">Pilih Provinsi</option>
                                    <?php foreach ($provinsi as $prov) { ?>
                                        <option value="<?= $prov['id_prov']; ?>"><?= $prov['nama']; ?></option>
                                    <?php } ?>
                                </select>
                                <small class="form-text text-danger"><?= form_error('id_provinsi'); ?></small>
                            </div>
                            <div class="row ml-5">
                                Kota/Kabupaten
                                <select id="id_kota" class="form-control mb-15" name="id_kota" value="<?= set_value('id_kota'); ?>">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                    <?php foreach ($kota as $kt) { ?>
                                        <option value="<?= $kt['id_kota']; ?>" data-chained="<?= $kt['id_prov']; ?>"><?= $kt['nama']; ?></option>
                                    <?php } ?>
                                </select>
                                <small class="form-text text-danger"><?= form_error('id_kota'); ?></small>
                            </div>
                        </div>
                    </div>

                    <button style="cursor:pointer;" type="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign up</button>
                </form>
                <p>Sudah punya akun? Silahkan <a href="<?= base_url('auth'); ?>">Login!</a></p>
            </div>
        </div>
        <footer class="page-copyright page-copyright-inverse">
            <?php $date = date('Y'); ?>
            <p>© <?= $date; ?>. All RIGHT RESERVED.</p>
        </footer>
    </div>
</div>
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
<script src="<?= base_url() ?>assets/global/js/jquery.chained.min.js"></script>
<script src="<?= base_url() ?>assets/global/js/jquery.chained.remote.min.js"></script>
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
<script src="<?= base_url() ?>assets/global/js/Plugin/material.js"></script>
<script>
    (function(document, window, $) {
        'use strict';
        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);
</script>
<script>
    $("#id_kota").chained("#id_provinsi");
</script>
</body>

</html>
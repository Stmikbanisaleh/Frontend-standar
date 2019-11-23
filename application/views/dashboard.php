<div class="page">
    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">General</li>
        </div>
        <div class="panel">
            <div class="panel-body">
                <div class="row row-lg">
                    <div class="col-lg">
                        <div class="row">
                            <div class="col-lg-3">
                                <!-- Card -->
                                <div class="card card-block p-10 bg-blue-600">
                                    <div class="card-watermark darker font-size-70 m-15"><i class="icon wb-clipboard" aria-hidden="true"></i></div>
                                    <div class="counter counter-md counter-inverse text-left">
                                        <div class="counter-number-group">
                                            <span class="counter-number"><?= $jumlahUsulan; ?></span>
                                        </div>
                                        <h4><a class="text-white" href="<?= base_url() ?>pengajuan/usulan_baru">Usulan Standar</a></h4>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <div class="col-lg-3">
                                <!-- Card -->
                                <div class="card card-block p-10 bg-yellow-600">
                                    <div class="card-watermark darker font-size-70 m-15"><i class="icon wb-clipboard" aria-hidden="true"></i></div>
                                    <div class="counter counter-md counter-inverse text-left">
                                        <div class="counter-number-group">
                                            <span class="counter-number">0</span>
                                        </div>
                                        <h4 class="text-white">PNPS</h4>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <div class="col-lg-3">
                                <!-- Card -->
                                <div class="card card-block p-10 bg-green-600">
                                    <div class="card-watermark darker font-size-70 m-15"><i class="icon wb-clipboard" aria-hidden="true"></i></div>
                                    <div class="counter counter-md counter-inverse text-left">
                                        <div class="counter-number-group">
                                            <span class="counter-number"><?= $jumlahSL; ?></span>
                                        </div>
                                        <h4><a class="text-white" href="<?= base_url() ?>perumusan/daftar_SL">SL</a></h4>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                            <div class="col-lg-3">
                                <!-- Card -->
                                <div class="card card-block p-10 bg-red-600">
                                    <div class="card-watermark darker font-size-70 m-15"><i class="icon wb-clipboard" aria-hidden="true"></i></div>
                                    <div class="counter counter-md counter-inverse text-left">
                                        <div class="counter-number-group">
                                            <span class="counter-number"><?= $jumlahSNI; ?></span>
                                        </div>
                                        <h4><a class="text-white" href="<?= base_url() ?>perumusan/daftar_sni">SNI</a></h4>
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Daftar Perumusan Aktif Standar RSNI
                </h4>
            </div>
            <div class="panel-body container-fluid my-10">
                <div class="row row-lg">
                    <div class="col-lg">
                        <div class="panel">
                            <div class="table-responsive">
                                <table id="mytable" class="table dataTable table-bordered table-striped w-full" data-plugin="dataTable">
                                    <thead>
                                        <tr class="table-info">
                                            <th>No.</th>
                                            <th>Kode PNPS</th>
                                            <th>Judul PNPS</th>
                                            <th>Nama Komtek</th>
                                            <th>Jenis Perumusan</th>
                                            <th width="29%">Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($rsni as $rsn) { ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $rsn['KODE']; ?></td>
                                                <td><?= $rsn['JUDUL']; ?></td>
                                                <td><?= $rsn['KOMTEK']; ?></td>
                                                <td><?= $rsn['JENIS_PERUMUSAN']; ?></td>
                                                <td>
                                                    <?php if ($rsn['PROSES_PERUMUSAN'] >= 80) { ?>
                                                        <span class="text-left">
                                                            <h4>
                                                                <a class="btn btn-xs btn-primary" href="#">
                                                                    Usulan
                                                                </a>
                                                                <a class="btn btn-xs btn-success" href="<?= base_url('perumusan/rsni1'); ?>">
                                                                    RSNI 1
                                                                </a>
                                                                <?php if ($rsn['PROSES_PERUMUSAN'] >= 81) { ?>
                                                                    <a class="btn btn-xs btn-success" href="<?= base_url('perumusan/rsni2'); ?>">
                                                                        RSNI 2
                                                                    </a>
                                                                    <?php if ($rsn['PROSES_PERUMUSAN'] >= 83) { ?>
                                                                        <a class="btn btn-xs btn-success" href="<?= base_url('perumusan/rsni3'); ?>">
                                                                            RSNI 3
                                                                        </a>
                                                            </h4>
                                                        </span>
                                                        <span class="text-left">
                                                            <h4>
                                                                <?php if ($rsn['PROSES_PERUMUSAN'] >= 84) { ?>
                                                                    <a class="btn btn-xs btn-success" href="<?= base_url('perumusan/jajak_pendapat'); ?>">
                                                                        JP
                                                                    </a>
                                                                    <?php if ($rsn['PROSES_PERUMUSAN'] >= 86) { ?>
                                                                        <a class="btn btn-xs btn-success" href="#">
                                                                            RSNI 4
                                                                        </a>
                                                                        <?php if ($rsn['PROSES_PERUMUSAN'] >= 88) { ?>
                                                                            <a class="btn btn-xs btn-success" href="#">
                                                                                RASNI
                                                                            </a>
                                                                            <?php if ($rsn['PROSES_PERUMUSAN'] >= 89) { ?>
                                                                                <a class="btn btn-xs btn-success" href="#">
                                                                                    SNI
                                                                                </a>
                                                            </h4>
                                                        </span>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Daftar Perumusan Aktif Standar RSL
                </h4>
            </div>
            <div class="panel-body container-fluid my-10">
                <div class="row row-lg">
                    <div class="col-lg">
                        <div class="table-responsive">
                            <table id="mytable" class="table dataTable table-bordered table-striped w-full" data-plugin="dataTable">
                                <thead>
                                    <tr class="table-info">
                                        <th>No.</th>
                                        <th>Kode PPSL</th>
                                        <th>Judul PPSL</th>
                                        <th>Nama Komtek</th>
                                        <th>Jenis Perumusan</th>
                                        <th width="29%">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($rsl as $rs) { ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $rs['KODE']; ?></td>
                                            <td><?= $rs['JENIS_PERUMUSAN']; ?></td>
                                            <td><?= $rs['KOMTEK']; ?></td>
                                            <td><?= $rs['JUDUL']; ?></td>
                                            <td>
                                                <?php if ($rs['PROSES_PERUMUSAN'] >= 90) { ?>
                                                    <span class="text-left">
                                                        <h4>
                                                            <a class="btn btn-xs btn-primary" href="#">
                                                                Usulan
                                                            </a>
                                                            <a class="btn btn-xs btn-success" href="<?= base_url('perumusan/rsl1'); ?>">
                                                                RSL 1
                                                            </a>
                                                            <?php if ($rs['PROSES_PERUMUSAN'] >= 91) { ?>
                                                                <a class="btn btn-xs btn-success" href="<?= base_url('perumusan/rsl2'); ?>">
                                                                    RSL 2
                                                                </a>
                                                        </h4>
                                                    </span>
                                                    <span class="text-left">
                                                        <h4>
                                                            <?php if ($rs['PROSES_PERUMUSAN'] >= 93) { ?>
                                                                <a class="btn btn-xs btn-success" href="<?= base_url('perumusan/rsl3'); ?>">
                                                                    RSL 3
                                                                </a>
                                                                <?php if ($rs['PROSES_PERUMUSAN'] >= 94) { ?>
                                                                    <a class="btn btn-xs btn-success" href="#">
                                                                        Penetapan SL
                                                                    </a>
                                                                    <?php if ($rs['PROSES_PERUMUSAN'] >= 95) { ?>
                                                                        <a class="btn btn-xs btn-success" href="#">
                                                                            SL
                                                                        </a>
                                                        </h4>
                                                    </span>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
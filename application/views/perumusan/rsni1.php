<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">Perumusan</li>
                <li class="breadcrumb-item active">RSNI 1</li>
                <li class="breadcrumb-item active">Daftar RSNI 1</li>
            </ol>
        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Daftar Perumusan RSNI 1
                </h4>
            </div>
            <div class="panel-body container-fluid my-10">
                <div class="row row-lg">
                    <div class="col-xl">
                        <div class="panel">
                            <div class="table-responsive">
                                <table id="mytable" class="table dataTable table-bordered table-striped w-full" data-plugin="dataTable">
                                    <thead>
                                        <tr class="table-info">
                                            <th>No.</th>
                                            <th>Tanggal</th>
                                            <th>Kode PNPS</th>
                                            <th>Jenis Perumusan</th>
                                            <th>Judul</th>
                                            <th>Mendesak</th>
                                            <th>Tahapan</th>
                                            <th>Status</th>
                                            <th class="text-nowrap">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($rsni1 as $r1) { ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= date('d-m-Y', strtotime($r1['TGL_INPUT'])); ?></td>
                                                <td><?= $r1['KODE']; ?></td>
                                                <td><?= $r1['JENIS_PERUMUSAN']; ?></td>
                                                <td><?= $r1['JUDUL']; ?></td>
                                                <td><?php echo ($r1['KEB_MENDESAK'] == 1) ? "Ya" : "Tidak"; ?></td>
                                                <td><?= $r1['TAHAPAN']; ?></td>
                                                <td>Menunggu Perumusan</td>
                                                <td><a href="<?= base_url() ?>perumusan/detail/<?= $r1['ID']; ?>" class="btn btn-xs btn-info" value="<?= $r1['ID'] ?>;"><i class="fa fa-file-text-o"></i></a></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9">
                                                <div class="text-right">
                                                    <span class="badge badge-round badge-info text-right">
                                                        <li class="fa fa-file-text-o"></li> Lihat Detail
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Panel Tabs -->
    </div>
</div>
</div>
</div>
</div>
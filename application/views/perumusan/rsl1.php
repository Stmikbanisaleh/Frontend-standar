<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">Perumusan</li>
                <li class="breadcrumb-item active">RSL 1</li>
                <li class="breadcrumb-item active">Daftar RSL 1</li>
            </ol>
        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Daftar Perumusan RSL 1
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
                                        <?php foreach ($rsl1 as $r1) { ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= date('d-m-Y', strtotime($r1['tgl_input'])); ?></td>
                                                <td><?= $r1['kode']; ?></td>
                                                <td><?= $r1['jenis_perumusan']; ?></td>
                                                <td><?= $r1['judul']; ?></td>
                                                <td><?php echo ($r1['keb_mendesak'] == 1) ? "Ya" : "Tidak"; ?></td>
                                                <td><?= $r1['tahapan']; ?></td>
                                                <td>Menunggu Perumusan</td>
                                                <td><a href="<?= base_url() ?>perumusan/detail/<?= $r1['id']; ?>" class="btn btn-xs btn-info" value="<?= $r1['id'] ?>;"><i class="fa fa-file-text-o"></i></a></td>
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
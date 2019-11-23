<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">Pembatalan</li>
                <li class="breadcrumb-item active">Pembatalan Usulan</li>
            </ol>
        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Daftar Usulan/Perumusan yang dibatalkan
                </h4>
            </div>
            <div class="panel-body container-fluid my-10">
                <div class="row row-lg">
                    <div class="col-xl">
                        <div class="panel">
                            <a href="<?= base_url('pembatalan/add'); ?>" class="btn btn-info my-10">
                                <i class="fa fa-plus"> Input</i>
                            </a>
                            <div class="table-responsive">
                                <table id="mytable" class="table dataTable table-bordered table-striped w-full" data-plugin="dataTable">
                                    <thead>
                                        <tr class="table-info">
                                            <th>No.</th>
                                            <th>Kode PNPS</th>
                                            <th>Judul PNPS</th>
                                            <th>Jenis Perumusan</th>
                                            <th>Tahapan</th>
                                            <th>Alasan Pembatalan</th>
                                            <th class="text-nowrap">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($ditolak as $dtl) { ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td></td>
                                                <td><?= $dtl['JUDUL']; ?></td>
                                                <td><?= $dtl['JENIS_PERUMUSAN']; ?></td>
                                                <td><?= $dtl['TAHAPAN']; ?></td>
                                                <td><?= $dtl['ALASAN_PENOLAKAN']; ?></td>
                                                <td></td>

                                            </tr>
                                            <?php $i++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
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
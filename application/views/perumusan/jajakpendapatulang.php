<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">Perumusan</li>
                <li class="breadcrumb-item active">Jajak Pendapat Ulang</li>
                <li class="breadcrumb-item active">Daftar Jajak Pendapat Ulang</li>
            </ol>
        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Daftar Perumusan Jajak Pendapat Ulang
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
                                        <?php foreach ($jpendapatulang as $jp) { ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= date('d-m-Y', strtotime($jp['tgl_input'])); ?></td>
                                                <td><?= $jp['kode']; ?></td>
                                                <td><?= $jp['jenis_perumusan']; ?></td>
                                                <td><?= $jp['judul']; ?></td>
                                                <td><?php echo ($jp['keb_mendesak'] == 1) ? "Ya" : "Tidak"; ?></td>
                                                <td><?= $jp['tahapan']; ?></td>
                                                <td></td>
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
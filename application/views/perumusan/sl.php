<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">SL</li>
                <li class="breadcrumb-item active">Daftar SL</li>
            </ol>
        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Daftar SL
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($daftarsl as $sl) { ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $sl['KODE']; ?></td>
                                            <td><?= $sl['KOMTEK']; ?></td>
                                            <td><?= $sl['JUDUL']; ?></td>
                                            <td><a href="<?= base_url() ?>perumusan/detail/<?= $sl['ID']; ?>" class="btn btn-xs btn-info" value="<?= $sl['ID'] ?>;"><i class="fa fa-file-text-o"></i></a></td>
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
</div>
<!-- End Example Tabs Line Top -->
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
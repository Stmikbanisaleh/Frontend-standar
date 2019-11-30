<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">SNI</li>
                <li class="breadcrumb-item active">Daftar SNI</li>
            </ol>
        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Daftar SNI
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($daftarsni as $sni) { ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $sni['kode']; ?></td>
                                                <td><?= $sni['judul']; ?></td>
                                                <td><?= $sni['komtek']; ?></td>
                                                <td><a href="<?= base_url() ?>perumusan/detail/<?= $sni['id']; ?>" class="btn btn-xs btn-info" value="<?= $sni['id'] ?>;"><i class="fa fa-file-text-o"></i></a></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <!-- <td colspan="9"> -->
                                                <div class="text-right">
                                                    <span class="badge badge-round badge-info text-right">
                                                        <li class="fa fa-file-text-o"></li> Lihat Detail
                                                    </span>
                                                </div>
                                            <!-- </td> -->
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
<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">Detail Standar</li>
            </ol>
        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Detail Standar
                </h4>
            </div>
            <div class="panel-body container-fluid my-10">
                <div class="row row-lg">
                    <div class="col-xl">
                        <div class="panel">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Kode</td>
                                        <td><?= $detail['kode']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Komite Teknis</td>
                                        <td><?= $detail['komtek']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Judul</td>
                                        <td><?= $detail['judul']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ruang Lingkup</td>
                                        <td><?= $detail['ruang_lingkup']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Perumusan</td>
                                        <td><?= $detail['jenis_perumusan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jalur Perumusan</td>
                                        <td><?= $detail['jalur_perumusan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Detail Penelitian</td>
                                        <td><?= $detail['detail_penelitian']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Lampiran Detail Penelitian</td>
                                        <td>
                                            <?php if ($detail['dok_detail_penelitian']) { ?>
                                                <a class="btn btn-sm btn-success" href="<?= URL_API_DOWNLOAD.$detail['dok_detail_penelitian']; ?>" target="_blank"><i class="fa fa-download"> Download</i></a>
                                            <?php } else { ?>
                                                <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                            <?php } ?>
                                        </td>
                                    </tr>

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
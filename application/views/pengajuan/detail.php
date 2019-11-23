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
                                        <td><?= $detail['KODE']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Komite Teknis</td>
                                        <td><?= $detail['KOMTEK']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Judul</td>
                                        <td><?= $detail['JUDUL']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ruang Lingkup</td>
                                        <td><?= $detail['RUANG_LINGKUP']; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Detail Penelitian</td>
                                        <td><?= $detail['DETAIL_PENELITIAN']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Lampiran Detail Penelitian</td>
                                        <td>
                                            <?php if ($detail['DOK_DETAIL_PENELITIAN']) { ?>
                                                <a class="btn btn-sm btn-success" href="<?= base_url() ?>assets/dokumen/detail_penelitian/<?= $detail['DOK_DETAIL_PENELITIAN']; ?>" target="_blank"><i class="fa fa-download"> Download</i></a>
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
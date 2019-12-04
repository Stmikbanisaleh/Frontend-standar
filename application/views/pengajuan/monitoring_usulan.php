<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">Pengajuan</li>
                <li class="breadcrumb-item active">Usulan Baru</li>
                <li class="breadcrumb-item active">Daftar Usulan Baru</li>
            </ol>
        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Daftar Data Pengajuan Usulan
                </h4>
            </div>
            <div class="panel-body container-fluid my-10">
                <div class="row row-lg">
                    <div class="col-xl">
                        <!-- Example Tabs Line Top -->
                        <div class="example-wrap">
                            <div class="nav-tabs-horizontal" data-plugin="tabs">
                                <ul class="nav nav-tabs nav-tabs-line tabs-line-top" role="tablist">
                                    <li class="nav-item " role="presentation"><a class="nav-link active" data-toggle="tab" href="#TabsDiajukan" aria-controls="TabsDiajukan" role="tab">Usulan Diajukan</a></li>
                                    <li class="nav-item " role="presentation"><a class="nav-link" data-toggle="tab" href="#TabsDitolak" aria-controls="TabsDitolak" role="tab">Usulan Ditolak</a></li>
                                    <li class="nav-item " role="presentation"><a class="nav-link" data-toggle="tab" href="#TabsDiterima" aria-controls="TabsDiterima" role="tab">Usulan Diterima</a></li>
                                </ul>
                                <div class="tab-content pt-20">
                                    <?= $this->session->flashdata('message'); ?>

                                    <div class="tab-pane active" id="TabsDiajukan" role="tabpanel">
                                        <div class="panel">
                                            <div class="table-responsive">
                                                <table id="mytable" class="table dataTable table-bordered table-striped w-full" data-plugin="dataTable">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th>No.</th>
                                                            <th>Tanggal Usulan</th>
                                                            <th>Jenis Perumusan</th>
                                                            <th>Komtek</th>
                                                            <th>Judul</th>
                                                            <th>Tahapan</th>
                                                            <th>Status</th>
                                                            <th class="text-nowrap">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($diajukan as $d2) { ?>
                                                            <tr>
                                                                <td><?= $i; ?></td>
                                                                <td><?= date('d-m-Y', strtotime($d2['tgl_input'])); ?></td>
                                                                <td><?= $d2['jenis_perumusan']; ?></td>
                                                                <td><?= $d2['komtek']; ?></td>
                                                                <td><?= $d2['judul']; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="<?= base_url() ?>pengajuan/proses_usulan/<?= $d2['id']; ?>" class="btn btn-xs btn-primary" value="<?= $d2['id'] ?>;"><i class="fa fa-pencil"></i></a>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="8">
                                                                <div class="text-right">
                                                                    <h4><span class="badge badge-round badge-primary text-right">
                                                                            <li class="fa fa-pencil"></li> Proses
                                                                        </span>
                                                                    </h4>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="TabsDitolak" role="tabpanel">
                                        <div class="panel">
                                            <div class="table-responsive">
                                                <table id="mytable" class="table dataTable table-bordered table-striped w-full" data-plugin="dataTable">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th>No.</th>
                                                            <th>Tanggal Usulan</th>
                                                            <th>Jenis Perumusan</th>
                                                            <th>Komtek</th>
                                                            <th>Judul</th>
                                                            <th>Alasan Penolakan</th>
                                                            <th class="text-nowrap">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($ditolak as $d3) { ?>
                                                            <tr>
                                                                <td><?= $i; ?></td>
                                                                <td><?= date('d-m-Y', strtotime($d3['tgl_input'])); ?></td>
                                                                <td><?= $d3['jenis_perumusan']; ?></td>
                                                                <td><?= $d3['komtek']; ?></td>
                                                                <td><?= $d3['judul']; ?></td>
                                                                <td><?= $d3['alasan_penolakan']; ?></td>
                                                                <td>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="TabsDiterima" role="tabpanel">
                                        <div class="panel">
                                            <div class="table-responsive">
                                                <table id="mytable" class="table dataTable table-bordered table-striped w-full" data-plugin="dataTable">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th>No.</th>
                                                            <th>Tanggal Usulan</th>
                                                            <th>Jenis Perumusan</th>
                                                            <th>Komtek</th>
                                                            <th>Judul</th>
                                                            <th>Tahapan</th>
                                                            <th>Status</th>
                                                            <th class="text-nowrap">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($diterima as $d4) { ?>
                                                            <tr>
                                                                <td><?= $i; ?></td>
                                                                <td><?= date('d-m-Y', strtotime($d4['tgl_input'])); ?></td>
                                                                <td><?= $d4['jenis_perumusan']; ?></td>
                                                                <td><?= $d4['komtek']; ?></td>
                                                                <td><?= $d4['judul']; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="<?= base_url() ?>pengajuan/proses_usulan/<?= $d4['id']; ?>" class="btn btn-xs btn-primary" value="<?= $d4['id'] ?>;"><i class="fa fa-pencil"></i></a>
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
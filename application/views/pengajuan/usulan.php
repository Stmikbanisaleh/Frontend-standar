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
                                    <li class="nav-item " role="presentation"><a class="nav-link active" data-toggle="tab" href="#TabsDraft" aria-controls="TabsDraft" role="tab">Draft</a></li>
                                    <li class="nav-item " role="presentation"><a class="nav-link" data-toggle="tab" href="#TabsDiajukan" aria-controls="TabsDiajukan" role="tab">Diajukan</a></li>
                                    <li class="nav-item " role="presentation"><a class="nav-link" data-toggle="tab" href="#TabsDitolak" aria-controls="TabsDitolak" role="tab">Ditolak</a></li>
                                    <li class="nav-item " role="presentation"><a class="nav-link" data-toggle="tab" href="#TabsDiterima" aria-controls="TabsDiterima" role="tab">Diterima</a></li>
                                </ul>
                                <div class="tab-content pt-20">
                                    <div class="tab-pane active" id="TabsDraft" role="tabpanel">
                                        <div class="panel">
                                            <?= $this->session->flashdata('message1'); ?>
                                            <?= $this->session->flashdata('message2'); ?>
                                            <?= $this->session->flashdata('message3'); ?>
                                            <?= $this->session->flashdata('message4'); ?>
                                            <a href="<?= base_url('pengajuan/pengajuan_usulan'); ?>" class="btn btn-info my-10">
                                                <i class="fa fa-plus"> Input</i>
                                            </a>

                                            <div class="table-responsive">
                                                <table id="table-draft" class="table dataTable table-bordered table-striped w-full" data-plugin="dataTable">
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
                                                        <?php foreach ($draft as $d1) { ?>
                                                            <tr>
                                                                <td>1</td>
                                                                <td><?= date('d-m-Y', strtotime($d1['TGL_INPUT'])); ?></td>
                                                                <td><?= $d1['JENIS_PERUMUSAN']; ?></td>
                                                                <td><?= $d1['KOMTEK']; ?></td>
                                                                <td><?= $d1['JUDUL']; ?></td>
                                                                <td><?= $d1['TAHAPAN']; ?></td>
                                                                <td>
                                                                    Menunggu Pengesahan
                                                                </td>
                                                                <td>
                                                                    <a href="<?= base_url() ?>pengajuan/detail/<?= $d1['ID']; ?>" class="btn btn-xs btn-success" value="<?= $d1['ID'] ?>;"><i class="fa fa-file-text-o"></i></a>
                                                                    <a href="<?= base_url() ?>pengajuan/edit_usulan/<?= $d1['ID']; ?>" class="btn btn-xs btn-warning" value="<?= $d1['ID'] ?>;"><i class="fa fa-pencil"></i></a>
                                                                    <a href="<?= base_url() ?>pengajuan/ajukan/<?= $d1['ID']; ?>" class="btn btn-xs btn-info" value="<?= $d1['ID'] ?>;" onclick="return confirm('Anda yakin ingin mengajukan usulan?');"><i class="fa fa-send"></i></a>
                                                                    <a href="<?= base_url() ?>pengajuan/hapus_usulan/<?= $d1['ID']; ?>" class="btn btn-xs  btn-danger" value="<?= $d1['ID'] ?>;" onclick="return confirm('Anda yakin ingin menghapus usulan?');"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="8">
                                                                <div class="text-right">
                                                                    <span class="badge badge-round badge-success text-right">
                                                                        <li class="fa fa-file-text-o"></li> Detail
                                                                    </span>
                                                                    <span class="badge badge-round badge-warning text-right">
                                                                        <li class="fa fa-pencil"></li> Edit
                                                                    </span>
                                                                    <span class="badge badge-round badge-primary text-right">
                                                                        <li class="fa fa-send"></li> Ajukan
                                                                    </span>
                                                                    <span class="badge badge-round badge-danger text-right">
                                                                        <li class="fa fa-trash"></li> Hapus
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="TabsDiajukan" role="tabpanel">
                                        <div class="panel">
                                            <div class="table-responsive">
                                                <table id="table-diajukan" class="table dataTable table-bordered table-striped w-full" data-plugin="dataTable">
                                                    <thead>
                                                        <tr class="table-info">
                                                            <th>No.</th>
                                                            <th>Tanggal Usulan</th>
                                                            <th>Jenis Perumusan</th>
                                                            <th>Komtek</th>
                                                            <th>Judul</th>
                                                            <th>Status</th>
                                                            <th class="text-nowrap">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($diajukan as $d2) { ?>
                                                            <tr>
                                                                <td><?= $i; ?></td>
                                                                <td><?= date('d-m-Y', strtotime($d2['TGL_INPUT'])); ?></td>
                                                                <td><?= $d2['JENIS_PERUMUSAN']; ?></td>
                                                                <td><?= $d2['KOMTEK']; ?></td>
                                                                <td><?= $d2['JUDUL']; ?></td>
                                                                <td><?= $d2['TAHAPAN']; ?></td>
                                                                <td>
                                                                    <a href="<?= base_url() ?>pengajuan/detail/<?= $d2['ID']; ?>" class="btn btn-xs btn-success" value="<?= $d2['ID'] ?>;"><i class="fa fa-file-text-o"></i></a>
                                                                    <?php if ($d2['JENIS_STANDAR'] == 48) { ?>
                                                                        <a href="<?= base_url() ?>pengajuan/perbaikan_usulan_rsni/<?= $d2['ID']; ?>" class="btn btn-xs btn-warning" value="<?= $d2['ID'] ?>;"><i class="fa fa-pencil"></i></a>
                                                                    <?php } else { ?>
                                                                        <a href="<?= base_url() ?>pengajuan/perbaikan_usulan_rsl/<?= $d2['ID']; ?>" class="btn btn-xs btn-warning" value="<?= $d2['ID'] ?>;"><i class="fa fa-pencil"></i></a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="7">
                                                                <div class="text-right">
                                                                    <span class="badge badge-round badge-success text-right">
                                                                        <li class="fa fa-file-text-o"></li> Detail
                                                                    </span>
                                                                    <span class="badge badge-round badge-warning text-right">
                                                                        <li class="fa fa-pencil"></li> Perbaikan
                                                                    </span>
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
                                                                <td><?= date('d-m-Y', strtotime($d3['TGL_INPUT'])); ?></td>
                                                                <td><?= $d3['JENIS_PERUMUSAN']; ?></td>
                                                                <td><?= $d3['KOMTEK']; ?></td>
                                                                <td><?= $d3['JUDUL']; ?></td>
                                                                <td><?= $d3['ALASAN_PENOLAKAN']; ?></td>
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
                                                                <td><?= date('d-m-Y', strtotime($d4['TGL_INPUT'])); ?></td>
                                                                <td><?= $d4['JENIS_PERUMUSAN']; ?></td>
                                                                <td><?= $d4['KOMTEK']; ?></td>
                                                                <td><?= $d4['JUDUL']; ?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <a href="<?= base_url() ?>pengajuan/detail/<?= $d4['ID']; ?>" class="btn btn-xs btn-success" value="<?= $d4['ID'] ?>;"><i class="fa fa-file-text-o"></i></a>
                                                                    <?php if ($d4['JENIS_STANDAR'] == 48) { ?>
                                                                        <a href="<?= base_url() ?>pengajuan/perbaikan_usulan_rsni/<?= $d4['ID']; ?>" class="btn btn-xs btn-warning" value="<?= $d4['ID'] ?>;"><i class="fa fa-pencil"></i></a>
                                                                    <?php } else { ?>
                                                                        <a href="<?= base_url() ?>pengajuan/perbaikan_usulan_rsl/<?= $d4['ID']; ?>" class="btn btn-xs btn-warning" value="<?= $d4['ID'] ?>;"><i class="fa fa-pencil"></i></a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="8">
                                                                <div class="text-right">
                                                                    <span class="badge badge-round badge-success text-right">
                                                                        <li class="fa fa-file-text-o"></li> Detail
                                                                    </span>
                                                                    <span class="badge badge-round badge-warning text-right">
                                                                        <li class="fa fa-pencil"></li> Perbaikan
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
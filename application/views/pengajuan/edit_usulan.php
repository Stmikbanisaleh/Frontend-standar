<style>
    body {
        background-color: #f1f1f1;
    }

    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
        font-family: Raleway;
        border: 1px solid #aaaaaa;
    }

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
        background-color: #ffdddd;
    }

    /* Mark input boxes that gets an error on validation: */
    .inputfield.invalid {
        background-color: #ffdddd;
    }

    .textempty {
        background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
        display: none;
    }


    button:hover {
        opacity: 0.8;
    }
</style>


<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">Pengajuan</li>
                <li class="breadcrumb-item active">Pengajuan Usulan</li>
                <div class="text-right">
                    Role User : <b>Pengusul</b>
                </div>
            </ol>

        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Pengajuan Usulan Standar
                </h4>
            </div>
            <div class="panel-body container-fluid my-10">
                <div class="panel">
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                            <div class="col-xl-8">
                                <form id="regForm" enctype="multipart/form-data" method="post" action="<?= base_url('pengajuan/update'); ?>">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                    <input type="hidden" id="id" name="id" value="<?= $usulan['id']; ?>">

                                    <!-- One "tab" for each step in the form: -->
                                    <?= $this->session->flashdata('message'); ?>
                                    <?= $this->session->flashdata('message_error_ddp'); ?>
                                    <?= $this->session->flashdata('message_error_lop'); ?>
                                    <div class="tab">
                                        <!-- tambah class inputfield untuk validasi -->
                                        Jenis Standar
                                        <select id="jenis_standar" class="form-control my-10" onchange="changekomtek()" name="jenis_standar" value="<?= set_value('jenis_standar'); ?>">
                                            <?php foreach ($jnstandar as $js) : ?>
                                                <?php
                                                    if ($usulan['jenis_standar'] == $js['id']) {
                                                        echo '<option selected value="' . $js['id'] . '">' . $js['nama_rev'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $js['id'] . '">' . $js['nama_rev'] . '</option>';
                                                    }
                                                    ?>
                                            <?php endforeach; ?>
                                        </select>

                                        Komite Teknis
                                        <div id="divkomtek">
                                            <select id="komite_teknis" class="form-control my-10" name="komite_teknis" value="<?= set_value('komite_teknis'); ?>">
                                                <option value="">Pilih Komite Teknis</option>
                                                <?php foreach ($kmteknis as $kt) : ?>
                                                    <?php
                                                        if ($usulan['komite_teknis'] == $kt['id']) {
                                                            echo '<option selected value="' . $kt['id'] . '">' . $kt['nama_rev'] . '</option>';
                                                        } else {
                                                            echo '<option data-chained="' . $kt['keterangan'] . '" value="' . $kt['id'] . '">' . $kt['nama_rev'] . '</option>';
                                                        }
                                                        ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        Konseptor <button style="cursor:pointer;" type="button" class="btn btn-xs btn-primary my-5 add-konseptor">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table id="table-konseptor" class="table table-konseptor">
                                            <?php $i = 1; ?>
                                            <?php foreach ($dkonseptor as $dkon) { ?>
                                                <tr>
                                                    <td>
                                                        <!--Tambah class selectfield untuk validasi-->
                                                        <select name='konseptor[<?= $i; ?>][nik]' class="selectfield form-control" id="nik_<?= $i; ?>">
                                                            <?php foreach ($gkonseptor as $gk) {
                                                                    if ($dkon['nik'] == $gk['nik']) {
                                                                        echo '<option selected value="' . $gk['nik'] . '">' . $gk['nama'] . '</option>';
                                                                    } else {
                                                                        echo '<option value="' . $gk['nik'] . '">' . $gk['nama'] . '</option>';
                                                                    }
                                                                } ?>

                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="konseptor[<?= $i; ?>][instansi]" id="instansi_<?= $i; ?>" class="form-control" value="<?= $dkon['instansi']; ?>"></td>
                                                    <td>
                                                        <?php if ($i != 1) { ?>
                                                            <button class='btn btn-sm btn-danger remRow'><i class='fa fa-trash'></i>
                                                            </button>
                                                        <?php } ?>
                                                    </td>
                                                    <?php $i++; ?>
                                                <?php } ?>
                                                </tr>
                                        </table>

                                        <table class="table table-bordered tbkonseptor mt-20" id="tbkonseptor">

                                            <tr>
                                                <td>
                                                    Nama
                                                    <input type="text" class="form-control" name="nama_konseptor" id="namakonseptor" value="<?= $konsutama['nama']; ?>" placeholder="Nama Konseptor">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Alamat
                                                    <input type="text" class="form-control" name="alamat_konseptor" id="alamatkonseptor" value="<?= $konsutama['alamat']; ?>" placeholder="Alamat Konseptor">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    No. Telepon
                                                    <input type="text" class="form-control" name="telepon_konseptor" id="teleponkonseptor" value="<?= $konsutama['telepon']; ?>" placeholder="Telepon Konseptor">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Email
                                                    <input type="text" class="form-control" name="email_konseptor" id="emailkonseptor" value="<?= $konsutama['email']; ?>" placeholder="Email Konseptor">
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 20%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        Judul Standar
                                        <textarea class="form-control mb-10" name="judul" placeholder="Judul Standar"><?= $usulan['judul']; ?></textarea>
                                        Ruang Lingkup
                                        <textarea class="form-control mb-10" name="ruang_lingkup" placeholder="Ruang Lingkup"><?= $usulan['ruang_lingkup']; ?></textarea>
                                        Informasi Detail Hasil Penelitian
                                        <textarea class="form-control mb-10" name="detail_penelitian" placeholder="Berikan informasi detil, termasuk hasil penelitian atau kajian terhadap penerapan standar tersebut, jika perlu, tulis pada lembaran terpisah sebagai lampiran"><?= $usulan['detail_penelitian']; ?></textarea>

                                        Upload Lampiran Detail Hasil Penelitian
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <p class="text-center">File Lampiran</p>
                                                </td>
                                                <td>
                                                    <p class="text-center">Ganti File Lampiran</p>
                                                </td>
                                            </tr>
                                            <tr>
                                            <?php if ($usulan['dok_detail_penelitian']) { ?>
                                                <td class="text-center"><a href="<?= URL_API_DOWNLOAD.$usulan['dok_detail_penelitian']; ?>" target="_blank" class="btn btn-primary mb-15">
                                                                        Download
                                                                    </a></td>
                                                                <?php } else { ?>
                                                                    <td class="text-center"><a class="btn btn-danger" disabled>Tidak Ada Dokumen</a></td>
                                                                <?php } ?>
                                                <!-- <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= URL_API_DOWNLOAD. $usulan['dok_detail_penelitian'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td> -->
                                                <td>
                                                    <input type="file" name="dok_detail_penelitian" data-plugin="dropify" data-height="60">
                                                    <input type="hidden" name="dok_det_lama" value="<?= $usulan['dok_detail_penelitian']; ?>">
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 40%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        Tujuan dan alasan spesifik mengenai perumusan yang akan dilakukan
                                        <textarea class="form-control mb-10" name="tujuan_perumusan" placeholder="Tujuan dan alasan spesifikasi mengenai perumusan yang akan dilakukan (termasuk alasan dilakukan amandemen/revisi/ralat untuk standar)"><?= $usulan['tujuan_perumusan']; ?></textarea>

                                        Pihak-pihak utama yang berkepentingan <button style="cursor:pointer;" type="button" class="btn btn-xs btn-primary my-5 add-pihak">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table class="table tbpihak" id="tbpihak">
                                            <?php if ($dberkepentingan) { ?>
                                                <?php $i = 1; ?>
                                                <?php foreach ($dberkepentingan as $bkp) { ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="pihak[<?= $i; ?>][nama]" value="<?= $bkp['nama']; ?>"></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input type="text" name="pihak[1][nama]" class="form-control">
                                            <?php } ?>
                                        </table>

                                        Manfaat yang akan didapat dengan menerapkan dengan Standar yang diusulkan <button style="cursor:pointer;" type="button" class="btn btn-xs btn-primary add-manfaat">
                                            <li class="fa fa-plus"></li>
                                        </button><br>
                                        <table class="table my-5 tbmanfaat" id="tbmanfaat">
                                            <?php if ($dmanfaat) { ?>
                                                <?php $i = 1; ?>
                                                <?php foreach ($dmanfaat as $mnf) { ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="manfaat[<?= $i; ?>][isi]" value="<?= $mnf['isi']; ?>"></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input type="text" name="manfaat[1][isi]" class="form-control">
                                            <?php } ?>
                                        </table>

                                        Apakah terdapat organisasi yang mendukung usulan perumusan standar ini? (tidak termasuk pihak pengusul)
                                        <select onchange="changediv6()" name="org_pendukung" id="organisasipendukung" class="form-control mb-10">
                                            <?php if ($usulan['org_pendukung'] == 1) { ?>
                                                <option value="0">Tidak</option>
                                                <option value="1" selected>Ya</option>
                                            <?php } else { ?>
                                                <option value="0">Tidak</option>
                                                <option value="1">Ya</option>
                                            <?php } ?>
                                        </select>
                                        <div class="row">
                                            <div class="col-10" id="divres6">
                                                <?php if ($usulan['org_pendukung'] == 1) { ?>
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <p class="text-center">File Lampiran</p>
                                                            </td>
                                                            <td>
                                                                <p class="text-center">Ganti File Lampiran</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                        <?php if ($usulan['dok_org_pendukung']) { ?>
                                                <td class="text-center"><a href="<?= URL_API_DOWNLOAD.$usulan['dok_org_pendukung']; ?>" target="_blank" class="btn btn-primary mb-15">
                                                                        Download
                                                                    </a></td>
                                                                <?php } else { ?>
                                                                    <td class="text-center"><a class="btn btn-danger" disabled>Tidak Ada Dokumen</a></td>
                                                                <?php } ?>
                                                            <!-- <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= URL_API_DOWNLOAD. $usulan['dok_org_pendukung'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td> -->

                                                            <td>
                                                                <input type="file" name="dok_org_pendukung" data-plugin="dropify" data-height="60">
                                                                <input type="hidden" name="dok_org_lama" value="<?= $usulan['dok_org_pendukung']; ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 60%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        Download Dokumen Surat Pengajuan PNPS/Standar <a href="<?= URL_API_DOWNLOAD.'/format_surat_pengajuan_standar.docx'?>" target="_blank" class="btn btn-xs btn-primary">
                                            <li class="fa fa-download"></li> Format
                                        </a>
                                        <div class="col-lg-10 my-5">
                                            <?php if ($usulan['surat_pengajuan'] != '') { ?>
                                                <table class="table">
                                                    <tr>
                                                        <td>
                                                            <p class="text-center">File Lampiran</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-center">Ganti File Lampiran</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <?php if ($usulan['surat_pengajuan']) { ?>
                                                <td class="text-center"><a href="<?= URL_API_DOWNLOAD.$usulan['surat_pengajuan']; ?>" target="_blank" class="btn btn-primary mb-15">
                                                                        Download
                                                                    </a></td>
                                                                <?php } else { ?>
                                                                    <td class="text-center"><a class="btn btn-danger" disabled>Tidak Ada Dokumen</a></td>
                                                                <?php } ?>
                                                        <!-- <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= URL_API_DOWNLOAD.$usulan['surat_pengajuan'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td> -->

                                                        <td>
                                                            <input type="file" name="surat_pengajuan" data-plugin="dropify" data-height="60">
                                                            <input type="hidden" name="dok_srp_lama" value="<?= $usulan['surat_pengajuan']; ?>">
                                                        </td>
                                                    </tr>
                                                </table>
                                            <?php } else { ?>
                                                <input type='file' name='surat_pengajuan' id='surat_pengajuan' data-plugin='dropify' data-height=60>
                                            <?php } ?>
                                        </div>

                                        Outline RSNI/RSL <a href=<?= URL_API_DOWNLOAD.'format_outline.docx'?> target="_blank" class="btn btn-xs btn-primary">
                                            <li class="fa fa-download"></li> Format
                                        </a>
                                        <div class="col-lg-10 my-5">
                                            <?php if ($usulan['outline'] != '') { ?>
                                                <table class="table">
                                                    <tr>
                                                        <td>
                                                            <p class="text-center">File Lampiran</p>
                                                        </td>
                                                        <td>
                                                            <p class="text-center">Ganti File Lampiran</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <?php if ($usulan['outline']) { ?>
                                                <td class="text-center"><a href="<?= URL_API_DOWNLOAD.$usulan['outline']; ?>" target="_blank" class="btn btn-primary mb-15">
                                                                        Download
                                                                    </a></td>
                                                                <?php } else { ?>
                                                                    <td class="text-center"><a class="btn btn-danger" disabled>Tidak Ada Dokumen</a></td>
                                                                <?php } ?>
                                                        <!-- <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= URL_API_DOWNLOAD.$usulan['outline'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td> -->

                                                        <td>
                                                            <input type="file" name="outline" data-plugin="dropify" data-height="60">
                                                            <input type="hidden" name="dok_out_lama" value="<?= $usulan['outline']; ?>">
                                                        </td>
                                                    </tr>
                                                </table>
                                            <?php } else { ?>
                                                <input type='file' name='outline' id='outline' data-plugin='dropify' data-height=60>
                                            <?php } ?>
                                        </div>

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 80%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        Apakah kegiatan perumusan standar ini menjadi atau akan menjadi subyek regulasi atau berhubungan dengan regulasi yang telah ada?<button style="cursor:pointer;" type="button" class="btn btn-xs btn-primary ml-5 add-regulasi">
                                            <li class="fa fa-plus"></li>
                                        </button><br>
                                        <table class="table my-5 tbregulasi" id="tbregulasi">
                                            <?php if ($dregulasi) { ?>
                                                <?php $i = 1; ?>
                                                <?php foreach ($dregulasi as $drg) { ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="regulasi[<?= $i; ?>][nama]" value="<?= $drg['nama']; ?>"></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input type="text" name="regulasi[1][nama]" class="form-control">
                                            <?php } ?>
                                        </table>

                                        SNI Acuan Normatif &nbsp; <button type="button" style="cursor:pointer;" class="btn btn-xs btn-primary mb-5 add-acuan-sni">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table class="table my-5 tbacuansni" id="tbacuansni">
                                            <?php if ($dsni) { ?>
                                                <?php $i = 1; ?>
                                                <?php foreach ($dsni as $dsn) { ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="acuansni[<?= $i; ?>][nama]" value="<?= $dsn['nama']; ?>"></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input type="text" name="acuansni[1][nama]" class="form-control">
                                            <?php }  ?>
                                        </table>

                                        Acuan Non SNI &nbsp; <button type="button" style="cursor:pointer;" class="btn btn-xs btn-primary mb-5 add-acuan-nonsni">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table class="table my-5 tbacuannonsni" id="tbacuannonsni">
                                            <?php if ($dnonsni) { ?>
                                                <?php $i = 1; ?>
                                                <?php foreach ($dnonsni as $dnsn) { ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="acuannonsni[<?= $i; ?>][nama]" value="<?= $dnsn['nama']; ?>"></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input type="text" name="acuannonsni[1][nama]" class="form-control">
                                            <?php }  ?>
                                        </table>

                                        Bibliografi &nbsp; <button type="button" style="cursor:pointer;" class="btn btn-xs btn-primary mb-5 add-bibliografi">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table class="table my-5 tbbibliografi" id="tbbibliografi">
                                            <?php if ($dbibliografi) { ?>
                                                <?php $i = 1; ?>
                                                <?php foreach ($dbibliografi as $dbib) { ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="bibliografi[<?= $i; ?>][nama]" value="<?= $dbib['nama']; ?>"></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input type="text" name="bibliografi[1][nama]" class="form-control">
                                            <?php }  ?>
                                        </table>

                                        LPK potensial dalam penerapan SNI &nbsp; <button type="button" style="cursor:pointer;" class="btn btn-xs btn-primary mb-5 add-lpk">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table class="table my-5 tblpk" id="tblpk">
                                            <?php if ($dlpk) { ?>
                                                <?php $i = 1; ?>
                                                <?php foreach ($dlpk as $dlp) { ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="lpk[<?= $i; ?>][nama]" value="<?= $dlp['nama']; ?>"></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input type="text" name="lpk[1][nama]" class="form-control">
                                            <?php }  ?>
                                        </table>

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 100%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div style="overflow:auto;">
                                        <div style="float:left;">
                                            <button class="btn btn-primary" type="button" id="prevBtn" onclick="nextPrev(-1)"><i class="fa fa-chevron-circle-left"></i></button>
                                        </div>
                                        <div style="float:right;">
                                            <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)"><i class="fa fa-chevron-circle-right"></i></button>
                                        </div>
                                    </div>

                                </form>
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
<button style="background:#aaaaaa;"></button>

<script src="<?= base_url('assets/') ?>global/vendor/jquery/jquery.js"></script>


<script type="text/javascript">
    $(document).ready(function() {

        $('#nik_1').on('change', function() {
            var this_val = $('#nik_1').val();
            if (this_val == '') {
                $('#namakonseptor').val('');
                $('#emailkonseptor').val('');
                $('#teleponkonseptor').val('');
                $('#alamatkonseptor').val('');
                $('#instansi1').val('');
            }
            reload_data(this_val);
        });

        reload_data = function(this_val) {

            $.ajax({
                url: "<?php echo site_url('pengajuan/reload_konseptor') ?>",
                dataType: 'json',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                    'id_konseptor': +this_val
                },
                success: function(data) {
                    $.each(data.header, function(i, v) {
                        //$('#nikkonseptor').val(v.NIK);
                        //$('#instansikonseptor').val(v.INSTANSI);
                        $('#namakonseptor').val(v.NAMA);
                        $('#emailkonseptor').val(v.EMAIL);
                        $('#teleponkonseptor').val(v.TELEPON);
                        $('#alamatkonseptor').val(v.ALAMAT);
                    });
                },
                error: function() {
                    console.log('Faiure on Reload Konseptor');
                }
            });
        }

        $(".add-konseptor").click(function() {
            var row = $('#table-konseptor').find('tr').length;
            var nextRow = row + 1;

            var markup = "<tr><td><input type='text' class='form-control' name='konseptor[" + nextRow + "][nama]' id='nama_" + nextRow + "' placeholder='Nama Konseptor'></td>"
            markup += "<td><input type='text' class='form-control' name='konseptor[" + nextRow + "][instansi]' id='instansi_" + nextRow + "' placeholder='Instansi Konseptor'></td>"
            markup += "<td><button class='btn btn-sm btn-danger remRow'><i class='fa fa-trash'></i>\
                    </button></td></tr>";

            $("#table-konseptor").append(markup);

        });

        $(".table-konseptor").on('click', '.remRow', function() {
            var num_rows = $("#table-konseptor tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-pihak").click(function() {
            var row = $('#tbpihak').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='pihak[" + nextRow + "][nama]' placeholder='Pihak yang berkepentingan' id='namapihak_" + nextRow + "' class='form-control'>";
            markup += "<td><button style='cursor:pointer;' class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#tbpihak").append(markup);
        });

        $(".tbpihak").on('click', '.remRow', function() {
            var num_rows = $("#tbpihak tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-manfaat").click(function() {
            var row = $('#tbmanfaat').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='manfaat[" + nextRow + "][isi]' placeholder='Dalam kaitannya dengan keamanan, keselamatan, kesehatan, fungsi lingkungan hidup, ekonomi dan penguatan daya saing.' id='isimanfaat_" + nextRow + "' class='form-control'>";
            markup += "<td><button style='cursor:pointer;' class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#tbmanfaat").append(markup);
        });

        $(".tbmanfaat").on('click', '.remRow', function() {
            var num_rows = $("#tbmanfaat tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-regulasi").click(function() {
            var row = $('#tbregulasi').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='regulasi[" + nextRow + "][nama]' placeholder='Regulasi (Bisa lebih dari satu)' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><button style='cursor:pointer;' class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#tbregulasi").append(markup);
        });

        $(".tbregulasi").on('click', '.remRow', function() {
            var num_rows = $("#tbregulasi tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-acuan-sni").click(function() {
            var row = $('#tbacuansni').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='acuansni[" + nextRow + "][nama]' placeholder='Acuan SNI' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#tbacuansni").append(markup);
        });

        $(".tbacuansni").on('click', '.remRow', function() {
            var num_rows = $("#tbacuansni tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-acuan-nonsni").click(function() {
            var row = $('#tbacuannonsni').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='acuannonsni[" + nextRow + "][nama]' placeholder='Acuan Non SNI' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#tbacuannonsni").append(markup);
        });

        $(".tbacuannonsni").on('click', '.remRow', function() {
            var num_rows = $("#tbacuannonsni tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-bibliografi").click(function() {
            var row = $('#tbbibliografi').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='bibliografi[" + nextRow + "][nama]' placeholder='Bibliografi' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#tbbibliografi").append(markup);
        });

        $(".tbbibliografi").on('click', '.remRow', function() {
            var num_rows = $("#tbbibliografi tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-lpk").click(function() {
            var row = $('#tblpk').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='lpk[" + nextRow + "][nama]' placeholder='LPK Potensial' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#tblpk").append(markup);
        });

        $(".tblpk").on('click', '.remRow', function() {
            var num_rows = $("#tblpk tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

    });

    function changekomtek() {
        var selstd = $('#jenis_standar').val();

        if (selstd == 48) {

            var markup = "<select name='komite_teknis' id='komiteteknis' class='selectfield form-control mb-5'>";
            markup += "<option value='50'>49-01</option>";
            markup += "<option value='51'>49-02</option>";
            markup += "<option value='53'>07-01</option>";
            markup += "<option value='53'>LAPAN</option>";
            markup += "</select>";

            $("#divkomtek").html(markup);

        }

        if (selstd == 49) {
            var markup = "<select name='komite_teknis' id='komiteteknis' class='selectfield form-control mb-5'>";
            markup += "<option value='53'>LAPAN</option>";
            markup += "</select>";

            $("#divkomtek").html(markup);

        }

    }


    function changediv6() {
        var sel6 = $('#organisasipendukung').val();

        if (sel6 == 1) {
            var markup = "Upload Lampiran bukti dukungan (.pdf) <input type='file' name='dok_org_pendukung' id='dok_org_pendukung' data-plugin='dropify' data-height=60>";

            $("#divres6").html(markup);

        }

        if (sel6 == 0) {
            $("#divres6").html('');
        }
    }

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "<i class='fa fa-chevron-circle-right'></i>";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        // Tambahkan  !validateForm() setelah n == 1 && untuk validasi
        //if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        inp = x[currentTab].getElementsByClassName("inputfield");
        sel = x[currentTab].getElementsByClassName("selectfield");
        j = document.getElementById("judul");
        u = document.getElementById("unit_kerja");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < inp.length; i++) {
            // If a field is empty...
            if (inp[i].value == "") {
                // add an "invalid" class to the field:
                inp[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }

        // A loop that checks every select field in the current tab:
        for (i = 0; i < sel.length; i++) {
            // If a field is empty...
            if (sel[i].value == "") {
                // add an "invalid" class to the field:
                sel[i].className += " text-danger";
                // and set the current valid status to false
                valid = false;
            } else {
                sel[i].className = " selectfield form-control";
            }
        }

        //cek judul kosong
        if (j.value == "") {
            // add an "invalid" class to the field:
            j.className += " textempty";
            // and set the current valid status to false
            valid = false;
        }
        //cek unit kosong
        if (u.value == "") {
            // add an "invalid" class to the field:
            u.className += " text-danger invalid-feedback";
            // and set the current valid status to false
            valid = false;
        }

        return valid; // return the valid status
    }

    function check_jumlah() {
        var jml = $('#jumlah_pendesain').val();

        if (jml > 20) {
            alert('Jumlah melebihi batas!');
            $('#jumlah_pendesain').val('');
        }
    }
</script>
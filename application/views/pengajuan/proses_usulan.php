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
                            <div class="col-xl-10">
                                <form id="regForm" enctype="multipart/form-data" method="post" action="<?= base_url('pengajuan/save_proses'); ?>">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                    <input type="hidden" id="id" name="id" value="<?= $usulan['ID']; ?>">

                                    <input type="hidden" name="judul" value="<?= $usulan['JUDUL']; ?>">
                                    <input type="hidden" name="proses_usulan_sebelumnya" value="<?= $usulan['PROSES_USULAN']; ?>">
                                    <input type="hidden" name="proses_perumusan_sebelumnya" value="<?= $usulan['PROSES_PERUMUSAN']; ?>">
                                    <input type="hidden" name="email" value="<?= $email['EMAIL']; ?>">

                                    <!-- One "tab" for each step in the form: -->
                                    <?= $this->session->flashdata('message'); ?>
                                    <div class="tab">

                                        Kode
                                        <input class="form-control mb-10" type="text" name="kode" placeholder="Kode PNPS/PPSL" value="<?= $usulan['KODE']; ?>">

                                        Jenis Perumusan
                                        <select onchange="changediv1()" id="jenisperumusan" class="form-control mb-10" name="jenis_perumusan" value="<?= set_value('jenis_perumusan'); ?>">
                                            <option value="">Pilih Jenis Perumusan</option>
                                            <?php foreach ($jnperumusan as $jp) : ?>
                                                <?php
                                                    if ($usulan['JENIS_PERUMUSAN'] == $jp['ID']) {
                                                        echo '<option selected value="' . $jp['ID'] . '">' . $jp['NAMA_REV'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $jp['ID'] . '">' . $jp['NAMA_REV'] . '</option>';
                                                    }
                                                    ?>
                                            <?php endforeach; ?>
                                        </select>



                                        <div class="row-lg-12" id="divres1">
                                            <!-- Baru atau Revisi-->

                                            <?php if ($usulan['JENIS_PERUMUSAN'] == 54 or $usulan['JENIS_PERUMUSAN'] == 55) { ?>
                                                Jalur Perumusan
                                                <select onchange="changediv2()" id="jalurperumusan" class="form-control mb-10" name="jalur_perumusan" value="<?= set_value('jalur_perumusan'); ?>">
                                                    <?php foreach ($jlperumusan as $jlp) : ?>
                                                        <?php
                                                                if ($usulan['JALUR_PERUMUSAN'] == $jlp['ID']) {
                                                                    echo '<option selected value="' . $jlp['ID'] . '">' . $jlp['NAMA_REV'] . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $jlp['ID'] . '">' . $jlp['NAMA_REV'] . '</option>';
                                                                }
                                                                ?>
                                                    <?php endforeach; ?>
                                                </select>

                                                <!-- Ralat -->
                                            <?php } elseif ($usulan['JENIS_PERUMUSAN'] == 56) { ?>
                                                Nomor SNI yang diralat<input type='text' class='form-control focus' name='no_sni_ralat' value="<?= $usulan['NO_SNI_RALAT'] ?>">
                                                Pasal SNI yang diralat<input type='text' class='form-control focus' name='p_sni_ralat' value="<?= $usulan['P_SNI_RALAT'] ?>">

                                                <!-- Amandemen-->
                                            <?php } elseif ($usulan['JENIS_PERUMUSAN'] == 57) { ?>
                                                Nomor SNI yang di amandemen<input type='text' class='form-control focus' name='no_sni_amandemen' value="<?= $usulan['NO_SNI_AMANDEMEN'] ?>">
                                                Pasal SNI yang di amandemen<input type='text' class='form-control focus' name='p_sni_amandemen' value="<?= $usulan['P_SNI_AMANDEMEN'] ?>">

                                                <!-- Terjemah-->
                                            <?php } elseif ($usulan['JENIS_PERUMUSAN'] == 58) { ?>
                                                Nomor judul SNI yang akan diterjemahkan <input type='text' class='form-control focus' name='no_sni_terjemah' value="<?= $usulan['NO_SNI_TERJEMAH'] ?>">

                                                <!-- -->
                                            <?php } ?>
                                        </div>

                                        <div class="row-lg-12" id="divres2">
                                            <?php if ($usulan['JALUR_PERUMUSAN'] == 68) { ?>
                                                Jenis Adopsi
                                                <select onchange="changediv3()" id="jenisadopsi" class="form-control mb-10" name="jenis_adopsi" value="<?= set_value('jenis_adopsi'); ?>">
                                                    <?php foreach ($jnadopsi as $jad) : ?>
                                                        <?php
                                                                if ($usulan['JENIS_ADOPSI'] == $jad['ID']) {
                                                                    echo '<option selected value="' . $jad['ID'] . '">' . $jad['NAMA_REV'] . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $jad['ID'] . '">' . $jad['NAMA_REV'] . '</option>';
                                                                }
                                                                ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php } ?>
                                        </div>

                                        <div class="row-lg-12" id="divres3">
                                            <?php if ($usulan['JALUR_PERUMUSAN'] == 68) { ?>
                                                Metode Adopsi
                                                <select id="metode" class="form-control mb-10" name="metode_adopsi" value="<?= set_value('metode_adopsi'); ?>">
                                                    <?php if ($usulan['JENIS_ADOPSI'] == 69) { ?>
                                                        <option value="71" selected>Publikasi Ulang</option>
                                                    <?php } elseif ($usulan['JENIS_ADOPSI'] == 70) { ?>
                                                        <?php if ($usulan['METODE_ADOPSI'] == 72) { ?>
                                                            <option value="72" selected>Terjemahan 1 Bahasa(Indonesia)</option>
                                                            <option value="73">Terjemahan 2 Bahasa(Indonesia&Inggris)</option>
                                                        <?php } elseif ($usulan['METODE_ADOPSI'] == 73) { ?>
                                                            <option value="72">Terjemahan 1 Bahasa(Indonesia)</option>
                                                            <option value="73" selected>Terjemahan 2 Bahasa(Indonesia&Inggris)</option>
                                                        <?php } else { ?>
                                                            <option value="72">Terjemahan 1 Bahasa(Indonesia)</option>
                                                            <option value="73" selected>Terjemahan 2 Bahasa(Indonesia&Inggris)</option>
                                                    <?php }
                                                        } ?>
                                                </select>
                                            <?php } ?>
                                        </div>


                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 20%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">

                                        Kebutuhan Mendesak ?
                                        <select onchange="changediv4()" name="keb_mendesak" id="keb_mendesak" class="form-control mb-10">
                                            <?php if ($usulan['KEB_MENDESAK'] == 1) { ?>
                                                <option value="0">Tidak</option>
                                                <option value="1" selected>Ya</option>
                                            <?php } else { ?>
                                                <option value="0">Tidak</option>
                                                <option value="1">Ya</option>
                                            <?php } ?>
                                        </select>

                                        <div class="row">
                                            <div class="col-10" id="divres4">
                                                <?php if ($usulan['KEB_MENDESAK'] == 1) { ?>
                                                    <?php if ($usulan['DOK_KEB_MENDESAK'] != '') { ?>
                                                        Surat Kebutuhan Mendesak
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
                                                                <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/kebutuhan_mendesak/') . $usulan['DOK_KEB_MENDESAK'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                <td>
                                                                    <input type="file" name="dok_keb_mendesak" data-plugin="dropify" data-height="60">
                                                                    <input type="hidden" name="dok_skm_lama" value="<?= $usulan['DOK_KEB_MENDESAK']; ?>">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } else { ?>
                                                        Surat Kebutuhan Mendesak
                                                        <input type=' file' name='dok_keb_mendesak' id='dok_keb_mendesak' data-plugin='dropify' data-height=60>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        Terdapat isi dari Standar yang terkait dengan hak paten ?
                                        <select onchange="changediv5()" name="terkait_paten" id="terkait_paten" class="form-control mb-10">
                                            <?php if ($usulan['TERKAIT_PATEN'] == 1) { ?>
                                                <option value="0">Tidak</option>
                                                <option value="1" selected>Ya</option>
                                            <?php } else { ?>
                                                <option value="0">Tidak</option>
                                                <option value="1">Ya</option>
                                            <?php } ?>
                                        </select>
                                        <div class="row">
                                            <div class="col-lg-10" id="divres5">
                                                <?php if ($usulan['TERKAIT_PATEN'] == 1) { ?>
                                                    <?php if ($usulan['DOK_KESEDIAAN_PATEN'] != '') { ?>
                                                        Surat Kesediaan Pencantuman Paten
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
                                                                <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/kesediaan_paten/') . $usulan['DOK_KESEDIAAN_PATEN'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                <td>
                                                                    <input type="file" name="dok_kesediaan_paten" data-plugin="dropify" data-height="60">
                                                                    <input type="hidden" name="dok_ksp_lama" value="<?= $usulan['DOK_KESEDIAAN_PATEN']; ?>">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } else { ?>
                                                        Surat Kesediaan Pencantuman Paten
                                                        <input type='file' name='dok_kesediaan_paten' id='dok_kesediaan_paten' data-plugin='dropify' data-height=60>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 40%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        Kesesuaian dengan program pemerintah
                                        <?php if ($usulan['KESESUAIAN']) { ?>
                                            <textarea class="form-control" name="kesesuaian"><?= $usulan['KESESUAIAN']; ?></textarea>
                                        <?php } else { ?>
                                            <textarea class="form-control" name="kesesuaian" placeholder="Kesesuaian dengan program pemerintah (Sebutkan secara terperinci)"></textarea>
                                        <?php } ?>
                                        Ulasan
                                        <?php if ($usulan['ULASAN']) { ?>
                                            <textarea class="form-control" name="ulasan"><?= $usulan['ULASAN']; ?></textarea>
                                        <?php } else { ?>
                                            <textarea class=" form-control" name="ulasan" placeholder="Ulasan (Sebutkan secara terperinci)"></textarea>
                                        <?php } ?>

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 50%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">


                                        Status
                                        <select onchange="changediv7()" id="status" class="form-control mb-10" name="status" value="<?= set_value('status'); ?>">
                                            <?php foreach ($status as $st) { ?>
                                                <?php if ($st['ID'] == $usulan['STATUS']) { ?>
                                                    <option value="<?= $st['ID']; ?>" selected> <?= $st['NAMA_REV']; ?></option> <?php } else { ?> <option value="<?= $st['ID']; ?>"><?= $st['NAMA_REV']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>

                                        <div id="divres7">

                                        </div>

                                        Proses Usulan Standar
                                        <select id="proses_usulan" class="form-control mb-10" name="proses_usulan" value="<?= set_value('proses_usulan'); ?>">
                                            <option value="">Pilih Proses Usulan Standar</option>
                                            <?php if ($usulan['JENIS_STANDAR'] == 49) { ?>
                                                <?php foreach ($prusulansl as $prusl) { ?>
                                                    <?php if ($usulan['PROSES_USULAN'] == $prusl['ID']) { ?>
                                                        <option value="<?= $prusl['ID']; ?>" selected><?= $prusl['NAMA_REV'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $prusl['ID']; ?>"><?= $prusl['NAMA_REV'] ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php foreach ($prusulansni as $prusni) { ?>
                                                    <?php if ($usulan['PROSES_USULAN'] == $prusni['ID']) { ?>
                                                        <option value="<?= $prusni['ID']; ?>" selected><?= $prusni['NAMA_REV'] ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $prusni['ID']; ?>"><?= $prusni['NAMA_REV'] ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 70%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">

                                        <?php if ($usulan['JENIS_STANDAR'] == 49) {
                                            $perumusan = 'SL';
                                        } else {
                                            $perumusan = 'SNI';
                                        } ?>

                                        Proses Perumusan <?= $perumusan; ?>

                                        <?php if ($usulan['JENIS_STANDAR'] == 49) { ?>
                                            <?php if ($usulan['STATUS'] == 102) { ?>
                                                <select id="proses_perumusan" class="form-control mb-10" name="proses_perumusan" value="<?= set_value('proses_perumusan'); ?>">
                                                <?php } else { ?>
                                                    <select disabled id="proses_perumusan" class="form-control mb-10" name="proses_perumusan" value="<?= set_value('proses_perumusan'); ?>">
                                                    <?php } ?>
                                                    <option value="">Pilih Perumusan SL</option>
                                                    <?php foreach ($psl as $pl) { ?>
                                                        <?php if ($usulan['PROSES_PERUMUSAN'] == $pl['ID']) { ?>
                                                            <option value="<?= $pl['ID']; ?>" selected><?= $pl['NAMA_REV'] ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $pl['ID']; ?>"><?= $pl['NAMA_REV'] ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    </select>
                                                <?php } elseif ($usulan['JENIS_STANDAR'] == 48) { ?>
                                                    <?php if ($usulan['STATUS'] == 102) { ?>
                                                        <select id="proses_perumusan" class="form-control mb-10" name="proses_perumusan" value="<?= set_value('proses_perumusan'); ?>">
                                                        <?php } else { ?>
                                                            <select disabled id="proses_perumusan" class="form-control mb-10" name="proses_perumusan" value="<?= set_value('proses_perumusan'); ?>">
                                                            <?php } ?>
                                                            <option value="">Pilih Perumusan SNI</option>
                                                            <?php foreach ($psni as $psn) { ?>
                                                                <?php if ($usulan['PROSES_PERUMUSAN'] == $psn['ID']) { ?>
                                                                    <option value="<?= $psn['ID']; ?>" selected><?= $psn['NAMA_REV'] ?></option>
                                                                <?php } else { ?>
                                                                    <option value="<?= $psn['ID']; ?>"><?= $psn['NAMA_REV'] ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php  } ?>
                                                            </select>
                                                            <?php if ($usulan['JENIS_STANDAR'] == 49) {
                                                                $jenis = 'RSL';
                                                            } else {
                                                                $jenis = 'RSNI';
                                                            } ?>
                                                            Upload permintaan perbaikan <?= $jenis; ?> tahap 1
                                                            <table class="table table-bordered my-10">
                                                                <tr>
                                                                    <td>Surat Pengantar</td>
                                                                    <td>
                                                                        <?php if ($perbaikan['SURAT_PENGANTAR_1']) { ?>
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
                                                                                    <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['SURAT_PENGANTAR_1'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                                    <td>
                                                                                        <input type="file" name="surat_pengantar_1" data-plugin="dropify" data-height="60">
                                                                                        <input type="hidden" name="sp_1_lama" value="<?= $perbaikan['SURAT_PENGANTAR_1']; ?>">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        <?php } else { ?>
                                                                            <input type='file' name='surat_pengantar_1' id='surat_pengantar_1' data-plugin='dropify' data-height=60>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>RSNI</td>
                                                                    <td>
                                                                        <?php if ($perbaikan['RSNI_1']) { ?>
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
                                                                                    <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['RSNI_1'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                                    <td>
                                                                                        <input type="file" name="rsni_1" data-plugin="dropify" data-height="60">
                                                                                        <input type="hidden" name="rsni_1_lama" value="<?= $perbaikan['RSNI_1']; ?>">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        <?php } else { ?>
                                                                            <input type='file' name='rsni_1' id='rsni_1' data-plugin='dropify' data-height=60>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Notulensi</td>
                                                                    <td>
                                                                        <?php if ($perbaikan['NOTULENSI_1']) { ?>
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
                                                                                    <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['NOTULENSI_1'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                                    <td>
                                                                                        <input type="file" name="notulensi_1" data-plugin="dropify" data-height="60">
                                                                                        <input type="hidden" name="notulensi_1_lama" value="<?= $perbaikan['NOTULENSI_1']; ?>">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        <?php } else { ?>
                                                                            <input type='file' name='notulensi_1' id='notulensi_1' data-plugin='dropify' data-height=60>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            Download Dokumen Perbaikan <?= $jenis; ?> Tahap 1
                                                            <div class="col mb-25">
                                                                <?php if ($perbaikan['DOK_PERBAIKAN_1']) { ?>
                                                                    <a href="<?= base_url() ?>assets/dokumen/dokumen_perbaikan/<?= $perbaikan['DOK_PERBAIKAN_1']; ?>" target="_blank" class="btn btn-primary mb-15">
                                                                        Download
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a class="btn btn-danger" disabled>Tidak Ada Dokumen</a>
                                                                <?php } ?>
                                                            </div>

                                                            Upload permintaan perbaikan <?= $jenis; ?> tahap 2
                                                            <table class="table table-bordered my-10">
                                                                <tr>
                                                                    <td>Surat Pengantar</td>
                                                                    <td>
                                                                        <?php if ($perbaikan['SURAT_PENGANTAR_2']) { ?>
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
                                                                                    <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['SURAT_PENGANTAR_2'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                                    <td>
                                                                                        <input type="file" name="surat_pengantar_2" data-plugin="dropify" data-height="60">
                                                                                        <input type="hidden" name="sp_2_lama" value="<?= $perbaikan['SURAT_PENGANTAR_2']; ?>">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        <?php } else { ?>
                                                                            <input type='file' name='surat_pengantar_2' id='surat_pengantar_2' data-plugin='dropify' data-height=60>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>RSNI</td>
                                                                    <td>
                                                                        <?php if ($perbaikan['RSNI_2']) { ?>
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
                                                                                    <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['RSNI_2'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                                    <td>
                                                                                        <input type="file" name="rsni_2" data-plugin="dropify" data-height="60">
                                                                                        <input type="hidden" name="rsni_2_lama" value="<?= $perbaikan['RSNI_2']; ?>">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        <?php } else { ?>
                                                                            <input type='file' name='rsni_2' id='rsni_2' data-plugin='dropify' data-height=60>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Notulensi</td>
                                                                    <td>
                                                                        <?php if ($perbaikan['NOTULENSI_2']) { ?>
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
                                                                                    <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['NOTULENSI_2'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                                    <td>
                                                                                        <input type="file" name="notulensi_2" data-plugin="dropify" data-height="60">
                                                                                        <input type="hidden" name="notulensi_2_lama" value="<?= $perbaikan['NOTULENSI_2']; ?>">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        <?php } else { ?>
                                                                            <input type='file' name='notulensi_2' id='notulensi_2' data-plugin='dropify' data-height=60>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            </table>

                                                            Download Dokumen Perbaikan <?= $jenis; ?> Tahap 2
                                                            <div class="col my-5">
                                                                <?php if ($perbaikan['DOK_PERBAIKAN_2']) { ?>
                                                                    <a href="<?= base_url() ?>assets/dokumen/dokumen_perbaikan/<?= $perbaikan['DOK_PERBAIKAN_2']; ?>" target="_blank" class="btn btn-primary mb-15">
                                                                        Download
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a class="btn btn-danger" disabled>Tidak Ada Dokumen</a>
                                                                <?php } ?>
                                                            </div>

                                                            <div class="progress my-10">
                                                                <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 85%" role="progressbar">
                                                                </div>
                                                            </div>
                                    </div>
                                    <div class="tab">
                                        Upload permintaan perbaikan <?= $jenis; ?> tahap 3
                                        <table class="table table-bordered my-10">
                                            <tr>
                                                <td>Surat Pengantar</td>
                                                <td>
                                                    <?php if ($perbaikan['SURAT_PENGANTAR_3']) { ?>
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
                                                                <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['SURAT_PENGANTAR_3'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                <td>
                                                                    <input type="file" name="surat_pengantar_3" data-plugin="dropify" data-height="60">
                                                                    <input type="hidden" name="sp_3_lama" value="<?= $perbaikan['SURAT_PENGANTAR_3']; ?>">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } else { ?>
                                                        <input type='file' name='surat_pengantar_3' id='surat_pengantar_3' data-plugin='dropify' data-height=60>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>RSNI</td>
                                                <td>
                                                    <?php if ($perbaikan['RSNI_3']) { ?>
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
                                                                <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['RSNI_3'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                <td>
                                                                    <input type="file" name="rsni_3" data-plugin="dropify" data-height="60">
                                                                    <input type="hidden" name="rsni_3_lama" value="<?= $perbaikan['RSNI_3']; ?>">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } else { ?>
                                                        <input type='file' name='rsni_3' id='rsni_3' data-plugin='dropify' data-height=60>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Notulensi</td>
                                                <td>
                                                    <?php if ($perbaikan['NOTULENSI_3']) { ?>
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
                                                                <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['NOTULENSI_3'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                <td>
                                                                    <input type="file" name="notulensi_3" data-plugin="dropify" data-height="60">
                                                                    <input type="hidden" name="notulensi_3_lama" value="<?= $perbaikan['NOTULENSI_3']; ?>">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } else { ?>
                                                        <input type='file' name='notulensi_3' id='notulensi_3' data-plugin='dropify' data-height=60>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </table>

                                        Download Dokumen Perbaikan <?= $jenis; ?> tahap 3
                                        <div class="col mb-25">
                                            <?php if ($perbaikan['DOK_PERBAIKAN_3']) { ?>
                                                <a href="<?= base_url() ?>assets/dokumen/dokumen_perbaikan/<?= $perbaikan['DOK_PERBAIKAN_3']; ?>" target="_blank" class="btn btn-primary mb-15">
                                                    Download
                                                </a>
                                            <?php } else { ?>
                                                <a class="btn btn-danger" disabled>Tidak Ada Dokumen</a>
                                            <?php } ?>
                                        </div>

                                        Upload permintaan perbaikan <?= $jenis; ?> tahap 4
                                        <table class="table table-bordered my-10">
                                            <tr>
                                                <td>Surat Pengantar</td>
                                                <td>
                                                    <?php if ($perbaikan['SURAT_PENGANTAR_4']) { ?>
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
                                                                <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['SURAT_PENGANTAR_4'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                <td>
                                                                    <input type="file" name="surat_pengantar_4" data-plugin="dropify" data-height="60">
                                                                    <input type="hidden" name="sp_4_lama" value="<?= $perbaikan['SURAT_PENGANTAR_4']; ?>">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } else { ?>
                                                        <input type='file' name='surat_pengantar_4' id='surat_pengantar_4' data-plugin='dropify' data-height=60>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>RSNI</td>
                                                <td>
                                                    <?php if ($perbaikan['RSNI_4']) { ?>
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
                                                                <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['RSNI_4'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                <td>
                                                                    <input type="file" name="rsni_4" data-plugin="dropify" data-height="60">
                                                                    <input type="hidden" name="rsni_4_lama" value="<?= $perbaikan['RSNI_4']; ?>">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } else { ?>
                                                        <input type='file' name='rsni_4' id='rsni_4' data-plugin='dropify' data-height=60>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Notulensi</td>
                                                <td>
                                                    <?php if ($perbaikan['NOTULENSI_4']) { ?>
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
                                                                <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['NOTULENSI_4'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                                <td>
                                                                    <input type="file" name="notulensi_4" data-plugin="dropify" data-height="60">
                                                                    <input type="hidden" name="notulensi_4_lama" value="<?= $perbaikan['NOTULENSI_4']; ?>">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    <?php } else { ?>
                                                        <input type='file' name='notulensi_4' id='notulensi_4' data-plugin='dropify' data-height=60>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </table>

                                        Download Dokumen Perbaikan <?= $jenis; ?> tahap 4
                                        <div class="col my-5">
                                            <?php if ($perbaikan['DOK_PERBAIKAN_4']) { ?>
                                                <a href="<?= base_url() ?>assets/dokumen/dokumen_perbaikan/<?= $perbaikan['DOK_PERBAIKAN_4']; ?>" target="_blank" class="btn btn-primary mb-15">
                                                    Download
                                                </a>
                                            <?php } else { ?>
                                                <a class="btn btn-danger" disabled>Tidak Ada Dokumen</a>
                                            <?php } ?>
                                        </div>

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

        $(".add-row-one").click(function() {
            var row = $('#mytable').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='konseptor[" + nextRow + "][nama]' placeholder='Nama Konseptor' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><input type='text' name='konseptor[" + nextRow + "][instansi]' placeholder='Instansi Konseptor' id='instansi_" + nextRow + "' class='form-control'></td><td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
                </button></td></tr>";

            if (nextRow <= 20) {
                $("#mytable").append(markup);
            } else {
                alert('Jumlah melebihi batas')
            }
        });


        //Menghapus Kolom
        $(".mytable").on('click', '.remRow', function() {
            var num_rows = $("#mytable tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });






    });

    function changediv1() {
        var sel1 = $('#jenisperumusan').val();

        if (sel1 == 54 || sel1 == 55) {
            var markup = "Jalur Perumusan SNI<select onchange='changediv2()' name='jalur_perumusan' id='jalurperumusan' class='selectfield form-control mb-5'><option value='67'>Perumusan Sendiri</option>";
            markup += "<option value='68'>Perumusan Adopsi</option>";
            markup += "</select>";

            $("#divres1").html(markup);
            $("#divres2").html('');
            $("#divres3").html('');

        }
        if (sel1 == 56) {
            var markup = "Nomor SNI yang diralat<input type='text' class='form-control focus' name='no_sni_ralat'>";
            markup += "Pasal SNI yang diralat<input type='text' class='form-control focus' name='p_sni_ralat'>";

            $("#divres1").html(markup);
            $("#divres2").html('');
            $("#divres3").html('');

        }

        if (sel1 == 57) {
            var markup = "Nomor judul SNI yang akan diamandemen <input type='text' class='form-control focus' name='no_sni_amandemen'>";
            markup += "Pasal SNI yang diamandemen <input type='text' class='form-control focus' name='p_sni_amandemen'>"

            $("#divres1").html(markup);
            $("#divres2").html('');
            $("#divres3").html('');

        }

        if (sel1 == 58) {
            var markup = "Nomor judul SNI yang akan diterjemahkan <input type='text' class='form-control focus' name='no_sni_terjemah'>";

            $("#divres1").html(markup);
            $("#divres2").html('');
            $("#divres3").html('');

        }

        if (sel1 == 59) {

            $("#divres1").html('');
            $("#divres2").html('');
            $("#divres3").html('');

        }
    }

    function changediv2() {
        var sel2 = $('#jalurperumusan').val();

        if (sel2 == 67) {

            $("#divres2").html('');

        }

        if (sel2 == 68) {
            var markup = "Jenis Adopsi<select onchange='changediv3()' name='jenis_adopsi' id='jenisadopsi' class='selectfield form-control mb-5'><option value=''>Pilih Jenis Adopsi</option><option value='69'>Identik</option>";
            markup += "<option value='70'>Modifikasi</option>";
            markup += "</select>";

            $("#divres2").html(markup);

        }
    }

    function changediv3() {
        var sel3 = $('#jenisadopsi').val();

        if (sel3 == 69) {
            var markup = "Metode Adopsi<select name='metode_adopsi' id='metodeadopsi' class='selectfield form-control mb-5'><option value='71'>Publikasi Ulang</option>";
            markup += "</select>";

            $("#divres3").html(markup);

        }

        if (sel3 == 70) {
            var markup = "Metode Adopsi<select name='metode_adopsi' id='metodeadopsi' class='selectfield form-control mb-5'>";
            markup += "<option value='72'>Terjemahan 1 Bahasa(Indonesia)</option>";
            markup += "<option value='73'>Terjemahan 2 Bahasa(Indonesia dan Inggris)</option>";
            markup += "</select>";
            $("#divres3").html(markup);

        }
    }

    function changediv4() {
        var sel4 = $('#keb_mendesak').val();

        if (sel4 == 1) {
            var markup = "Download Dokumen Surat Kebutuhan Mendesak (.pdf) <input type='file' name='dok_keb_mendesak' id='dok_keb_mendesak' data-plugin='dropify' data-height=60>";

            $("#divres4").html(markup);

        }

        if (sel4 == 0) {
            $("#divres4").html('');
        }
    }

    function changediv5() {
        var sel5 = $('#terkait_paten').val();

        if (sel5 == 1) {
            var markup = "Lampiran kesediaan pencantuman Paten dalam Standar (.docx) <input type='file' name='dok_kesediaan_paten' id='dok_kesediaan_paten' data-plugin='dropify' data-height=60>";
            markup += "Informasi Hak Paten<textarea class='form-control focus mb-5' name='informasi_paten'></textarea>";

            $("#divres5").html(markup);

        }

        if (sel5 == 0) {
            $("#divres5").html('');
        }

    }

    function changediv6() {
        var sel6 = $('#organisasipendukung').val();

        if (sel6 == 1) {
            var markup = "Download Dokumen Lampiran bukti dukungan (.pdf) <input type='file' name='surat_mendesak' id='suratmendesak' data-plugin='dropify' data-height=60>";

            $("#divres6").html(markup);

        }

        if (sel6 == 0) {
            $("#divres6").html('');
        }
    }

    function changediv7() {
        var sel7 = $('#status').val();

        if (sel7 == 101) {
            var markup = "Alasan Penolakan <input type='text' class='form-control mb-25' name='alasan_penolakan' placeholder='Alasan Penolakan'>";

            $("#divres7").html(markup);

        }

        if (sel7 != 101) {
            $("#divres7").html('');
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
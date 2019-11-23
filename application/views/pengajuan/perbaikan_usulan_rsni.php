<style>
    body {
        background-color: #f1f1f1;
    }

    input {
        padding: 10px;
        width: 100%;
        font-size: 17px;
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
                <li class="breadcrumb-item active">Perbaikan Usulan</li>
            </ol>
        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Perbaikan Usulan RSNI
                </h4>
            </div>
            <div class="panel-body container-fluid my-10">
                <div class="panel">
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                            <div class="col-xl-8">
                                <form id="regForm" enctype="multipart/form-data" method="post" action="<?= base_url('pengajuan/save_perbaikan'); ?>">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                    <input type="hidden" id="id" name="id" value="<?= $usulan['ID']; ?>">
                                    <!-- One "tab" for each step in the form: -->
                                    <?= $this->session->flashdata('message'); ?>

                                    <div class="tab">

                                        Dokumen Permintaan Perbaikan RSNI Tahap 1
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>
                                                    Surat Pengantar
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['SURAT_PENGANTAR_1']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['SURAT_PENGANTAR_1']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    RSNI
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['RSNI_1']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['RSNI_1']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Notulensi
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['NOTULENSI_1']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['NOTULENSI_1']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </table>

                                        Upload Perbaikan RSNI Tahap 1
                                        <div class="col my-5">
                                            <?php if ($perbaikan['SURAT_PENGANTAR_1'] != '' or $perbaikan['RSNI_1'] != '') { ?>
                                                <?php if ($perbaikan['DOK_PERBAIKAN_1'] != '') { ?>
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
                                                            <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['DOK_PERBAIKAN_1'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                            <td>
                                                                <input type="file" name="dok_perbaikan_1" data-plugin="dropify" data-height="60">
                                                                <input type="hidden" name="dok_1_lama" value="<?= $perbaikan['DOK_PERBAIKAN_1']; ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <?php } else { ?>
                                                    <input class="mt-10" type="file" name="dok_perbaikan_1" data-plugin="dropify" data-height="60">
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input class="mt-10" type="file" data-plugin="dropify" data-height="60" disabled="disabled">
                                            <?php } ?>
                                        </div>

                                        Dokumen Permintaan Perbaikan RSNI Tahap 2
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>
                                                    Surat Pengantar
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['SURAT_PENGANTAR_2']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['SURAT_PENGANTAR_2']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    RSNI
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['RSNI_2']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['RSNI_2']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Notulensi
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['NOTULENSI_2']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['NOTULENSI_2']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </table>

                                        Upload Perbaikan RSNI Tahap 2
                                        <div class="col my-5">
                                            <?php if ($perbaikan['SURAT_PENGANTAR_2'] != '' or $perbaikan['RSNI_2'] != '') { ?>
                                                <?php if ($perbaikan['DOK_PERBAIKAN_2'] != '') { ?>
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
                                                            <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['DOK_PERBAIKAN_2'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                            <td>
                                                                <input type="file" name="dok_perbaikan_2" data-plugin="dropify" data-height="60">
                                                                <input type="hidden" name="dok_2_lama" value="<?= $perbaikan['DOK_PERBAIKAN_2']; ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <?php } else { ?>
                                                    <input class="mt-10" type="file" name="dok_perbaikan_2" data-plugin="dropify" data-height="60">
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input class="mt-10" type="file" data-plugin="dropify" data-height="60" disabled="disabled">
                                            <?php } ?>
                                        </div>

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 50%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        Dokumen Permintaan Perbaikan RSNI Tahap 3
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>
                                                    Surat Pengantar
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['SURAT_PENGANTAR_3']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['SURAT_PENGANTAR_3']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    RSNI
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['RSNI_3']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['RSNI_3']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Notulensi
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['NOTULENSI_3']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['NOTULENSI_3']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </table>

                                        Upload Perbaikan RSNI Tahap 3
                                        <div class="col my-5">
                                            <?php if ($perbaikan['SURAT_PENGANTAR_3'] != '' or $perbaikan['RSNI_3'] != '') { ?>
                                                <?php if ($perbaikan['DOK_PERBAIKAN_3'] != '') { ?>
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
                                                            <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['DOK_PERBAIKAN_3'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                            <td>
                                                                <input type="file" name="dok_perbaikan_3" data-plugin="dropify" data-height="60">
                                                                <input type="hidden" name="dok_3_lama" value="<?= $perbaikan['DOK_PERBAIKAN_3']; ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <?php } else { ?>
                                                    <input class="mt-10" type="file" name="dok_perbaikan_3" data-plugin="dropify" data-height="60">
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input class="mt-10" type="file" data-plugin="dropify" data-height="60" disabled="disabled">
                                            <?php } ?>
                                        </div>

                                        Dokumen Permintaan Perbaikan RSNI Tahap 4
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>
                                                    Surat Pengantar
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['SURAT_PENGANTAR_4']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['SURAT_PENGANTAR_4']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    RSNI
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['RSNI_4']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['RSNI_4']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Notulensi
                                                </td>
                                                <td>
                                                    <?php if ($perbaikan['NOTULENSI_4']) { ?>
                                                        <a class="btn btn-xs btn-primary" href="<?= base_url() ?>assets/dokumen/perbaikan_usulan/<?= $perbaikan['NOTULENSI_4']; ?>" target="_blank">Download</a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-xs btn-danger disabled" href="#">Dokumen tidak tersedia</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </table>

                                        Upload Perbaikan RSNI Tahap 4
                                        <div class="col my-5">
                                            <?php if ($perbaikan['SURAT_PENGANTAR_4'] != '' or $perbaikan['RSNI_4'] != '') { ?>
                                                <?php if ($perbaikan['DOK_PERBAIKAN_4'] != '') { ?>
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
                                                            <td class="text-center"><a class="btn btn-default" target="_blank" href="<?= base_url('assets/dokumen/perbaikan_usulan/') . $perbaikan['DOK_PERBAIKAN_4'] ?>"><i class="fa fa-eye"></i> Lihat File</a></td>

                                                            <td>
                                                                <input type="file" name="dok_perbaikan_4" data-plugin="dropify" data-height="60">
                                                                <input type="hidden" name="dok_4_lama" value="<?= $perbaikan['DOK_PERBAIKAN_4']; ?>">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <?php } else { ?>
                                                    <input class="mt-10" type="file" name="dok_perbaikan_4" data-plugin="dropify" data-height="60">
                                                <?php } ?>
                                            <?php } else { ?>
                                                <input class="mt-10" type="file" data-plugin="dropify" data-height="60" disabled="disabled">
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
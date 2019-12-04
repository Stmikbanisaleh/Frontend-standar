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
                                <form id="regForm" enctype="multipart/form-data" method="post" action="<?= base_url('pengajuan/save'); ?>">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">


                                    <!-- One "tab" for each step in the form: -->
                                    <?= $this->session->flashdata('message'); ?>
                                    <?= $this->session->flashdata('message_error_ddp'); ?>
                                    <?= $this->session->flashdata('message_error_lop'); ?>
                                    <div class="tab">
                                        <!-- tambah class inputfield untuk validasi -->
                                        Jenis Standar
                                        <select id="jenis_standar" onchange="gantiJenis()" class="form-control my-10" name="jenis_standar" value="<?= set_value('jenis_standar'); ?>">
                                            <option value="">Pilih Jenis Standar</option>
                                            <?php foreach ($jnstandar as $js) : ?>
                                                <option value="<?= $js['id']; ?>"><?= $js['nama_rev'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        Komite Teknis
                                        <select id="komite_teknis" class="form-control my-10" name="komite_teknis" value="<?= set_value('komite_teknis'); ?>">
                                            <option value="">Pilih Komite Teknis</option>
                                            <?php foreach ($kmteknis as $kt) : ?>
                                                <option data-chained="<?= $kt['keterangan']; ?>" value="<?= $kt['id']; ?>"><?= $kt['nama_rev'] ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        Konseptor <button style="cursor:pointer;" type="button" class="btn btn-xs btn-primary my-5 add-konseptor">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table id="table-konseptor" class="table table-konseptor">
                                            <td>
                                                <input type="text" name="konseptor[1][nama]" id="nama_1" class="form-control" placeholder="Nama Konseptor">
                                            </td>
                                            <td>
                                                <input type="text" name="konseptor[1][instansi]" id="instansi_1" class="form-control" placeholder="Instansi Konseptor">
                                            </td>
                                            <td></td>
                                        </table>

                                        <table class="table table-bordered tbkonseptor mt-20" id="tbkonseptor">

                                            <tr>
                                                <td>
                                                    Nama
                                                    <input type="text" class="form-control" name="nama_konseptor" id="namakonseptor" placeholder="Nama Konseptor" value="<?= $detailuser['nama_lengkap']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Alamat
                                                    <input type="text" class="form-control" name="alamat_konseptor" id="alamatkonseptor" placeholder="Alamat Konseptor" value="<?= $detailuser['alamat']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    No. Telepon
                                                    <input type="text" class="form-control" name="telepon_konseptor" id="teleponkonseptor" placeholder="Telepon Konseptor" value="<?= $detailuser['no_handphone']; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Email
                                                    <input type="text" class="form-control" name="email_konseptor" id="emailkonseptor" placeholder="Email Konseptor" value="<?= $detailuser['email']; ?>">
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
                                        <textarea class="form-control mb-10" name="judul" placeholder="Judul Standar"></textarea>
                                        Ruang Lingkup
                                        <textarea class="form-control mb-10" name="ruang_lingkup" placeholder="Ruang Lingkup"></textarea>
                                        Informasi Detail Hasil Penelitian
                                        <textarea class="form-control mb-10" name="detail_penelitian" placeholder="Berikan informasi detil, termasuk hasil penelitian atau kajian terhadap penerapan standar tersebut, jika perlu, tulis pada lembaran terpisah sebagai lampiran"></textarea>

                                        Upload Lampiran Detail Hasil Penelitian
                                        <input class="mt-10" type="file" name="dok_detail_penelitian" data-plugin="dropify" data-height="70">

                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 40%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        Tujuan dan alasan spesifik mengenai perumusan yang akan dilakukan
                                        <textarea class="form-control mb-10" name="tujuan_perumusan" placeholder="Tujuan dan alasan spesifikasi mengenai perumusan yang akan dilakukan (termasuk alasan dilakukan amandemen/revisi/ralat untuk standar)"></textarea>

                                        Pihak-pihak utama yang berkepentingan <button style="cursor:pointer;" type="button" class="btn btn-xs btn-primary my-5 add-pihak">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table class="table tbpihak" id="tbpihak">
                                            <tr>
                                                <td><input type="text" class="form-control" name="pihak[1][nama]" placeholder="Pihak yang berkepentingan"></td>
                                            </tr>
                                        </table>

                                        Manfaat yang akan didapat dengan menerapkan dengan Standar yang diusulkan <button style="cursor:pointer;" type="button" class="btn btn-xs btn-primary add-manfaat">
                                            <li class="fa fa-plus"></li>
                                        </button><br>
                                        <table class="table my-5 tbmanfaat" id="tbmanfaat">
                                            <tr>
                                                <td><input type="text" name="manfaat[1][isi]" class="form-control" placeholder="Dalam kaitannya dengan keamanan, keselamatan, kesehatan, fungsi lingkungan hidup, ekonomi dan penguatan daya saing"></td>
                                            </tr>
                                        </table>

                                        Apakah terdapat organisasi yang mendukung usulan perumusan standar ini? (tidak termasuk pihak pengusul)
                                        <select onchange="changediv6()" name="org_pendukung" id="organisasipendukung" class="form-control mb-10">
                                            <option value="0">Tidak</option>
                                            <option value="1">Ya</option>
                                        </select>
                                        <div class="row">
                                            <div class="col-6" id="divres6">

                                            </div>
                                        </div>
                                        <div class="progress my-10">
                                            <div class="progress-bar progress-bar-striped active" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 60%" role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab">
                                        Upload Dokumen Surat Pengajuan PNPS/Standar <a href="<?= base_url() ?>assets/download/format_surat/format_surat_pengajuan.docx" target="_blank" class="btn btn-xs btn-primary">
                                            <li class="fa fa-download"></li> Format
                                        </a>
                                        <div class="col-lg-10 my-5">
                                            <input type='file' name='surat_pengajuan' id='surat_pengajuan' data-plugin='dropify' data-height=60>
                                        </div>

                                        Upload Outline RSNI/RSL <a href="<?= base_url() ?>assets/download/format_surat/format_outline.docx" target="_blank" class="btn btn-xs btn-primary">
                                            <li class="fa fa-download"></li> Format
                                        </a>
                                        <div class="col-lg-10 my-5">
                                            <input type='file' name='outline' id='outline' data-plugin='dropify' data-height=60>
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
                                        <table id="tbregulasi" class="table my-5 tbregulasi">
                                            <tr>
                                                <td><input type="text" class="form-control" name="regulasi[1][nama]" placeholder="Regulasi (Bisa lebih dari satu)"></td>
                                            </tr>
                                        </table>

                                        SNI Acuan Normatif &nbsp; <button type="button" style="cursor:pointer;" class="btn btn-xs btn-primary mb-5 add-acuan-sni">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table id="table_acuansni" class="table my-5 table_acuansni">
                                            <tr>
                                                <td><input type="text" class="form-control" name="acuansni[1][nama]" placeholder="Acuan SNI normatif"></td>
                                            </tr>
                                        </table>

                                        Acuan Non SNI &nbsp; <button type="button" style="cursor:pointer;" class="btn btn-xs btn-primary mb-5 add-acuan-nonsni">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table id="table_acuannonsni" class="table my-5 table_acuannonsni">
                                            <tr>
                                                <td><input type="text" class="form-control" name="acuannonsni[1][nama]" placeholder="Acuan non SNI"></td>
                                            </tr>
                                        </table>


                                        Bibliografi &nbsp; <button type="button" style="cursor:pointer;" class="btn btn-xs btn-primary mb-5 add-bibliografi">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table id="bibliografi" class="table my-5 bibliografi">
                                            <tr>
                                                <td><input type="text" class="form-control" name="bibliografi[1][nama]" placeholder="Bibliografi"></td>
                                            </tr>
                                        </table>

                                        LPK potensial dalam penerapan SNI &nbsp; <button type="button" style="cursor:pointer;" class="btn btn-xs btn-primary mb-5 add-lpk">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                        <table id="lpk" class="table my-5 lpk">
                                            <tr>
                                                <td><input type="text" class="form-control" name="lpk[1][nama]" placeholder="LPK potensial"></td>
                                            </tr>
                                        </table>

                                        Evaluasi Usulan
                                        <textarea class="form-control mb-10" name="evaluasi" placeholder="Semua usulan harus dievalusai untuk memastikan tidak terjadi duplikasi dengan standar yang telah ada. Jelaskan apabila terjadi duplikasi"></textarea>


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
<script src="<?= base_url('assets/') ?>global/js/jquery.chained.js"></script>
<script src="<?= base_url('assets/') ?>global/js/jquery.chained.min.js"></script>
<script src="<?= base_url('assets/') ?>global/js/jquery.chained.remote.js"></script>
<script src="<?= base_url('assets/') ?>global/js/jquery.chained.remote.min.js"></script>

<script>
    $("#jalurperumusan").chained("#jenisperumusan");
    $("#komite_teknis").chained("#jenis_standar");
</script>

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
            markup += "<td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
                    </button></td></tr>";

            $("#table-konseptor").append(markup);

            $('#nik_' + nextRow).on('change', function() {
                reload_instansi($(this).val(), nextRow);
            });
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
            var row = $('#table_acuansni').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='acuansni[" + nextRow + "][nama]' placeholder='Acuan SNI' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#table_acuansni").append(markup);
        });

        $(".table_acuansni").on('click', '.remRow', function() {
            var num_rows = $("#table_acuansni tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-acuan-nonsni").click(function() {
            var row = $('#table_acuannonsni').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='acuannonsni[" + nextRow + "][nama]' placeholder='Acuan Non SNI' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#table_acuannonsni").append(markup);
        });

        $(".table_acuannonsni").on('click', '.remRow', function() {
            var num_rows = $("#table_acuannonsni tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-bibliografi").click(function() {
            var row = $('#bibliografi').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='bibliografi[" + nextRow + "][nama]' placeholder='Bibliografi' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#bibliografi").append(markup);
        });

        $(".bibliografi").on('click', '.remRow', function() {
            var num_rows = $("#bibliografi tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

        $(".add-lpk").click(function() {
            var row = $('#lpk').find('tr').length;
            var nextRow = row + 1;
            var markup = "<tr><td><input type='text' name='lpk[" + nextRow + "][nama]' placeholder='LPK Potensial' id='nama_" + nextRow + "' class='form-control'>";
            markup += "<td><button class='btn btn-danger remRow'><i class='fa fa-trash'></i>\
              </button></td></tr>";

            $("#lpk").append(markup);
        });

        $(".lpk").on('click', '.remRow', function() {
            var num_rows = $("#lpk tr").length;
            if (num_rows == 0) {
                return false;
            } else {
                $(this).parent().parent().remove();
            }
        });

    });




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
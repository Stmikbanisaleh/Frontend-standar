<!-- Page -->
<div class="page">

    <div class="page-content container-fluid">
        <div class="panel">
            <ol class=" breadcrumb" style="background-color:#fff;">
                <li class=" breadcrumb-item">Pembatalan</li>
                <li class="breadcrumb-item active">Pembatalan Usulan</li>
                <div class="text-right">
                    Role User : <b>Sekretariat</b>
                </div>
            </ol>

        </div>
        <!-- Panel Tabs -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <li class="fa fa-file-text"></li> Pembatalan Usulan Standar
                </h4>
            </div>
            <div class="panel-body container-fluid my-10">
                <div class="panel">
                    <div class="panel-body container-fluid">
                        <div class="row row-lg">
                            <div class="col-xl-8">

                                <form enctype="multipart/form-data" method="post" action="<?= base_url('pembatalan/save'); ?>">
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                                    Judul Standar
                                    <select id="id_usulan" onchange="gantiJenis()" class="form-control my-10" name="id_usulan" value="<?= set_value('id_usulan'); ?>">
                                        <option value="">Pilih Judul Standar</option>
                                        <?php foreach ($usulan as $usul) : ?>
                                            <option value="<?= $usul['id']; ?>"><?= $usul['judul'] ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    Alasan Pembatalan
                                    <textarea class="form-control mb-10" name="alasan" placeholder="Alasan Pembatalan"></textarea>

                                    Surat Resmi Pembatalan (.pdf)
                                    <input type='file' name='dok_pembatalan' id='dok_pembatalan' data-plugin='dropify' data-height=60>
                                    <div class="text-right">
                                        <button type="submit" style="cursor:pointer;" class="btn btn-primary my-10">Save</button>
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

<script src="<?= base_url('assets/') ?>global/vendor/jquery/jquery.js"></script>
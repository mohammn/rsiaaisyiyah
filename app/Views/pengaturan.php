<?php

/** @var string $waktu */
?>
<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="row m-3">
    <div class="col-md-6 p-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pengaturan</h4>
            </div>
            <div class="card-body">
                Edit Waktu :
                <div class="form-check  form-switch">
                    <input class="form-check-input" type="checkbox" value="1" onchange="waktu()" <?= $waktu ? 'checked' : '' ?> id="waktu">
                    <label class="form-check-label" for="waktu">
                        Jam dan Tanggal
                    </label>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-6 p-1">
    </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus User</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="idHapus" name="idHapus">
                <p>Apakah anda yakin ingin menghapus <b id="detailHapus">....</b> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="hapus()" class="btn btn-info">Hapus</button>
                <button type="button" class="btn btn-secondary" onclick="tutupModalHapus()">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    function waktu() {
        $.ajax({
            url: '<?= base_url() ?>pengaturan/ubahWaktu',
            method: 'post',
            dataType: 'json',
            success: function(data) {}
        });
    }
</script>
<?php $this->endSection() ?>
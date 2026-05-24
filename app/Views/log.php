<?php

/** @var object $data */
?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>


<div class="container-fluid px-4">
    <h3 class="mt-4">Rekam Medis Pasien</h3>
    <div class="card mb-4">
        <div class="card-body" style="overflow-y: auto;">
            <table class="table table-striped table-responsive-lg" id="tabelLog">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tabel</th>
                        <th>No RM / Rawat</th>
                        <th>Petugas</th>
                        <th>Waktu</th>
                        <th>Tindakan</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody id="tabelDataLog">
                    <?php
                    foreach ($data->log as $log) {
                        echo '<tr>';
                        echo '<td>' . $log["id"] . '</td>';
                        echo '<td>' . $log["tabel"] . '</td>';
                        echo '<td>' . $log["noRawat"] . '</td>';
                        echo '<td>' . $log["petugas"] . '</td>';
                        echo '<td>' . $log["waktu"] . '</td>';
                        echo '<td>' . $log["tindakan"] . '</td>';
                        echo '<td><button onclick="lihatSkor(' . $log["id"] . ')" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-bars"></i> Detail</button></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal modal-lg fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Log data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                No Rawat : <b id="noRawat"></b>. tabel : <b id="namaTabel"></b>.
                <br>
                <br>
                Data Lama :
                <pre class="bg-light p-2 border" style="white-space: pre-wrap;" id="tempatDataLama">

                </pre>

                <br>
                Data Baru :
                <pre class="bg-light p-2 border" style="white-space: pre-wrap;" id="tempatDataBaru">

                </pre>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-hapus" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tabelLog').DataTable({
        "language": {
            "url": "<?= base_url('public/js/Indonesian.json') ?>" // Opsional: Bahasa Indonesia
        },
        "order": [
            [0, "desc"]
        ],
        "responsive": true,
        "retrieve": true // Memastikan data baru yang diambil masuk ke table
    });

    function lihatSkor(id) {
        $("#modalDetail").modal("show");
        $.ajax({
            url: '<?= base_url() ?>log/muatLog/' + id,
            method: 'get',
            dataType: 'json',
            success: function(data) {
                $("#namaTabel").html(data.tabel);
                $("#noRawat").html(data.noRawat);

                $("#tempatDataLama").html(JSON.stringify(JSON.parse(data.dataLama), null, 2));
                $("#tempatDataBaru").html(JSON.stringify(JSON.parse(data.dataBaru), null, 2));
            }
        });
    }
</script>

<?php $this->endSection() ?>
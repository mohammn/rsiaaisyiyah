<?php

/** @var object $data */
?>
<form>
    <?= csrf_field() ?>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <input type="hidden" name="id" value="">

    <div class="row alert alert-info">
        <div class="col-md-6">
            <label class="form-label fw-bold">Jenis Obat</label>
            <small class="text-muted d-block mb-2">(Nama Dagang / Generik / Herbal / Fitofarmaka)</small>

            <select id="namaObat" name="namaObat" placeholder="Cari nama obat lengkap..." required autocomplete="off">
                <option value=""></option>
                <?php foreach ($data->dataObat as $obat) : ?>
                    <option value="<?= $obat['nama_brng']  ?>"><?= $obat['nama_brng']  ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <script>
            var tomSelectObat = new TomSelect("#namaObat", {
                create: false, // Menutup akses untuk menambah data baru di luar list
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                maxOptions: 10,

                // Bahasa Indonesia tetap dipasang untuk menangani jika pencarian kosong
                render: {
                    no_results: function(data, escape) {
                        return '<div class="no-results" style="padding: 6px 10px; color: #35cedc;">Obat tidak ditemukan.</div>';
                    }
                }
            });
        </script>
        <div class="col-md-6 border border-info rounded p-3">
            <label class="form-label d-block fw-bold mb-1" style="font-size: 0.9rem;">Ruangan *</label>
            <div class="btn-group btn-group-sm w-100" role="group">
                <input type="radio" class="btn-check" name="ruangan" id="igd" value="igd" checked>
                <label class="btn btn-outline-info py-1" for="igd">
                    <i class="fas fa-hospital-user fa-sm me-1"></i> IGD
                </label>

                <input type="radio" class="btn-check" name="ruangan" id="ko" value="ko">
                <label class="btn btn-outline-info py-1" for="ko">
                    <i class="fas fa-procedures fa-sm me-1"></i> Kamar Operasi
                </label>

                <input type="radio" class="btn-check" name="ruangan" id="rr" value="rr">
                <label class="btn btn-outline-info py-1" for="rr">
                    <i class="fas fa-bed fa-sm me-1"></i> Ruang Recovery
                </label>

                <input type="radio" class="btn-check" name="ruangan" id="ri" value="ri">
                <label class="btn btn-outline-info py-1" for="ri">
                    <i class="fas fa-clinic-medical fa-sm me-1"></i> Rawat Inap
                </label>
            </div>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Dosis</label>
            <input type="text" name="dosis" class="form-control" placeholder="Contoh: 500 mg / 5 ml / 10 unit" required>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Frekuensi</label>
            <input type="text" name="frekuensi" class="form-control" placeholder="Contoh: 3x1" required>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Cara Pemberian</label>
            <input type="text" name="caraPemberian" class="form-control" placeholder="Contoh: PO / IV" required>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Waktu Pemberian Terakhir</label>
            <input type="datetime-local" name="waktuTerakhir" class="form-control">
        </div>

        <div class="col-md-4">
            <label class="form-label d-block fw-bold mb-1" style="font-size: 0.9rem;">Obat Digunakan Saat Dirawat *</label>
            <div class="btn-group btn-group-sm w-50" role="group">
                <input type="radio" class="btn-check" name="dirawat" id="dirawatYa" value="ya" checked>
                <label class="btn btn-outline-info py-1" for="dirawatYa">
                    <i class="fas fa-check fa-sm me-1"></i> ya
                </label>

                <input type="radio" class="btn-check" name="dirawat" id="dirawatTidak" value="tidak">
                <label class="btn btn-outline-secondary py-1" for="dirawatTidak">
                    <i class="fas fa-times fa-sm me-1"></i> tidak
                </label>
            </div>
        </div>

        <div class="col-md-4">
            <label class="form-label d-block fw-bold mb-1" style="font-size: 0.9rem;">Obat Diteruskan Ketika Keluar RS *</label>
            <div class="btn-group btn-group-sm w-50" role="group">
                <input type="radio" class="btn-check" name="keluar" id="keluarYa" value="ya">
                <label class="btn btn-outline-info py-1" for="keluarYa">
                    <i class="fas fa-check fa-sm me-1"></i> ya
                </label>

                <input type="radio" class="btn-check" name="keluar" id="keluarTidak" value="tidak" checked>
                <label class="btn btn-outline-secondary py-1" for="keluarTidak">
                    <i class="fas fa-times fa-sm me-1"></i> tidak
                </label>
            </div>
        </div>
    </div>
</form>
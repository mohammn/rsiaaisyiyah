<?php

/** @var object $data */
// dd($data->resepPulang);
?>
<form id="formPemberianObat">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <div class="row mb-4">
                    <div class="col-12 text-center">Pemberian Obat :</div>
                    <hr>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama obat yang diberikan</th>
                                <th>Jumlah obat</th>
                                <th>Aturan pakai</th>
                                <th>Pagi</th>
                                <th>Siang</th>
                                <th>Sore</th>
                                <th>Malam</th>
                                <th>Instruksi Khusus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($data->resepPulang); $i++) :
                                $kodeBrng = $data->resepPulang[$i]['kode_brng'];
                                // Ambil detail obat anak jika data sudah pernah disimpan sebelumnya
                                $detailObat = $data->obatPulangData[$kodeBrng] ?? null;
                            ?>
                                <tr class="baris-obat">
                                    <td>
                                        <?= $i + 1 ?>
                                        <input type="hidden" class="kode-brng" value="<?= $kodeBrng ?>">
                                    </td>
                                    <td><?= $data->resepPulang[$i]['nama_brng'] ?></td>
                                    <td><?= $data->resepPulang[$i]['jml_barang'] ?></td>
                                    <td><?= $data->resepPulang[$i]['dosis'] ?></td>
                                    <!-- Input Time: Pagi -->
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="time" class="form-control jam-pagi" id="pagi_<?= $i ?>"
                                                value="<?= $detailObat === null ? '06:00' : ($detailObat['pagi'] ?? '') ?>">
                                            <button type="button" class="btn btn-outline-danger" onclick="resetTime('pagi_<?= $i ?>')" title="Reset Jam">x</button>
                                        </div>
                                    </td>

                                    <!-- Input Time: Siang -->
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="time" class="form-control jam-siang" id="siang_<?= $i ?>"
                                                value="<?= $detailObat === null ? '14:00' : ($detailObat['siang'] ?? '') ?>">
                                            <button type="button" class="btn btn-outline-danger" onclick="resetTime('siang_<?= $i ?>')" title="Reset Jam">x</button>
                                        </div>
                                    </td>

                                    <!-- Input Time: Sore -->
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="time" class="form-control jam-sore" id="sore_<?= $i ?>"
                                                value="<?= $detailObat === null ? '18:00' : ($detailObat['sore'] ?? '') ?>">
                                            <button type="button" class="btn btn-outline-danger" onclick="resetTime('sore_<?= $i ?>')" title="Reset Jam">x</button>
                                        </div>
                                    </td>

                                    <!-- Input Time: Malam -->
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="time" class="form-control jam-malam" id="malam_<?= $i ?>"
                                                value="<?= $detailObat === null ? '22:00' : ($detailObat['malam'] ?? '') ?>">
                                            <button type="button" class="btn btn-outline-danger" onclick="resetTime('malam_<?= $i ?>')" title="Reset Jam">x</button>
                                        </div>
                                    </td>

                                    <!-- Input Instruksi Khusus -->
                                    <td>
                                        <input type="text" class="form-control form-control-sm instruksi" value="<?= $detailObat['instruksi'] ?? '' ?>">
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas :</label>
                        <input type="text" class="form-control mb-2" id="petugas" value="<?= $data->obatPulang['petugas'] ?? session()->get('nama') ?>" disabled>

                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Yang Menerima :</label>
                        <input type="text" class="form-control" id="nama" value="<?= $data->obatPulang['nama'] ?? '' ?>">

                        <div class="d-flex align-items-center gap-3">
                            <div class="form-check form-check-inline m-0">
                                <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                                <label class="form-check-label small" for="samaDgPj">Sama dg PJ</label>
                            </div>

                            <div class="form-check form-check-inline m-0">
                                <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                                <label class="form-check-label small" for="samaDgPasien">Sama dengan pasien</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Keterangan :</label>
                        <textarea name="keterangan" id="keterangan" class="form-control"><?= $data->obatPulang['keterangan'] ?? '' ?></textarea>

                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Ruang Rawat :</label>
                        <input type="text" class="form-control" id="ruang" value="<?= $data->obatPulang['ruang'] ?? '' ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    function resetTime(inputId) {
        document.getElementById(inputId).value = '';
    }
</script>
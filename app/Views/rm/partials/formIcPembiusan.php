<?php

/** @var object $data */
?>

<style>
    /* Membuat semua input yang readonly otomatis berlatar belakang abu-abu dan kursor dilarang */
    input[readonly],
    textarea[readonly] {
        background-color: #e9ecef !important;
        /* Warna abu-abu khas disabled Bootstrap */
        opacity: 1;
        cursor: not-allowed;
        /* Mengubah ikon kursor menjadi tanda dilarang */
    }
</style>
<form>
    <div class="row">
        <div class="col-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>
                <input type="hidden" class="form-control" id="petugas" value="<?= $data->icPembiusan['petugas'] ?? session()->get('nama') ?>">
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->icPembiusan['nama'] ?? '' ?>"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" <?= (empty($data->icPembiusan['jk'])) ? 'selected' : '' ?> disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?= (($data->icPembiusan['jk'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= (($data->icPembiusan['jk'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?= $data->icPembiusan['tempatLahir'] ?? '' ?>">
                    </div>
                    <div class="col-2">
                        Tgl Lahir :
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control" value="<?= $data->icPembiusan['tanggalLahir'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-8">
                        <input type="text" class="form-control" id="nik" placeholder="Nomor Identitas (NIK)" value="<?= $data->icPembiusan['nik'] ?? '' ?>">
                    </div>
                    <div class="col-4">
                        <div class="form-check pt-2">
                            <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                            <label class="form-check-label" for="samaDgPj">Sama dg PJ</label>
                        </div>
                    </div>
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="vol-12">
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data->icPembiusan['alamat'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sebagai" class="form-label">Beritindak sebagai :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <div class="pt-5 form-check">
                            <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                            <label class="form-check-label" for="samaDgPasien">Sama dengan pasien</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-2">
                    <div class="col-6">
                        <label for="petugas" class="form-label">Dokter :</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="" <?= (empty($data->icPembiusan['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (($data->icPembiusan['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="saksi" class="form-label">Saksi :</label>
                        <input type="text" class="form-control" id="saksi" value="<?= $data->icPembiusan['saksi'] ?? '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="tindakanMedis" class="form-label">Tindakan medis :</label>
                        <input type="text" class="form-control" id="tindakanMedis" value="<?= $data->icPembiusan['tindakanMedis'] ?? '' ?>">
                    </div>
                    <div class="col-md-6 mt-2 mt-md-0  border border-info rounded">
                        <label class="form-label d-block fw-bold text-info-emphasis mb-0" style="font-size: 0.9rem;">
                            JENIS <i>INFORMED CONSENT</i> :
                        </label>
                        <div class="btn-group btn-group-sm w-100" role="group">
                            <input type="radio" class="btn-check" name="jenis" id="setuju" value="PERSETUJUAN"
                                <?= (($data->icPembiusan['jenis'] ?? 'PERSETUJUAN') === 'PERSETUJUAN') ? 'checked' : '' ?>>
                            <label class="btn btn-outline-success py-2 fw-bold" for="setuju" style="font-size: 0.75rem; white-space: nowrap;">
                                <i class="fas fa-check fa-sm me-1"></i> PERSETUJUAN
                            </label>

                            <input type="radio" class="btn-check" name="jenis" id="tolak" value="PENOLAKAN"
                                <?= (($data->icPembiusan['jenis'] ?? '') === 'PENOLAKAN') ? 'checked' : '' ?>>
                            <label class="btn btn-outline-danger py-2 fw-bold" for="tolak" style="font-size: 0.75rem; white-space: nowrap;">
                                <i class="fas fa-times fa-sm me-1"></i> PENOLAKAN
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <label class="form-label fw-bold text-info-emphasis mb-3">Tindakan Anestesi / Pembiusan :</label>

                        <div class="d-flex flex-column gap-2">

                            <div class="row g-2">
                                <div class="col-md-8 col-12">
                                    <div class="card border-light bg-light-subtle p-2 h-100">
                                        <span class="fw-bold mb-1 text-secondary" style="font-size: 0.85rem;">a. ANESTESI REGIONAL</span>
                                        <div class="d-flex gap-3 ms-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_anestesi" id="spinal" value="Spinal/Epidural"
                                                    <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'Spinal/Epidural') ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="spinal">Spinal / Epidural</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_anestesi" id="blok" value="Blok Syaraf Perifer"
                                                    <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'Blok Syaraf Perifer') ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="blok">Blok Syaraf Perifer</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="card border-light bg-light-subtle p-2 h-100 d-flex justify-content-center">
                                        <div class="form-check ms-1 mb-0">
                                            <input class="form-check-input" type="radio" name="jenis_anestesi" id="umum" value="Anestesi Umum"
                                                <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'Anestesi Umum') ? 'checked' : '' ?>>
                                            <label class="form-check-label fw-bold text-secondary mb-0" for="umum" style="font-size: 0.85rem;">b. ANESTESI UMUM</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="card border-light bg-light-subtle p-2">
                                        <div class="row align-items-center g-2">
                                            <div class="col-auto">
                                                <div class="form-check ms-1">
                                                    <input class="form-check-input" type="radio" name="jenis_anestesi" id="kombinasi" value="kombinasi"
                                                        <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'kombinasi') ? 'checked' : '' ?>>
                                                    <label class="form-check-label fw-bold text-secondary mb-0" for="kombinasi" style="font-size: 0.85rem;">c. ANESTESI KOMBINASI :</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" id="isiKombinasi" name="isiKombinasi" placeholder="Sebutkan jenis kombinasi..."
                                                    value="<?= $data->icPembiusan['isiKombinasi'] ?? '' ?>"
                                                    <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'kombinasi') ? '' : ' readonly' ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-4">
                    <div class="col-12 text-center">Pemberian informasi :</div>
                    <hr>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="diagnosa" class="form-label">Dianosa (WD&DD) :</label>
                        <textarea type="text" class="form-control" id="diagnosa"><?= $data->icPembiusan['diagnosa'] ?? '' ?></textarea>
                    </div>
                    <div class="col-6">
                        <label for="indikasi" class="form-label">Indikasi Tindakan :</label>
                        <textarea type="text" class="form-control" id="indikasi"><?= $data->icPembiusan['indikasi'] ?? '' ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="tataCara" class="form-label">Tata cara :</label>
                        <textarea type="text" class="form-control" id="tataCara" readonly><?= $data->icPembiusan['tataCara'] ?? '' ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="tujuan" class="form-label">Tujuan :</label>
                        <textarea type="text" class="form-control" id="tujuan" readonly><?= $data->icPembiusan['tujuan'] ?? '' ?></textarea>
                    </div>
                    <div class="col-6">
                        <label for="komplikasi" class="form-label">Komplikasi :</label>
                        <textarea type="text" class="form-control" id="komplikasi" readonly><?= $data->icPembiusan['komplikasi'] ?? '' ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="risiko" class="form-label">Risiko :</label>
                        <textarea type="text" class="form-control" id="risiko" readonly><?= $data->icPembiusan['risiko'] ?? '' ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="prognosis" class="form-label">Prognosis :</label>
                        <textarea type="text" class="form-control" id="prognosis"><?= $data->icPembiusan['prognosis'] ?? '' ?></textarea>
                    </div>
                    <div class="col-6">
                        <label for="alternatif" class="form-label">Alternatif :</label>
                        <textarea type="text" class="form-control" id="alternatif" readonly><?= $data->icPembiusan['alternatif'] ?? '' ?></textarea>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label for="lainLain" class="form-label">Lain - lain :</label>
                        <textarea type="text" class="form-control" id="lainLain"><?= $data->icPembiusan['lainLain'] ?? '' ?></textarea>
                    </div>
                </div>
                <small class="fst-italic m-3"><mark>*isian yang tidak dapat diedit, tidak ditampilkan saat di cetak.</mark></small>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        // Monitor perubahan pada semua radio button bernama 'jenis_anestesi'
        $('input[name="jenis_anestesi"]').on('change', function() {
            if ($('#kombinasi').is(':checked')) {
                // Jika opsi kombinasi dipilih, aktifkan input text dan arahkan fokus kursor
                $('#isiKombinasi').prop('readonly', false).focus();
                $('#tataCara').prop('readonly', false);
                $('#tujuan').prop('readonly', false);
                $('#risiko').prop('readonly', false);
                $('#komplikasi').prop('readonly', false);

            } else {
                // Hanya kosongkan 'isiKombinasi' karena field ini spesifik milik opsi kombinasi
                $('#isiKombinasi').prop('readonly', true);

                // Untuk field utama, CUKUP KUNCI SAJA (jangan dikosongkan val-nya agar data DB tidak hilang)
                $('#tataCara').prop('readonly', true);
                $('#tujuan').prop('readonly', true);
                $('#risiko').prop('readonly', true);
                $('#komplikasi').prop('readonly', true);
            }

            if ($('#spinal').is(':checked')) {
                $('#alternatif').prop('readonly', true); // Cukup kunci, jangan pakai .val('')
            } else {
                $('#alternatif').prop('readonly', false);
            }
        });
    });
</script>
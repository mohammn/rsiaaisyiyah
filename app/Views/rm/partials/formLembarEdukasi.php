<?php

/** @var object $data */
$indikasiIbu = !empty($data->icSesar['indikasiIbu']) ? explode('|', $data->icSesar['indikasiIbu']) : [];
$indikasiJanin = !empty($data->icSesar['indikasiJanin']) ? explode('|', $data->icSesar['indikasiJanin']) : [];
?>
<style>
    /* Efek hover pada pembungkus form-check */
    .hover-check {
        padding: 0px 30px;
        border-radius: 6px;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .hover-check:hover {
        background-color: #f0f7ff;
        /* Warna biru muda transparan */
        color: #70a9ff;
        /* Mengubah warna teks menjadi biru Bootstrap */
    }

    /* Membuat kursor pointer saat mengarah ke checkbox dan labelnya */
    .hover-check .form-check-input,
    .hover-check .form-check-label {
        cursor: pointer;
    }
</style>
<form>
    <?php
    // Ekstrak data edukasi agar kodenya pendek dan aman dari error 'undefined index'
    $edu = $data->lembarEdukasi;

    $petugas_val      = $edu['petugas'] ?? session()->get('nama');
    $nama_val         = $edu['nama'] ?? '';
    $agama_terpilih   = $edu['agama'] ?? '';
    $bahasa_terpilih  = $edu['bahasa'] ?? '';
    $penerjemah_val   = $edu['penerjemah'] ?? '';
    $pendidikan_terpilih    = $edu['pendidikan'] ?? '';
    $baca_tulis_val   = $edu['baca_tulis'] ?? '';
    $komunikasi_val   = $edu['komunikasi'] ?? '';
    $hambatan_val     = $edu['hambatan_edukasi'] ?? '';
    $intervensi_val   = $edu['intervensi_hambatan'] ?? '';
    $nilai_keyakinan  = $edu['nilai_keyakinan'] ?? '';
    $kesediaan_inf    = $edu['kesediaan_informasi'] ?? '';

    // Logika pemecah untuk input "Ya: Penjelasan..." atau "Lainnya" yang digabung saat simpan
    $bahasa_lainnya_input = (!in_array($bahasa_terpilih, ['Indonesia', 'Inggris', 'Daerah', ''])) ? $bahasa_terpilih : '';
    $pendidikan_lainnya_input = (!in_array($pendidikan_terpilih, ['SD', 'SMP', 'SMA', 'D3', 'S1', ''])) ? $pendidikan_terpilih : '';
    $hambatan_lainnya_input = (!in_array($hambatan_val, ['Tidak ada', 'Gangguan penglihatan', 'Gangguan pendengara', 'Keterbatasan kognitif', 'Motivasi Kurang', 'Gangguan bicara', 'Gangguan proses emosional', ''])) ? $hambatan_val : '';

    $baca_tulis_detail = '';
    if (strpos($baca_tulis_val, 'Ya: ') === 0) {
        $baca_tulis_detail = substr($baca_tulis_val, 4);
        $baca_tulis_val = 'Ya';
    }

    $komunikasi_detail = '';
    if (strpos($komunikasi_val, 'Ya: ') === 0) {
        $komunikasi_detail = substr($komunikasi_val, 4);
        $komunikasi_val = 'Ya';
    }
    ?>

    <div class="row">
        <div class="col-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>
                <input type="hidden" class="form-control" id="petugas" value="<?= $petugas_val ?>">
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-12"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $nama_val ?>"></div>
                </div>

                <div class="row mb-2 mt-2 d-flex gap-2">
                    <div class="col-8 border border-info rounded pb-2">
                        <label class="form-label d-block fw-bold">Agama</label>
                        <?php
                        $list_agama = ['Islam', 'Budha', 'Kristen', 'Hindu', 'Katolik', 'Konghuchu'];
                        foreach ($list_agama as $agm) :
                            $slug = strtolower($agm);
                        ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="agama" id="agama_<?= $slug ?>" value="<?= $agm ?>" <?= ($agama_terpilih === $agm) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="agama_<?= $slug ?>"><?= $agm ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="col border border-dark rounded pt-2">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                            <label class="form-check-label" for="samaDgPasien">Sama dg pasien</label>
                        </div>
                        <div class="form-check pt-1">
                            <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                            <label class="form-check-label" for="samaDgPj">Sama dg PJ</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-2 align-items-center border border-info rounded pt-2">
                    <div class="col-12 pb-2">
                        <label class="fw-bold text-nowrap">Bahasa yang digunakan :</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bahasa" id="bahasa_indonesia" value="Indonesia" <?= ($bahasa_terpilih === 'Indonesia') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="bahasa_indonesia">Indonesia</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bahasa" id="bahasa_inggris" value="Inggris" <?= ($bahasa_terpilih === 'Inggris') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="bahasa_inggris">Inggris</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bahasa" id="bahasa_daerah" value="Delta" <?= ($bahasa_terpilih === 'Daerah') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="bahasa_daerah">Daerah</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bahasa" id="bahasa_lainnya_radio" value="Lainnya" <?= (!empty($bahasa_lainnya_input)) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="bahasa_lainnya_radio">
                                <input type="text" name="bahasa_lainnya_input" class="form-control form-control-sm d-inline-block w-auto ms-1" placeholder="isi lainnya.." value="<?= $bahasa_lainnya_input ?>" onclick="document.getElementById('bahasa_lainnya_radio').checked = true;">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-2 align-items-center border border-info rounded pt-2">
                    <div class="col-12 pb-2">
                        <label class="fw-bold text-nowrap">Kebutuhan Penerjemah : </label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="penerjemah" id="penerjemah_perlu" value="Perlu" <?= ($penerjemah_val === 'Perlu') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="penerjemah_perlu">Perlu</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="penerjemah" id="penerjemah_tidak" value="Tidak Perlu" <?= ($penerjemah_val === 'Tidak Perlu') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="penerjemah_tidak">Tidak Perlu</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-2 align-items-center border border-info rounded pt-2">
                    <div class="col-12 pb-2">
                        <label class="fw-bold text-nowrap">Pendidikan :</label>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan_sd" value="SD" <?= ($pendidikan_terpilih === 'SD') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="pendidikan_sd">SD</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan_smp" value="SMP" <?= ($pendidikan_terpilih === 'SMP') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="pendidikan_smp">SMP</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan_sma" value="SMA" <?= ($pendidikan_terpilih === 'SMA') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="pendidikan_sma">SMA</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan_d3" value="D3" <?= ($pendidikan_terpilih === 'D3') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="pendidikan_d3">D3</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan_s1" value="S1" <?= ($pendidikan_terpilih === 'S1') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="pendidikan_s1">S1</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pendidikan" id="pendidikan_lainnya_radio" value="Lainnya" <?= (!empty($pendidikan_lainnya_input) || $pendidikan_terpilih === 'Lainnya') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="pendidikan_lainnya_radio">
                                <input type="text" name="pendidikan_lainnya_input" class="form-control form-control-sm d-inline-block w-auto ms-1" placeholder="isi lainnya.." value="<?= $pendidikan_lainnya_input ?>" onclick="document.getElementById('pendidikan_lainnya_radio').checked = true;">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center border border-info rounded pt-2 mb-5">
                    <div class="col-12 pb-2">
                        <label class="fw-bold text-nowrap">Kesulitan Baca Tulis :</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bacaTulis" id="bacaTulis_tdk" value="Tidak" <?= ($baca_tulis_val === 'Tidak') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="bacaTulis_tdk">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bacaTulis" id="bacaTulis_ya" value="Ya" <?= ($baca_tulis_val === 'Ya') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="bacaTulis_ya">
                                Ya,
                                <input type="text" name="bacaTulisPenjelasan" class="form-control form-control-sm d-inline-block w-auto ms-1" placeholder="jelaskan.." value="<?= $baca_tulis_detail ?>" onclick="document.getElementById('bacaTulis_ya').checked = true;">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>

                <div class="row mb-2 align-items-center border border-info rounded pt-2">
                    <div class="col-12 pb-2">
                        <label class="fw-bold text-nowrap">Kesulitan Komunikasi :</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="komunikasi" id="komunikasi_tdk" value="Tidak" <?= ($komunikasi_val === 'Tidak') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="komunikasi_tdk">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="komunikasi" id="komunikasi_ya" value="Ya" <?= ($komunikasi_val === 'Ya') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="komunikasi_ya">
                                Ya,
                                <input type="text" name="komunikasiPenjelasan" class="form-control form-control-sm d-inline-block w-auto ms-1" placeholder="jelaskan.." value="<?= $komunikasi_detail ?>" onclick="document.getElementById('komunikasi_ya').checked = true;">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-2 align-items-center border border-info rounded pt-2">
                    <div class="col-12 pb-2">
                        <label class="fw-bold text-nowrap">Hambatan Edukasi</label>
                        <br>
                        <?php
                        $list_hambatan = [
                            'Tidak ada' => 'hambatan_tidak_ada',
                            'Gangguan penglihatan' => 'hambatan_penglihatan',
                            'Gangguan pendengara' => 'hambatan_pendengaran',
                            'Keterbatasan kognitif' => 'hambatan_kognitif',
                            'Motivasi Kurang' => 'hambatan_motivasi',
                            'Gangguan bicara' => 'hambatan_bicara',
                            'Gangguan proses emosional' => 'hambatan_emosional'
                        ];
                        foreach ($list_hambatan as $key => $id_attr) :
                        ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hambatan_edukasi" id="<?= $id_attr ?>" value="<?= $key ?>" <?= ($hambatan_val === $key) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="<?= $id_attr ?>"><?= $key ?></label>
                            </div>
                        <?php endforeach; ?>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="hambatan_edukasi" id="hambatan_lainnya_radio" value="Lainnya" <?= (!empty($hambatan_lainnya_input)) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="hambatan_lainnya_radio">
                                <input type="text" name="hambatan_lainnya_input" class="form-control form-control-sm d-inline-block w-auto ms-1" placeholder="isi lainnya.." value="<?= $hambatan_lainnya_input ?>" onclick="document.getElementById('hambatan_lainnya_radio').checked = true;">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-2 align-items-center border border-info rounded pt-2">
                    <div class="col-12 pb-2">
                        <label class="fw-bold text-nowrap">Intervensi Hambatan</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="intervensi_hambatan" id="intervensi_tidak_ada" value="Tidak ada" <?= ($intervensi_val === 'Tidak ada') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="intervensi_tidak_ada">Tidak ada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="intervensi_hambatan" id="intervensi_penerjemah" value="Menggunakan penerjemah" <?= ($intervensi_val === 'Menggunakan penerjemah') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="intervensi_penerjemah">Menggunakan penerjemah</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="intervensi_hambatan" id="intervensi_mengulangi_edukasi" value="Mengulangi edukasi" <?= ($intervensi_val === 'Mengulangi edukasi') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="intervensi_mengulangi_edukasi">Mengulangi edukasi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="intervensi_hambatan" id="intervensi_keluargasi" value="Mengulangi keluargasi" <?= ($intervensi_val === 'Mengulangi keluargasi') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="intervensi_keluargasi">Mengulangi keluargasi</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-2 align-items-center border border-info rounded py-2">
                    <div class="col-auto">
                        <label class="text-nowrap">Nilai – nilai dan keyakinan yang dianut :</label>
                    </div>
                    <div class="col">
                        <input type="text" name="nilai_keyakinan" class="form-control form-control-sm w-100" value="<?= $nilai_keyakinan ?>">
                    </div>
                </div>

                <div class="row align-items-center border border-info rounded py-2 mb-2">
                    <div class="col-auto">
                        <label class="text-nowrap">Kesediaan Pasien/keluarga* menerima informasi :</label>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline mb-0">
                            <input class="form-check-input" type="radio" name="kesediaan_informasi" id="kesediaan_ya" value="Ya" <?= ($kesediaan_inf === 'Ya') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="kesediaan_ya">Ya</label>
                        </div>
                        <div class="form-check form-check-inline mb-0">
                            <input class="form-check-input" type="radio" name="kesediaan_informasi" id="kesediaan_tidak" value="Tidak" <?= ($kesediaan_inf === 'Tidak') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="kesediaan_tidak">Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p style="font-size: 8pt; line-height: 1.5;" class="mb-0  border border-info rounded bg-light p-2">
                            Keterangan Evaluasi : <br>
                            1 = Tidak Mengerti: Pasien/keluarga tidak dapat memahami edukasi sama. <br>
                            2 = Kurang Mengerti: Pasien/keluarga bingung dan membutuhkan edukasi ulang. <br>
                            3 = Cukup Mengerti: Pasien/keluarga hanya memahami poin-poin utama. <br>
                            4 = Mengerti: Pasien/keluarga mampu menjelaskan, tetapi dibantu sedikit oleh edukator. <br>
                            5 = Sangat Mengerti: Pasien/keluarga mampu menjelaskan kembali materi tanpa kesalahan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Isian informasi :</div>
                    <hr>
                </div>
                <?php
                // Ambil baris data utama
                $edu = $data->lembarEdukasi;

                // --- PREPARASI DATA ITEM 1 ---
                $tgl_1      = $edu['tgl_1'] ?? '';
                $evaluasi_1 = $edu['evaluasi_1'] ?? '';
                $lainnya_1  = $edu['lainnya_1'] ?? '';
                // Pecah string metode & media menjadi array
                // Tambahkan array_map('trim', ...) untuk menghapus spasi di awal/akhir kata
                $metode_1_arr = isset($edu['metode_1']) ? array_map('trim', explode(',', $edu['metode_1'])) : [];
                $media_1_arr = isset($edu['media_1']) ? array_map(function ($item) {
                    return preg_replace('/^[\s\x00-\x1F\x7F\xA0]+|[\s\x00-\x1F\x7F\xA0]+$/u', '', $item);
                }, explode(',', $edu['media_1'])) : [];
                $petugas_terpilih_1 = $data->lembarEdukasi['petugas_1'] ?? '';
                $wali_1  = $edu['wali_1'] ?? '';


                // --- PREPARASI DATA ITEM 2 ---
                $tgl_2      = $edu['tgl_2'] ?? '';
                $evaluasi_2 = $edu['evaluasi_2'] ?? '';
                $lainnya_2  = $edu['lainnya_2'] ?? '';
                $metode_2_arr = isset($edu['metode_2']) ? array_map('trim', explode(',', $edu['metode_2'])) : [];
                $media_2_arr = isset($edu['media_2']) ? array_map(function ($item) {
                    return preg_replace('/^[\s\x00-\x1F\x7F\xA0]+|[\s\x00-\x1F\x7F\xA0]+$/u', '', $item);
                }, explode(',', $edu['media_2'])) : [];
                $petugas_terpilih_2 = $data->lembarEdukasi['petugas_2'] ?? '';
                $wali_2  = $edu['wali_2'] ?? '';
                ?>

                <div class="row row-cols-1 row-cols-lg-2 g-4 mb-3">
                    <!-- ==========1================ -->
                    <div class="col">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold py-2">
                                ADMINISTRASI
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-sm-6 border-end">
                                        <ol>
                                            <li>Tata tertib</li>
                                            <li>Hak & Kewajiban</li>
                                            <li> <i>Inform Consent</i></li>
                                            <li><i>General Consent</i></li>
                                        </ol>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-1 d-flex align-items-center">
                                            <label class="form-label fw-bold small text-primary mb-0 me-2 text-nowrap">Tanggal :</label>
                                            <input type="date" name="tgl[1]" class="form-control form-control-sm" value="<?= $tgl_1 ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Metode Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[1][]" id="met_lisan_1" value="Lisan" <?= in_array('Lisan', $metode_1_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_lisan_1">Lisan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[1][]" id="met_dem_1" value="Demonstrasi" <?= in_array('Demonstrasi', $metode_1_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_dem_1">Demonstrasi</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Media Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[1][]" id="med_leaf_1" value="Leaflet" <?= in_array('Leaflet', $media_1_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_leaf_1">Leaflet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[1][]" id="med_book_1" value="Booklet" <?= in_array('Booklet', $media_1_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_book_1">Booklet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[1][]" id="med_lbb_1" value="Bolak Balik" <?= in_array('Bolak Balik', $media_1_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_lbb_1">Lembar Bolak Balik</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Evaluasi</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="form-check form-check-inline me-0">
                                                    <input class="form-check-input" type="radio" name="evaluasi[1]" id="ev_<?= $i ?>_1" value="<?= $i ?>" <?= ((int)$evaluasi_1 === $i) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ev_<?= $i ?>_1"><?= $i ?></label>
                                                </div>
                                            <?php endfor; ?>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Petugas</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <select name="petugas[1]" class="form-select">
                                                <option value="" <?= empty($petugas_terpilih_1) ? 'selected' : '' ?>>-- Pilih Petugas --</option>

                                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                                    $nama_petugas = $data->petugas[$i]["nama"];

                                                    // Cek apakah nama petugas ini sama dengan data yang tersimpan di database
                                                    $selected = ($nama_petugas === $petugas_terpilih_1) ? 'selected' : '';

                                                    echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                                } ?>
                                            </select>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Pasien/Keluarga</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <input type="text" name="wali[1]" value="<?= $wali_1 ?>" placeholder="nama pasien/keluarga..." class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==========2================ -->
                    <div class="col">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold py-2">
                                DOKTER SPESIALIS / UMUM
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-sm-6 border-end">
                                        <ol type="a">
                                            <li>Penjelasan penyakit, penyebab, tanda & gejala, prognosa</li>
                                            <li>Hasil pemeriksaan.</li>
                                            <li>Tindakan medis.</li>
                                            <li>Perkiraan hari rawat.</li>
                                            <li>Penjelasan komplikasi yang mungkin terjadi.</li>
                                            <li>Penggunaan alat medis.</li>
                                            <li>
                                                <input type="text" name="lainnya_2" id="lainnya_2" class="form-control form-control-sm" placeholder="lainnya.." value="<?= $lainnya_2 ?>">
                                            </li>
                                        </ol>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-1 d-flex align-items-center">
                                            <label class="form-label fw-bold small text-primary mb-0 me-2 text-nowrap">Tanggal :</label>
                                            <input type="date" name="tgl[2]" class="form-control form-control-sm" value="<?= $tgl_2 ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Metode Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[2][]" id="met_lisan_2" value="Lisan" <?= in_array('Lisan', $metode_2_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_lisan_2">Lisan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[2][]" id="met_dem_2" value="Demonstrasi" <?= in_array('Demonstrasi', $metode_2_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_dem_2">Demonstrasi</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Media Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[2][]" id="med_leaf_2" value="Leaflet" <?= in_array('Leaflet', $media_2_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_leaf_2">Leaflet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[2][]" id="med_book_2" value="Booklet" <?= in_array('Booklet', $media_2_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_book_2">Booklet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[2][]" id="med_lbb_2" value="Bolak Balik" <?= in_array('Bolak Balik', $media_2_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_lbb_2">Lembar Bolak Balik</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Evaluasi</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="form-check form-check-inline me-0">
                                                    <input class="form-check-input" type="radio" name="evaluasi[2]" id="ev_<?= $i ?>_2" value="<?= $i ?>" <?= ((int)$evaluasi_2 === $i) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ev_<?= $i ?>_2"><?= $i ?></label>
                                                </div>
                                            <?php endfor; ?>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Petugas</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <select name="petugas[2]" class="form-select">
                                                <option value="" <?= empty($petugas_terpilih_2) ? 'selected' : '' ?>>-- Pilih Petugas --</option>

                                                <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                                    $nama_petugas = $data->dokter[$i]["nm_dokter"];

                                                    // Cek apakah nama petugas ini sama dengan data yang tersimpan di database
                                                    $selected = ($nama_petugas === $petugas_terpilih_2) ? 'selected' : '';

                                                    echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                                } ?>
                                            </select>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Pasien/Keluarga</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <input type="text" name="wali[2]" value="<?= $wali_2 ?>" placeholder="nama pasien/keluarga..." class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                // Ambil baris data utama
                $edu = $data->lembarEdukasi;

                // --- PREPARASI DATA ITEM 3 ---
                $tgl_3      = $edu['tgl_3'] ?? '';
                $evaluasi_3 = $edu['evaluasi_3'] ?? '';
                $metode_3_arr = isset($edu['metode_3']) ? array_map('trim', explode(',', $edu['metode_3'])) : [];
                $media_3_arr = isset($edu['media_3']) ? array_map(function ($item) {
                    return preg_replace('/^[\s\x00-\x1F\x7F\xA0]+|[\s\x00-\x1F\x7F\xA0]+$/u', '', $item);
                }, explode(',', $edu['media_3'])) : [];
                $petugas_terpilih_3 = $data->lembarEdukasi['petugas_3'] ?? '';
                $wali_3      = $edu['wali_3'] ?? '';

                // --- PREPARASI DATA ITEM 4 ---
                $tgl_4      = $edu['tgl_4'] ?? '';
                $evaluasi_4 = $edu['evaluasi_4'] ?? '';
                $lainnya_4  = $edu['lainnya_4'] ?? ''; // Untuk input text 'lainnya..'
                $metode_4_arr = isset($edu['metode_4']) ? array_map('trim', explode(',', $edu['metode_4'])) : [];
                $media_4_arr = isset($edu['media_4']) ? array_map(function ($item) {
                    return preg_replace('/^[\s\x00-\x1F\x7F\xA0]+|[\s\x00-\x1F\x7F\xA0]+$/u', '', $item);
                }, explode(',', $edu['media_4'])) : [];
                $petugas_terpilih_4 = $data->lembarEdukasi['petugas_4'] ?? '';
                $wali_4      = $edu['wali_4'] ?? '';
                ?>

                <div class="row row-cols-1 row-cols-lg-2 g-4 mb-3">
                    <!-- ==========3================ -->
                    <div class="col">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold py-2">
                                MANAJEMEN NYERI
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-sm-6 border-end">
                                        <ol type="a">
                                            <li>Farmakologi</li>
                                            <li>Non farmakologi</li>
                                        </ol>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-1 d-flex align-items-center">
                                            <label class="form-label fw-bold small text-primary mb-0 me-2 text-nowrap">Tanggal :</label>
                                            <input type="date" name="tgl[3]" class="form-control form-control-sm" value="<?= $tgl_3 ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Metode Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[3][]" id="met_lisan_3" value="Lisan" <?= in_array('Lisan', $metode_3_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_lisan_3">Lisan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[3][]" id="met_dem_3" value="Demonstrasi" <?= in_array('Demonstrasi', $metode_3_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_dem_3">Demonstrasi</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Media Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[3][]" id="med_leaf_3" value="Leaflet" <?= in_array('Leaflet', $media_3_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_leaf_3">Leaflet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[3][]" id="med_book_3" value="Booklet" <?= in_array('Booklet', $media_3_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_book_3">Booklet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[3][]" id="med_lbb_3" value="Bolak Balik" <?= in_array('Bolak Balik', $media_3_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_lbb_3">Lembar Bolak Balik</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Evaluasi</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="form-check form-check-inline me-0">
                                                    <input class="form-check-input" type="radio" name="evaluasi[3]" id="ev_<?= $i ?>_3" value="<?= $i ?>" <?= ((int)$evaluasi_3 === $i) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ev_<?= $i ?>_3"><?= $i ?></label>
                                                </div>
                                            <?php endfor; ?>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Petugas</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <select name="petugas[3]" class="form-select">
                                                <option value="" <?= empty($petugas_terpilih_3) ? 'selected' : '' ?>>-- Pilih Petugas --</option>

                                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                                    $nama_petugas = $data->petugas[$i]["nama"];

                                                    // Cek apakah nama petugas ini sama dengan data yang tersimpan di database
                                                    $selected = ($nama_petugas === $petugas_terpilih_3) ? 'selected' : '';

                                                    echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                                } ?>
                                            </select>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Pasien/Keluarga</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <input type="text" name="wali[3]" value="<?= $wali_3 ?>" placeholder="nama pasien/keluarga..." class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==========4================ -->
                    <div class="col">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold py-2">
                                NUTRISI
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-sm-6 border-end">
                                        <ol type="a">
                                            <li>Diet nutrisi</li>
                                            <li>Penyuluhan Nutrisi</li>
                                            <li>
                                                <input type="text" id="lainnya_4" name="lainnya_4" class="form-control form-control-sm" placeholder="lainnya.." value="<?= $lainnya_4 ?>">
                                            </li>
                                        </ol>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-1 d-flex align-items-center">
                                            <label class="form-label fw-bold small text-primary mb-0 me-2 text-nowrap">Tanggal :</label>
                                            <input type="date" name="tgl[4]" class="form-control form-control-sm" value="<?= $tgl_4 ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Metode Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[4][]" id="met_lisan_4" value="Lisan" <?= in_array('Lisan', $metode_4_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_lisan_4">Lisan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[4][]" id="met_dem_4" value="Demonstrasi" <?= in_array('Demonstrasi', $metode_4_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_dem_4">Demonstrasi</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Media Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[4][]" id="med_leaf_4" value="Leaflet" <?= in_array('Leaflet', $media_4_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_leaf_4">Leaflet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[4][]" id="med_book_4" value="Booklet" <?= in_array('Booklet', $media_4_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_book_4">Booklet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[4][]" id="med_lbb_4" value="Bolak Balik" <?= in_array('Bolak Balik', $media_4_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_lbb_4">Lembar Bolak Balik</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Evaluasi</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="form-check form-check-inline me-0">
                                                    <input class="form-check-input" type="radio" name="evaluasi[4]" id="ev_<?= $i ?>_4" value="<?= $i ?>" <?= ((int)$evaluasi_4 === $i) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ev_<?= $i ?>_4"><?= $i ?></label>
                                                </div>
                                            <?php endfor; ?>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Petugas</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <select name="petugas[4]" class="form-select">
                                                <option value="" <?= empty($petugas_terpilih_4) ? 'selected' : '' ?>>-- Pilih Petugas --</option>

                                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                                    $nama_petugas = $data->petugas[$i]["nama"];

                                                    // Cek apakah nama petugas ini sama dengan data yang tersimpan di database
                                                    $selected = ($nama_petugas === $petugas_terpilih_4) ? 'selected' : '';

                                                    echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                                } ?>
                                            </select>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Pasien/Keluarga</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <input type="text" name="wali[4]" value="<?= $wali_4 ?>" placeholder="nama pasien/keluarga..." class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                // Ambil baris data utama
                $edu = $data->lembarEdukasi;

                // --- PREPARASI DATA ITEM 5 ---
                $tgl_5      = $edu['tgl_5'] ?? '';
                $evaluasi_5 = $edu['evaluasi_5'] ?? '';
                $lainnya_5  = $edu['lainnya_5'] ?? ''; // Untuk input text 'lainnya..'
                $metode_5_arr = isset($edu['metode_5']) ? array_map('trim', explode(',', $edu['metode_5'])) : [];
                $media_5_arr = isset($edu['media_5']) ? array_map(function ($item) {
                    return preg_replace('/^[\s\x00-\x1F\x7F\xA0]+|[\s\x00-\x1F\x7F\xA0]+$/u', '', $item);
                }, explode(',', $edu['media_5'])) : [];
                $petugas_terpilih_5 = $data->lembarEdukasi['petugas_5'] ?? '';
                $wali_5      = $edu['wali_5'] ?? '';

                // --- PREPARASI DATA ITEM 6 ---
                $tgl_6      = $edu['tgl_6'] ?? '';
                $evaluasi_6 = $edu['evaluasi_6'] ?? '';
                $lainnya_6  = $edu['lainnya_6'] ?? ''; // Untuk textarea 'lainnya..'
                $metode_6_arr = isset($edu['metode_6']) ? array_map('trim', explode(',', $edu['metode_6'])) : [];
                $media_6_arr = isset($edu['media_6']) ? array_map(function ($item) {
                    return preg_replace('/^[\s\x00-\x1F\x7F\xA0]+|[\s\x00-\x1F\x7F\xA0]+$/u', '', $item);
                }, explode(',', $edu['media_6'])) : [];
                $petugas_terpilih_6 = $data->lembarEdukasi['petugas_6'] ?? '';
                $wali_6      = $edu['wali_6'] ?? '';
                ?>

                <div class="row row-cols-1 row-cols-lg-2 g-4 mb-3">

                    <!-- ==========5================ -->
                    <div class="col">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold py-2">
                                FARMASI
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-sm-6 border-end">
                                        <ol type="a">
                                            <li>Nama obat dan kegunaan</li>
                                            <li>Aturan pemakaian dan dosis obat</li>
                                            <li>Cara penyimpanan</li>
                                            <li>Efek samping obat</li>
                                            <li>Kontraindikasi obat</li>
                                            <li>
                                                <input type="text" id="lainnya_5" name="lainnya_5" class="form-control form-control-sm" placeholder="lainnya.." value="<?= $lainnya_5 ?>">
                                            </li>
                                        </ol>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-1 d-flex align-items-center">
                                            <label class="form-label fw-bold small text-primary mb-0 me-2 text-nowrap">Tanggal :</label>
                                            <input type="date" name="tgl[5]" class="form-control form-control-sm" value="<?= $tgl_5 ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Metode Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[5][]" id="met_lisan_5" value="Lisan" <?= in_array('Lisan', $metode_5_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_lisan_5">Lisan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[5][]" id="met_dem_5" value="Demonstrasi" <?= in_array('Demonstrasi', $metode_5_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_dem_5">Demonstrasi</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Media Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[5][]" id="med_leaf_5" value="Leaflet" <?= in_array('Leaflet', $media_5_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_leaf_5">Leaflet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[5][]" id="med_book_5" value="Booklet" <?= in_array('Booklet', $media_5_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_book_5">Booklet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[5][]" id="med_lbb_5" value="Bolak Balik" <?= in_array('Bolak Balik', $media_5_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_lbb_5">Lembar Bolak Balik</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Evaluasi (Skala 1-5)</label>
                                        <div class="d-flex gap-2">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="form-check form-check-inline me-0">
                                                    <input class="form-check-input" type="radio" name="evaluasi[5]" id="ev_<?= $i ?>_5" value="<?= $i ?>" <?= ((int)$evaluasi_5 === $i) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ev_<?= $i ?>_5"><?= $i ?></label>
                                                </div>
                                            <?php endfor; ?>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Petugas</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <select name="petugas[5]" class="form-select">
                                                <option value="" <?= empty($petugas_terpilih_5) ? 'selected' : '' ?>>-- Pilih Petugas --</option>

                                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                                    $nama_petugas = $data->petugas[$i]["nama"];

                                                    // Cek apakah nama petugas ini sama dengan data yang tersimpan di database
                                                    $selected = ($nama_petugas === $petugas_terpilih_5) ? 'selected' : '';

                                                    echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                                } ?>
                                            </select>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Pasien/Keluarga</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <input type="text" name="wali[5]" value="<?= $wali_5 ?>" placeholder="nama pasien/keluarga..." class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==========6================ -->
                    <div class="col">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold py-2">
                                PERAWAT/BIDAN
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-sm-6 border-end">
                                        <ol type="a">
                                            <li>Pendidikan kesehatan tentang :
                                                <textarea class="form-control form-control-sm" id="lainnya_6" name="lainnya_6" placeholder="lainnya.."><?= htmlspecialchars($lainnya_6) ?></textarea>
                                            </li>
                                            <li>Penanganan & cara perawatan dirumah</li>
                                            <li>Perawatan luka</li>
                                            <li>Hand hygiene</li>
                                            <li>Keamanan lingkungan perawatan</li>
                                            <li>Teknik memandikan bayi</li>
                                            <li>Post natal care</li>
                                        </ol>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-1 d-flex align-items-center">
                                            <label class="form-label fw-bold small text-primary mb-0 me-2 text-nowrap">Tanggal :</label>
                                            <input type="date" name="tgl[6]" class="form-control form-control-sm" value="<?= $tgl_6 ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Metode Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[6][]" id="met_lisan_6" value="Lisan" <?= in_array('Lisan', $metode_6_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_lisan_6">Lisan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[6][]" id="met_dem_6" value="Demonstrasi" <?= in_array('Demonstrasi', $metode_6_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_dem_6">Demonstrasi</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Media Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[6][]" id="med_leaf_6" value="Leaflet" <?= in_array('Leaflet', $media_6_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_leaf_6">Leaflet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[6][]" id="med_book_6" value="Booklet" <?= in_array('Booklet', $media_6_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_book_6">Booklet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[6][]" id="med_lbb_6" value="Bolak Balik" <?= in_array('Bolak Balik', $media_6_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_lbb_6">Lembar Bolak Balik</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Evaluasi (Skala 1-5)</label>
                                        <div class="d-flex gap-2">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="form-check form-check-inline me-0">
                                                    <input class="form-check-input" type="radio" name="evaluasi[6]" id="ev_<?= $i ?>_6" value="<?= $i ?>" <?= ((int)$evaluasi_6 === $i) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ev_<?= $i ?>_6"><?= $i ?></label>
                                                </div>
                                            <?php endfor; ?>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Petugas</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <select name="petugas[6]" class="form-select">
                                                <option value="" <?= empty($petugas_terpilih_6) ? 'selected' : '' ?>>-- Pilih Petugas --</option>

                                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                                    $nama_petugas = $data->petugas[$i]["nama"];

                                                    // Cek apakah nama petugas ini sama dengan data yang tersimpan di database
                                                    $selected = ($nama_petugas === $petugas_terpilih_6) ? 'selected' : '';

                                                    echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                                } ?>
                                            </select>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Pasien/Keluarga</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <input type="text" name="wali[6]" value="<?= $wali_6 ?>" placeholder="nama pasien/keluarga..." class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                // Ambil baris data utama
                $edu = $data->lembarEdukasi;

                // --- PREPARASI DATA ITEM 7 ---
                $tgl_7      = $edu['tgl_7'] ?? '';
                $evaluasi_7 = $edu['evaluasi_7'] ?? '';
                $lainnya_7  = $edu['lainnya_7'] ?? ''; // Untuk input text 'lainnya..'
                $metode_7_arr = isset($edu['metode_7']) ? array_map('trim', explode(',', $edu['metode_7'])) : [];
                $media_7_arr = isset($edu['media_7']) ? array_map(function ($item) {
                    return preg_replace('/^[\s\x00-\x1F\x7F\xA0]+|[\s\x00-\x1F\x7F\xA0]+$/u', '', $item);
                }, explode(',', $edu['media_7'])) : [];
                $petugas_terpilih_7 = $data->lembarEdukasi['petugas_7'] ?? '';
                $wali_7      = $edu['wali_7'] ?? '';

                // --- PREPARASI DATA ITEM 8 ---
                $tgl_8      = $edu['tgl_8'] ?? '';
                $evaluasi_8 = $edu['evaluasi_8'] ?? '';
                $lainnya_8  = $edu['lainnya_8'] ?? ''; // Untuk textarea 'lain lain .......'
                $metode_8_arr = isset($edu['metode_8']) ? array_map('trim', explode(',', $edu['metode_8'])) : [];
                $media_8_arr = isset($edu['media_8']) ? array_map(function ($item) {
                    return preg_replace('/^[\s\x00-\x1F\x7F\xA0]+|[\s\x00-\x1F\x7F\xA0]+$/u', '', $item);
                }, explode(',', $edu['media_8'])) : [];
                $petugas_terpilih_8 = $data->lembarEdukasi['petugas_8'] ?? '';
                $wali_8      = $edu['wali_8'] ?? '';
                ?>

                <div class="row row-cols-1 row-cols-lg-2 g-4 mb-3">
                    <!-- ==========7================ -->
                    <div class="col">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold py-2">
                                LAINNYA
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-sm-6 border-end">
                                        <ol type="a">
                                            <li>Orientasi Ruangan</li>
                                            <li>Etika Batuk</li>
                                            <li>
                                                <input type="text" id="lainnya_7" name="lainnya_7" class="form-control form-control-sm" placeholder="lainnya.." value="<?= $lainnya_7 ?>">
                                            </li>
                                        </ol>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-1 d-flex align-items-center">
                                            <label class="form-label fw-bold small text-primary mb-0 me-2 text-nowrap">Tanggal :</label>
                                            <input type="date" name="tgl[7]" class="form-control form-control-sm" value="<?= $tgl_7 ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Metode Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[7][]" id="met_lisan_7" value="Lisan" <?= in_array('Lisan', $metode_7_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_lisan_7">Lisan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[7][]" id="met_dem_7" value="Demonstrasi" <?= in_array('Demonstrasi', $metode_7_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_dem_7">Demonstrasi</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Media Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[7][]" id="med_leaf_7" value="Leaflet" <?= in_array('Leaflet', $media_7_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_leaf_7">Leaflet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[7][]" id="med_book_7" value="Booklet" <?= in_array('Booklet', $media_7_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_book_7">Booklet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[7][]" id="med_lbb_7" value="Bolak Balik" <?= in_array('Bolak Balik', $media_7_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_lbb_7">Lembar Bolak Balik</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Evaluasi (Skala 1-5)</label>
                                        <div class="d-flex gap-2">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="form-check form-check-inline me-0">
                                                    <input class="form-check-input" type="radio" name="evaluasi[7]" id="ev_<?= $i ?>_7" value="<?= $i ?>" <?= ((int)$evaluasi_7 === $i) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ev_<?= $i ?>_7"><?= $i ?></label>
                                                </div>
                                            <?php endfor; ?>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Petugas</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <select name="petugas[7]" class="form-select">
                                                <option value="" <?= empty($petugas_terpilih_7) ? 'selected' : '' ?>>-- Pilih Petugas --</option>

                                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                                    $nama_petugas = $data->petugas[$i]["nama"];

                                                    // Cek apakah nama petugas ini sama dengan data yang tersimpan di database
                                                    $selected = ($nama_petugas === $petugas_terpilih_7) ? 'selected' : '';

                                                    echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                                } ?>
                                            </select>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Pasien/Keluarga</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <input type="text" name="wali[7]" value="<?= $wali_7 ?>" placeholder="nama pasien/keluarga..." class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==========8================ -->
                    <div class="col">
                        <div class="card h-100 border-info shadow-sm">
                            <div class="card-header bg-info text-white fw-bold py-2">
                                LAIN - LAIN
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-sm-6 border-end">
                                        <textarea name="lainnya_8" id="lainnya_8" class="form-control" rows="6" placeholder="lain lain ......."><?= htmlspecialchars($lainnya_8) ?></textarea>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-1 d-flex align-items-center">
                                            <label class="form-label fw-bold small text-primary mb-0 me-2 text-nowrap">Tanggal :</label>
                                            <input type="date" name="tgl[8]" class="form-control form-control-sm" value="<?= $tgl_8 ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Metode Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[8][]" id="met_lisan_8" value="Lisan" <?= in_array('Lisan', $metode_8_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_lisan_8">Lisan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="metode[8][]" id="met_dem_8" value="Demonstrasi" <?= in_array('Demonstrasi', $metode_8_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="met_dem_8">Demonstrasi</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mb-0 d-block">Media Edukasi</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[8][]" id="med_leaf_8" value="Leaflet" <?= in_array('Leaflet', $media_8_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_leaf_8">Leaflet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[8][]" id="med_book_8" value="Booklet" <?= in_array('Booklet', $media_8_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_book_8">Booklet</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="media[8][]" id="med_lbb_8" value="Bolak Balik" <?= in_array('Bolak Balik', $media_8_arr) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="med_lbb_8">Lembar Bolak Balik</label>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Evaluasi (Skala 1-5)</label>
                                        <div class="d-flex gap-2">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <div class="form-check form-check-inline me-0">
                                                    <input class="form-check-input" type="radio" name="evaluasi[8]" id="ev_<?= $i ?>_8" value="<?= $i ?>" <?= ((int)$evaluasi_8 === $i) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ev_<?= $i ?>_8"><?= $i ?></label>
                                                </div>
                                            <?php endfor; ?>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Petugas</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <select name="petugas[8]" class="form-select">
                                                <option value="" <?= empty($petugas_terpilih_8) ? 'selected' : '' ?>>-- Pilih Petugas --</option>

                                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                                    $nama_petugas = $data->petugas[$i]["nama"];

                                                    // Cek apakah nama petugas ini sama dengan data yang tersimpan di database
                                                    $selected = ($nama_petugas === $petugas_terpilih_8) ? 'selected' : '';

                                                    echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                                } ?>
                                            </select>
                                        </div>

                                        <label class="form-label fw-bold small text-primary mt-2 d-block mb-1">Pasien/Keluarga</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <input type="text" name="wali[8]" value="<?= $wali_8 ?>" placeholder="nama pasien/keluarga..." class="form-control">
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
</form>
<?php

/** @var object $data */
?>
<form>
    <div class="row">
        <div class="col-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-6"><input type="text" class="form-control" id="namaWali" placeholder="Nama" value="<?= esc($data->persetujuanRanap['namaWali'] ?? '') ?>"></div>
                    <div class="col-6"><input type="text" maxlength="13" class="form-control" id="noTelp" placeholder="Nomor HP" value="<?= esc($data->persetujuanRanap['noTelp'] ?? '') ?>"></div>
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col-8">
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= esc($data->persetujuanRanap['alamat'] ?? '') ?>">
                        </div>
                        <div class="col-4">
                            <div class="form-check pt-2">
                                <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                                <label class="form-check-label" for="samaDgPj">Sama dg PJ</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sebagai" class="form-label">Beritindak sebagai :</label>
                        <select id="sebagai" class="form-select">
                            <?php
                            $opsiSebagai = ["Suami", "Istri", "Anak", "Ayah", "Ibu", "Wali", "Saya sendiri"];
                            $currentSebagai = $data->persetujuanRanap['sebagai'] ?? '';
                            foreach ($opsiSebagai as $opsi) :
                                $selected = ($currentSebagai === $opsi) ? 'selected' : '';
                            ?>
                                <option value="<?= $opsi ?>" <?= $selected ?>><?= $opsi === 'Saya sendiri' ? 'Diri saya sendiri' : $opsi ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <div class="pt-5 form-check">
                            <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                            <label class="form-check-label" for="samaDgPasien">Sama dengan pasien</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Pelepasan Informasi medis dan Privasi :</div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-12 mb-2">
                        <small>
                            Memilih Dokter
                            <select name="dokter" id="dokter" class="form-select">
                                <option value="" disabled <?= empty($data->persetujuanRanap['dokter']) ? 'selected' : '' ?>>-- Pilih Dokter --</option>
                                <?php
                                $currentDokter = $data->persetujuanRanap['dokter'] ?? '';
                                for ($i = 0; $i < count($data->dokter); $i++) {
                                    $selectedDokter = ($currentDokter === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                    echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selectedDokter . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                } ?>
                            </select>
                            Sebagai dokter penanggung jawab.
                        </small>
                        <hr>
                        <small>Setuju untuk melepaskan rahasia kedokteran kepada Anggota keluarga, sebutkan : <br>
                            <sub class="alert alert-warning m-1 p-0"><b>Petunjuk : </b><i>dipisah koma (,) apabila lebih dari 1.</i></sub>
                        </small>
                        <textarea type="text" class="form-control mt-1" id="namaKeluarga" placeholder="Ketik nama keluarga. dipisah koma apabila lebih dari satu nama."><?= esc($data->persetujuanRanap['namaKeluarga'] ?? '') ?></textarea>
                    </div>
                    <div class="col-12">
                        <div class="mb-3 border border-info rounded p-2">
                            <div class="form-check">
                                <input class="form-check-input rad-jenguk" type="radio" name="izin_jenguk" id="jenguk_semua" value="semua" <?= (old('izin_jenguk', $data->persetujuanRanap['izin_jenguk'] ?? '') == 'semua') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="jenguk_semua">
                                    <strong>Mengizinkan</strong> semua orang menjenguk.
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input rad-jenguk" type="radio" name="izin_jenguk" id="jenguk_kecuali" value="kecuali" <?= (old('izin_jenguk', $data->persetujuanRanap['izin_jenguk'] ?? '') == 'kecuali') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="jenguk_kecuali">
                                    <strong>Mengizinkan</strong> semua orang menjenguk, kecuali...
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input rad-jenguk" type="radio" name="izin_jenguk" id="jenguk_tidak_kecuali" value="tidak_kecuali" <?= (old('izin_jenguk', $data->persetujuanRanap['izin_jenguk'] ?? '') == 'tidak_kecuali') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="jenguk_tidak_kecuali">
                                    <strong>Tidak mengizinkan</strong> semua orang menjenguk, kecuali...
                                </label>
                            </div>

                            <div class="ms-4 data-kecuali-container">
                                <sub class="alert alert-warning p-0"><b>Petunjuk : </b><i>dipisah koma (,) apabila lebih dari 1.</i></sub>
                                <br>
                                <textarea class="form-control mt-1 form-control-sm" id="isi_kecuali" name="isi_kecuali" rows="3" placeholder="Sebutkan nama/hubungan keluarga..." disabled><?= esc($data->persetujuanRanap['isi_kecuali'] ?? '') ?></textarea>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function() {
                                function handleIzinJenguk() {
                                    let nilaiRadio = $(".rad-jenguk:checked").val();
                                    if (nilaiRadio === 'kecuali' || nilaiRadio === 'tidak_kecuali') {
                                        $("#isi_kecuali").prop("disabled", false);
                                    } else {
                                        $("#isi_kecuali").prop("disabled", true).val("");
                                    }
                                }
                                handleIzinJenguk();
                                $(".rad-jenguk").change(function() {
                                    handleIzinJenguk();
                                    if ($("#isi_kecuali").prop("disabled") == false) {
                                        $("#isi_kecuali").focus();
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Kewajiban Pembayaran :</div>
                    <hr>
                </div>
                <div class="mb-3 border border-info p-2 rounded">
                    <div class="form-check">
                        <input class="form-check-input rad-jenis-pasien" type="radio" name="jenis_pasien" id="pasien_umum" value="umum" <?= (old('jenis_pasien', $data->persetujuanRanap['jenis_pasien'] ?? '') == 'umum') ? 'checked' : '' ?>>
                        <label class="form-check-label h6 text-uppercase" for="pasien_umum">
                            a. PASIEN UMUM:
                        </label>
                    </div>
                    <div class="ms-4 p-2 border-start border-secondary section-sub-umum">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_asuransi_umum" id="umum_no_asuransi" value="tidak_mempunyai" <?= (old('status_asuransi_umum', $data->persetujuanRanap['status_asuransi_umum'] ?? '') == 'tidak_mempunyai') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="umum_no_asuransi">Tidak punya asuransi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status_asuransi_umum" id="umum_tolak_asuransi" value="menolak" <?= (old('status_asuransi_umum', $data->persetujuanRanap['status_asuransi_umum'] ?? '') == 'menolak') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="umum_tolak_asuransi">Menolak pakai Asuransi</label>
                        </div>

                        <span class="d-block mb-2 text-decoration-underline">Permintaan Kelas :</span>
                        <div class="d-flex flex-wrap gap-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kelas_umum" id="kelas_umum_1" value="1" <?= (old('kelas_umum', $data->persetujuanRanap['kelas_umum'] ?? '') == '1') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="kelas_umum_1">1</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kelas_umum" id="kelas_umum_2" value="2" <?= (old('kelas_umum', $data->persetujuanRanap['kelas_umum'] ?? '') == '2') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="kelas_umum_2">2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kelas_umum" id="kelas_umum_3" value="3" <?= (old('kelas_umum', $data->persetujuanRanap['kelas_umum'] ?? '') == '3') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="kelas_umum_3">3</label>
                            </div>
                            <div class="form-check d-flex gap-2">
                                <input class="form-check-input" type="radio" name="kelas_umum" id="kelas_umum_lain" value="lainnya" <?= (old('kelas_umum', $data->persetujuanRanap['kelas_umum'] ?? '') == 'lainnya') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="kelas_umum_lain">Lainnya</label>
                                <input type="text" class="form-control form-control-sm rounded" id="kelas_umum_lain_text" name="kelas_umum_lain_text" style="width: 150px;">
                            </div>
                        </div>

                        <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                            <span>Biaya Rp</span>
                            <input type="text" class="form-control form-control-sm rounded" id="biaya_min" name="biaya_min" style="width: 150px;">
                            <span>s/d Rp</span>
                            <input type="text" class="form-control form-control-sm rounded" id="biaya_max" name="biaya_max" style="width: 150px;">
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="form-check m-0">
                            <input class="form-check-input rad-jenis-pasien" type="radio" name="jenis_pasien" id="pasien_bpjs" value="bpjs" <?= (old('jenis_pasien', $data->persetujuanRanap['jenis_pasien'] ?? '') == 'bpjs') ? 'checked' : '' ?>>
                            <label class="form-check-label h6 text-uppercase m-0" for="pasien_bpjs">
                                b. PASIEN BPJS KES: no. JKN :
                            </label>
                        </div>
                        <input type="text" class="form-control form-control-sm border-dark" id="no_bpjs" name="no_bpjs" style="max-width: 200px;">
                    </div>

                    <div class="ms-4 p-2 border-start border-secondary section-sub-bpjs">
                        <div class="form-check mb-2">
                            <input class="form-check-input rad-bpjs-kelas" type="radio" name="bpjs_status_kelas" id="bpjs_tetap" value="tidak_naik" <?= (old('bpjs_status_kelas', $data->persetujuanRanap['bpjs_status_kelas'] ?? '') == 'tidak_naik') ? 'checked' : '' ?>>
                            <label class="form-check-label fw-bold" for="bpjs_tetap">1) TIDAK NAIK KELAS *)</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input rad-bpjs-kelas" type="radio" name="bpjs_status_kelas" id="bpjs_naik" value="naik_perawatan" <?= (old('bpjs_status_kelas', $data->persetujuanRanap['bpjs_status_kelas'] ?? '') == 'naik_perawatan') ? 'checked' : '' ?>>
                            <label class="form-check-label fw-bold" for="bpjs_naik">2) PASIEN BPJS KESEHATAN NAIK KELAS PERAWATAN</label>
                        </div>

                        <div class="ms-4 section-sub-bpjs-naik">
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="bpjs_naik_tingkat" id="naik_1_2" value="1_atau_2" <?= (old('bpjs_naik_tingkat', $data->persetujuanRanap['bpjs_naik_tingkat'] ?? '') == '1_atau_2') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="naik_1_2">Naik 1 tingkat / 2 tingkat</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="bpjs_naik_tingkat" id="naik_kelas_3" value="kelas_3" <?= (old('bpjs_naik_tingkat', $data->persetujuanRanap['bpjs_naik_tingkat'] ?? '') == 'kelas_3') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="naik_kelas_3">Kelas 3</label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-check d-flex align-items-center gap-2">
                        <input class="form-check-input rad-jenis-pasien" type="radio" name="jenis_pasien" id="pasien_asuransi_lain" value="asuransi_lain" <?= (old('jenis_pasien', $data->persetujuanRanap['jenis_pasien'] ?? '') == 'asuransi_lain') ? 'checked' : '' ?>>
                        <label class="form-check-label h6 text-uppercase m-0" for="pasien_asuransi_lain">
                            c. PASIEN ASURANSI LAIN (sebutkan) :
                        </label>
                        <input type="text" class="form-control form-control-sm rounded" id="nama_asuransi_lain" name="nama_asuransi_lain" style="flex: 1; max-width: 400px;">
                    </div>
                    <script>
                        $(document).ready(function() {
                            // Ambil data dari database ke input teks dengan aman menggunakan variabel persetujuanRanap
                            $("#kelas_umum_lain_text").val(<?= json_encode($data->persetujuanRanap['kelas_umum_lain_text'] ?? '') ?>);
                            $("#biaya_min").val(<?= json_encode($data->persetujuanRanap['biaya_min'] ?? '') ?>);
                            $("#biaya_max").val(<?= json_encode($data->persetujuanRanap['biaya_max'] ?? '') ?>);
                            $("#no_bpjs").val(<?= json_encode($data->persetujuanRanap['no_bpjs'] ?? '') ?>);
                            $("#nama_asuransi_lain").val(<?= json_encode($data->persetujuanRanap['nama_asuransi_lain'] ?? '') ?>);

                            function evaluasiFormPasien() {
                                let jenisPasien = $(".rad-jenis-pasien:checked").val();

                                // Evaluasi Bagian A (UMUM)
                                if (jenisPasien === 'umum') {
                                    $(".section-sub-umum input").prop("disabled", false);
                                    $("#kelas_umum_lain_text").prop("disabled", !$("#kelas_umum_lain").is(":checked"));
                                } else {
                                    $('[name="status_asuransi_umum"]').prop("checked", false);
                                    $('[name="kelas_umum"]').prop("checked", false);
                                    $("#kelas_umum_lain_text, #biaya_min, #biaya_max").val("");
                                    $(".section-sub-umum input").prop("disabled", true);
                                }

                                // Evaluasi Bagian B (BPJS)
                                if (jenisPasien === 'bpjs') {
                                    $("#no_bpjs").prop("disabled", false);
                                    $(".section-sub-bpjs .rad-bpjs-kelas").prop("disabled", false);

                                    if ($("#bpjs_naik").is(":checked")) {
                                        $(".section-sub-bpjs-naik input").prop("disabled", false);
                                    } else {
                                        $(".section-sub-bpjs-naik input").prop("disabled", true).prop("checked", false);
                                    }
                                } else {
                                    $("#no_bpjs").prop("disabled", true).val("");
                                    $(".section-sub-bpjs input").prop("disabled", true).prop("checked", false);
                                }

                                // Evaluasi Bagian C (ASURANSI LAIN)
                                if (jenisPasien === 'asuransi_lain') {
                                    $("#nama_asuransi_lain").prop("disabled", false);
                                } else {
                                    $("#nama_asuransi_lain").prop("disabled", true).val("");
                                }
                            }

                            $(document).on('change', '.rad-jenis-pasien, .rad-bpjs-kelas, [name="kelas_umum"]', function() {
                                evaluasiFormPasien();
                            });

                            // Jalankan pertama kali untuk adaptasi mode edit
                            evaluasiFormPasien();
                        });
                    </script>
                </div>
            </div>

            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Petugas dan saksi :</div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="petugas" class="form-label">Petugas :</label>
                            <input type="text" class="form-control" id="petugas" value="<?= esc($data->persetujuanRanap['petugas'] ?? session()->get('nama')) ?>" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="saksi" class="form-label">Saksi :</label>
                            <input type="text" class="form-control" id="saksi" placeholder="Nama saksi" value="<?= esc($data->persetujuanRanap['saksi'] ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
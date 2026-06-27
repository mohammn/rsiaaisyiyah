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
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-info">
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        $lokasiPenanganan = [];
                        if (!empty($data->rm27cPlebitis['lokasiPemasangan'])) {
                            // KOREKSI: 'lokasiPembasangan' diganti menjadi 'lokasiPemasangan'
                            $decoded = json_decode($data->rm27cPlebitis['lokasiPemasangan'], true);
                            $lokasiPenanganan = is_array($decoded) ? $decoded : [];
                        }
                        ?>
                        <div class="border border-info rounded p-2 h-100">
                            <p class="form-label fw-bold small text-secondary mb-2">Lokasi Pemasangan :</p>
                            <div class="d-flex flex-column gap-1">
                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="checkbox" name="lokasiPemasangan[]" value="Metacarpal" id="Metacarpal" <?= in_array('Metacarpal', $lokasiPenanganan) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="Metacarpal">Metacarpal</label>
                                </div>
                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="checkbox" name="lokasiPemasangan[]" value="Chepalik" id="Chepalik" <?= in_array('Chepalik', $lokasiPenanganan) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="Chepalik">Chepalik</label>
                                </div>
                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="checkbox" name="lokasiPemasangan[]" value="Vena basilic" id="VenaBasilic" <?= in_array('Vena basilic', $lokasiPenanganan) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="VenaBasilic">Vena basilic</label>
                                </div>
                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="checkbox" name="lokasiPemasangan[]" value="Digital" id="Digital" <?= in_array('Digital', $lokasiPenanganan) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="Digital">Digital</label>
                                </div>
                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="checkbox" name="lokasiPemasangan[]" value="Median cubiti" id="Mediancubiti" <?= in_array('Median cubiti', $lokasiPenanganan) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="Mediancubiti">Median cubiti</label>
                                </div>
                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="checkbox" name="lokasiPemasangan[]" value="Med antebrachial" id="Medantebrachial" <?= in_array('Med antebrachial', $lokasiPenanganan) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="Medantebrachial">Med antebrachial</label>
                                </div>
                                <div class="form-check hover-check pt-1">
                                    <div class="d-flex flex-wrap align-items-center gap-1">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input me-1" type="checkbox" name="lokasiPemasangan[]" value="Lainnya" id="lokasiPemasanganLainnya" <?= in_array('Lainnya', $lokasiPenanganan) ? 'checked' : '' ?>>
                                            <label class="form-check-label small me-1" for="lokasiPemasanganLainnya">Lainnya:</label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-info" style="max-width: 120px;" name="isilokasiPemasanganLainnya" id="isilokasiPemasanganLainnya" placeholder="sebutkan..." value="<?= $data->rm27cPlebitis['isilokasiPemasanganLainnya'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="bulan" class="form-label fw-bold small text-secondary mb-0">Bulan :</label>
                        <input type="text" name="bulan" id="bulan" class="form-control form-control-sm mb-1" value="<?= $data->rm27cPlebitis['bulan'] ?? '' ?>">

                        <label for="ruang" class="form-label fw-bold small text-secondary mb-0">Ruang :</label>
                        <input type="text" name="ruang" id="ruang" class="form-control form-control-sm mb-1" value="<?= $data->rm27cPlebitis['ruang'] ?? '' ?>">

                        <label for="umur" class="form-label fw-bold small text-secondary mb-0">Umur :</label>
                        <input type="text" name="umur" id="umur" class="form-control form-control-sm mb-1" value="<?= $data->rm27cPlebitis['umur'] ?? '' ?>">

                        <label for="diagnosa" class="form-label fw-bold small text-secondary mb-0">Diagnosa Masuk :</label>
                        <input type="text" name="diagnosa" id="diagnosa" class="form-control form-control-sm mb-1" value="<?= $data->rm27cPlebitis['diagnosa'] ?? '' ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="alert alert-info" role="alert">
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        $golObat = [];
                        if (!empty($data->rm27cPlebitis['golObat'])) {
                            $decoded_golObat = json_decode($data->rm27cPlebitis['golObat'], true);
                            $golObat = is_array($decoded_golObat) ? $decoded_golObat : [];
                        }
                        ?>
                        <div class="col-md-12 mb-3 mb-md-0 d-flex flex-column gap-2">
                            <div class="border border-info rounded p-2 flex-grow-1">
                                <p class="form-label fw-bold small text-secondary mb-2">Gol. Obat Injeksi yang diberikan :</p>
                                <div class="form-check hover-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="golObat[]" value="Antibiotik" id="Antibiotik" <?= in_array('Antibiotik', $golObat) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="Antibiotik">Antibiotik</label>
                                </div>
                                <div class="form-check hover-check mb-1">
                                    <input class="form-check-input" type="checkbox" name="golObat[]" value="Analgesik" id="Analgesik" <?= in_array('Analgesik', $golObat) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="Analgesik">Analgesik</label>
                                </div>
                                <div class="form-check hover-check pt-1">
                                    <div class="d-flex flex-wrap align-items-center gap-1">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input me-1" type="checkbox" name="golObat[]" value="Lainnya" id="golObatLainnya" <?= in_array('Lainnya', $golObat) ? 'checked' : '' ?>>
                                            <label class="form-check-label small me-1 text-nowrap" for="golObatLainnya">Lainnya:</label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-info" style="max-width: 110px;" name="isigolObatLainnya" id="isigolObatLainnya" placeholder="sebutkan..." value="<?= $data->rm27cPlebitis['isigolObatLainnya'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                            <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">No IV Cath :</label>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath18" value="18" <?= (($data->rm27cPlebitis["ivCath"] ?? '') === "18") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath18">18</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath20" value="20" <?= (($data->rm27cPlebitis["ivCath"] ?? '') === "20") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath20">20</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath22" value="22" <?= (($data->rm27cPlebitis["ivCath"] ?? '') === "22") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath22">22</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath23" value="23" <?= (($data->rm27cPlebitis["ivCath"] ?? '') === "23") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath23">23</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath26" value="26" <?= (($data->rm27cPlebitis["ivCath"] ?? '') === "26") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath26">26</label>
                            </div>
                            <div class="form-check d-flex align-items-center gap-1 flex-wrap mb-1 mb-sm-0">
                                <div class="d-flex align-items-center me-1">
                                    <input class="form-check-input me-1" type="radio" name="ivCath" id="ivCathLain" value="Lainnya" <?= (($data->rm27cPlebitis["ivCath"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                    <label class="form-check-label small text-nowrap" for="ivCathLain">Lainnya :</label>
                                </div>
                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiivCath" id="isiivCath" value="<?= $data->rm27cPlebitis['isiivCath'] ?? '' ?>">
                            </div>
                        </div>
                        <br>
                        <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                            <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Jenis Cairan :</label>
                            <div class="form-check me-3 mb-1 mb-sm-0 hover-check">
                                <input class="form-check-input" type="radio" name="jenisCairan" id="hipotonis" value="Hipotonis < 250mOsm/L" <?= (($data->rm27cPlebitis["jenisCairan"] ?? '') === "Hipotonis < 250mOsm/L") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="hipotonis">Hipotonis &lt; 250mOsm/L</label>
                            </div>
                            <div class="form-check me-2 mb-1 mb-sm-0 hover-check">
                                <input class="form-check-input" type="radio" name="jenisCairan" id="isotonis" value="Isotonis 250-375mOsm/L" <?= (($data->rm27cPlebitis["jenisCairan"] ?? '') === "Isotonis 250-375mOsm/L") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="isotonis">Isotonis 250-375mOsm/L</label>
                            </div>
                            <div class="form-check me-2 mb-1 mb-sm-0 hover-check">
                                <input class="form-check-input" type="radio" name="jenisCairan" id="hipertonis" value="Hipertonis > 375mOsm/L" <?= (($data->rm27cPlebitis["jenisCairan"] ?? '') === "Hipertonis > 375mOsm/L") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="hipertonis">Hipertonis &gt; 375mOsm/L</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th colspan="2">Item Pencegahan Plebhithis</th>
                        <?php
                        for ($i = 1; $i <= 10; $i++) : ?>
                            <td>
                                <input type="date" id="tgl<?= $i ?>" value="<?= $data->rm27cPlebitis["tgl" . $i] ?? '' ?>" name="tgl<?= $i ?>" class="form-control form-control-sm" style="width: 60px; font-size:0.60rem;">
                            </td>
                        <?php endfor;
                        ?>
                        <th>Total hari</th>
                        <th>Keterangan</th>
                    </tr>

                    <?php
                    // List Judul Baris untuk c1 sampai c17 agar looping presisi
                    $judul_tindakan = [
                        1  => "Pemasangan IV kateter baru",
                        2  => "Ruang pemasangan IV Kateter",
                        3  => "Pelepasan IV Kateter",
                        4  => "Nama pemasang IV kateter",
                        5  => "Masih ada alasan pemasangan IV kateter",
                        6  => "Pemasangan sesuai prosedur : Hand hygiene",
                        7  => "Tidak dilakukan re-palpasi setelah disenfeksi",
                        8  => "Fiksasi dengan baik, bersih, tidak basah",
                        9  => "Menggunakan closed sistem saat injeksi melalui IV kateter",
                        10 => "Dilakukan disenfeksi sebelum injeksi melalui IV Kateter",
                        11 => "Tidak ada bekuan darah/clothing",
                        12 => "SKALA 0: Tidak ada nyeri, kemerahan atau bengkak",
                        13 => "SKALA 1a: Tidak ada nyeri, tampak sedikit kemerahan < 2,5 cm, tidak ada bengkak/pengerasan",
                        14 => "SKALA 1b: Nyeri, tampak sedikit kemerahan < 2,5 cm, tidak ada bengkak/pengerasan",
                        15 => "SKALA 2: Nyeri, kemerahan tidak ada pengerasan 2,5 - 4 cm",
                        16 => "SKALA 3: Nyeri, kemerahan, bengkak tidak ada pengerasan 4 - 7,5 cm",
                        17 => "SKALA 4: Nyeri, kemerahan, bengkak tidak ada pengerasan 4 - 7,5 cm, keluar cairan purulen"
                    ];

                    for ($row = 1; $row <= 17; $row++):
                        // Judul khusus pembatas Skala Plebitis sebelum masuk baris ke-12
                        if ($row == 12): ?>
                            <tr>
                                <td colspan="2" class="align-middle bg-warning text-dark small fw-bold text-center">SKALA PENILAIAN PLEBITIS</td>
                                <?php for ($i = 1; $i <= 10; $i++) {
                                    echo "<td class='bg-warning'></td>";
                                } ?>
                                <td class="bg-warning"></td>
                                <td class="bg-warning"></td>
                            </tr>
                        <?php endif;

                        // Ambil string hari dari DB (misal: "1,2,15") lalu ubah jadi array PHP menggunakan explode
                        $db_hari_string = $data->rm27cPlebitis["c{$row}"] ?? '';
                        $hari_tercentang = !empty($db_hari_string) ? explode(',', $db_hari_string) : [];
                        ?>
                        <tr>
                            <?php if ($row >= 12):
                                // Memecah "SKALA 0:" menjadi 2 bagian kolom td
                                $split_judul = explode(': ', $judul_tindakan[$row]);
                                echo '<td class="align-middle bg-light text-secondary small fw-bold text-center">' . str_replace('SKALA ', '', $split_judul[0]) . '</td>';
                                echo '<td class="align-middle bg-light text-secondary small">' . $split_judul[1] . '</td>';
                            else: ?>
                                <td colspan="2" class="align-middle bg-light text-secondary small fw-bold"><?= $judul_tindakan[$row] ?></td>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= 10; $i++): ?>
                                <td class="text-center align-middle p-1">
                                    <div class="form-check hover-check d-inline-block m-0 p-0">
                                        <input class="form-check-input m-0"
                                            type="checkbox"
                                            name="c<?= $row ?>[]" id="c<?= $row ?>b<?= $i ?>" aria-label="c<?= $row ?>b<?= $i ?>"
                                            onclick="totalHari('<?= $row ?>')"
                                            value="<?= $i ?>" <?= in_array($i, $hari_tercentang) ? 'checked' : '' ?>>
                                    </div>
                                </td>
                            <?php endfor; ?>

                            <td id="total<?= $row ?>"></td>
                            <td>
                                <input type="text" name="ket<?= $row ?>" id="ket<?= $row ?>"
                                    value="<?= $data->rm27cPlebitis["ket{$row}"] ?? '' ?>"
                                    class="form-control form-control-sm" style="width: 80px; font-size: 0.6rem;">
                            </td>
                        </tr>
                    <?php endfor; ?>

                    <tr>
                        <td colspan="2" class="align-middle bg-light text-secondary small fw-bold">Nama dan Paraf Petugas</td>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-1">
                                <select name="petugas<?= $i ?>"
                                    id="petugas<?= $i ?>"
                                    class="form-select form-select-sm text-center appearance-none border-info p-0"
                                    style="width: 60px; font-size: 0.6rem; background: none !important; padding-right: 0 !important;"
                                    aria-label="Petugas Kolom <?= $i ?>">
                                    <option value="" <?= ($data->rm27cPlebitis["petugas" . $i] ?? '') === '' ? 'selected' : '' ?>>Pilih</option>
                                    <?php
                                    $jumlah_petugas = isset($data->petugas) ? count($data->petugas) : 0;
                                    for ($j = 0; $j < $jumlah_petugas; $j++) {
                                        $nama_petugas = $data->petugas[$j]["nama"];
                                        $selected = ($nama_petugas === ($data->rm27cPlebitis["petugas" . $i] ?? '')) ? 'selected' : '';
                                        echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        <?php endfor; ?>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</form>

<script>
    function totalHari(target) {
        total = 0;
        for (let i = 1; i <= 10; i++) {
            if ($('#c' + target + 'b' + i).is(':checked')) {
                total++;
            }
        }
        $("#total" + target).html(total);
    }

    for (let i = 1; i <= 17; i++) {
        totalHari(i);
    }
</script>
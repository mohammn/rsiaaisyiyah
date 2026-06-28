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
                    <div class="col-sm-12">
                        <div class="d-flex flex-wrap border border-info rounded p-1 mb-1 align-items-center">
                            <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Jenis Cath :</label>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="jenisCath" id="Silikon" value="Silikon" <?= (($data->rm27bKateter["jenisCath"] ?? '') === "Silikon") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="Silikon">Silikon</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="jenisCath" id="Folley" value="Folley" <?= (($data->rm27bKateter["jenisCath"] ?? '') === "Folley") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="Folley">Folley</label>
                            </div>
                            <div class="form-check d-flex align-items-center gap-1 flex-wrap mb-1 mb-sm-0">
                                <div class="d-flex align-items-center me-1">
                                    <input class="form-check-input me-1" type="radio" name="jenisCath" id="jenisCathLain" value="Lainnya" <?= (($data->rm27bKateter["jenisCath"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                    <label class="form-check-label small text-nowrap" for="jenisCathLain">Lainnya :</label>
                                </div>
                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiJenisCath" id="isiJenisCath" value="<?= $data->rm27bKateter['isiJenisCath'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-1">
                            <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jumlah pengunci :</label>
                            <input type="text" class="form-control form-control-sm border-info" name="jumlahPengunci" id="jumlahPengunci" value="<?= $data->rm27bKateter['jumlahPengunci'] ?? '' ?>">
                            <span class="small text-nowrap"> Cc</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="alert alert-info" role="alert">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                            <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">No Cath :</label>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath6" value="6" <?= (($data->rm27bKateter["ivCath"] ?? '') === "6") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath6">6</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath8" value="8" <?= (($data->rm27bKateter["ivCath"] ?? '') === "8") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath8">8</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath10" value="10" <?= (($data->rm27bKateter["ivCath"] ?? '') === "10") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath10">10</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath12" value="12" <?= (($data->rm27bKateter["ivCath"] ?? '') === "12") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath12">12</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath14" value="14" <?= (($data->rm27bKateter["ivCath"] ?? '') === "14") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath14">14</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath16" value="16" <?= (($data->rm27bKateter["ivCath"] ?? '') === "16") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath16">16</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath18" value="18" <?= (($data->rm27bKateter["ivCath"] ?? '') === "18") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath18">18</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath20" value="20" <?= (($data->rm27bKateter["ivCath"] ?? '') === "20") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath20">20</label>
                            </div>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="ivCath" id="ivCath22" value="22" <?= (($data->rm27bKateter["ivCath"] ?? '') === "22") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="ivCath22">22</label>
                            </div>
                            <div class="form-check d-flex align-items-center gap-1 flex-wrap mb-1 mb-sm-0">
                                <div class="d-flex align-items-center me-1">
                                    <input class="form-check-input me-1" type="radio" name="ivCath" id="ivCathLain" value="Lainnya" <?= (($data->rm27bKateter["ivCath"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                    <label class="form-check-label small text-nowrap" for="ivCathLain">Lainnya :</label>
                                </div>
                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiivCath" id="isiivCath" value="<?= $data->rm27bKateter['isiivCath'] ?? '' ?>">
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
                        <th colspan="2">Item Pencegahan ISK</th>
                        <?php
                        for ($i = 1; $i <= 10; $i++) : ?>
                            <td>
                                <input type="date" id="tgl<?= $i ?>" value="<?= $data->rm27bKateter["tgl" . $i] ?? '' ?>" name="tgl<?= $i ?>" class="form-control form-control-sm" style="width: 60px; font-size:0.60rem;">
                            </td>
                        <?php endfor;
                        ?>
                        <th>Total hari</th>
                        <th>Keterangan</th>
                    </tr>

                    <?php
                    // List Judul Baris untuk c1 sampai c19 agar looping presisi
                    $judul_tindakan = [
                        1  => "Pemasangan kateter urin",
                        2  => "Pelepasan kateter urin",
                        3  => "Pemasangan dengan teknik aseptik",
                        4  => "Fiksasi kateter terpasang dengan baik",
                        5  => "Urin bag dibawah bladder",
                        6  => "Urin bag menyentuh lantai",
                        7  => "Bladder training dengan klem kateter",
                        8  => "Membuka sambungan antara selang kateter dan selang urin bag",
                        9  => "Perineal hygiene sebelum pemasangan kateter dengan air dan sabun",
                        10 => "Gelas ukur terpisah antar pasien",
                        11 => "Masih ada indikasi pemakaian kateter urin",
                        12 => "SKALA a: Demam &ge;38°C",
                        13 => "SKALA a: Nyeri supra pubik",
                        14 => "SKALA a: Nyeri costovertebral angel",
                        15 => "SKALA a: Urgency urin (keinginan yang kuat dan tiba-tiba untuk berkemih)",
                        16 => "SKALA a: Frequency urin (sering BAK yang tidak normal)",
                        17 => "SKALA a: Dysuria (rasa nyeri dan tidak nyaman saat kencing)",
                        18 => "SKALA b: Kuman biakan urin ≥ 10⁵ (CFU) / ml ",
                        19 => "SKALA c: Pyuria (urin spesimen dengan ≥ 10 WBC/mm³)"
                    ];

                    for ($row = 1; $row <= 19; $row++):
                        // Judul khusus pembatas Skala Plebitis sebelum masuk baris ke-12
                        if ($row == 12): ?>
                            <tr>
                                <td colspan="2" class="align-middle bg-warning text-dark small fw-bold text-center">GEJALA ISK</td>
                                <?php for ($i = 1; $i <= 10; $i++) {
                                    echo "<td class='bg-warning'></td>";
                                } ?>
                                <td class="bg-warning"></td>
                                <td class="bg-warning"></td>
                            </tr>
                        <?php endif;

                        // Ambil string hari dari DB (misal: "1,2,15") lalu ubah jadi array PHP menggunakan explode
                        $db_hari_string = $data->rm27bKateter["c{$row}"] ?? '';
                        $hari_tercentang = !empty($db_hari_string) ? explode(',', $db_hari_string) : [];
                        ?>
                        <tr>
                            <?php if ($row >= 12):
                                // Memecah "SKALA 0:" menjadi 2 bagian kolom td
                                $split_judul = explode(': ', $judul_tindakan[$row]);
                                if ($row == 12):
                                    echo '<td rowspan="6" class="align-middle bg-light text-secondary small fw-bold text-center">' . str_replace('SKALA ', '', $split_judul[0]) . '</td>';
                                elseif ($row >= 18):
                                    echo '<td class="align-middle bg-light text-secondary small fw-bold text-center">' . str_replace('SKALA ', '', $split_judul[0]) . '</td>';
                                endif;
                                echo '<td class="align-middle bg-light text-secondary small">' . $split_judul[1] . '</td>';
                            else: ?>
                                <td class="align-middle bg-light text-secondary small fw-bold text-center"><?= $row ?></td>
                                <td class="align-middle bg-light text-secondary small fw-bold"><?= $judul_tindakan[$row] ?></td>
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
                                    value="<?= $data->rm27bKateter["ket{$row}"] ?? '' ?>"
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
                                    <option value="" <?= ($data->rm27bKateter["petugas" . $i] ?? '') === '' ? 'selected' : '' ?>>Pilih</option>
                                    <?php
                                    $jumlah_petugas = isset($data->petugas) ? count($data->petugas) : 0;
                                    for ($j = 0; $j < $jumlah_petugas; $j++) {
                                        $nama_petugas = $data->petugas[$j]["nama"];
                                        $selected = ($nama_petugas === ($data->rm27bKateter["petugas" . $i] ?? '')) ? 'selected' : '';
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

    for (let i = 1; i <= 19; i++) {
        totalHari(i);
    }
</script>
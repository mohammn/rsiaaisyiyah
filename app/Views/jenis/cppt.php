<?php

/** @var object $data */
?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>


<div class="container-fluid px-4">
    <h4 class="mt-2 text-center">Rekam Medis Pasien</h4>

    <?= view('jenis/menu', ['data' => $data]) ?>

    <div class="card mb-4">
        <!-- Card Header: Navigasi Kiri & Toolbar Aksi Kanan -->
        <div class="card-header bg-white border-0 pt-3 pb-3 d-flex flex-column flex-lg-row align-items-center justify-content-between gap-3">

            <!-- 1. DPJP (Kiri) -->
            <div class="flex-shrink-0">
                <div class="alert alert-secondary d-inline-flex align-items-center mb-0 py-2 px-3 border-0 bg-secondary-subtle text-secondary-emphasis rounded-pill shadow-xs">
                    <i class="fas fa-user-md me-2"></i>
                    <span class="small fw-bold">
                        DPJP : <?= $data->dpjp['dokter'] ?? 'Belum diisi.' ?>
                    </span>
                </div>
            </div>

            <!-- 2. Info Pasien (Tengah) -->
            <div class="flex-grow-1 text-center">
                <div class="alert alert-primary d-inline-flex flex-wrap align-items-center justify-content-center mb-0 py-2 px-3 border-0 bg-primary-subtle text-primary-emphasis rounded-pill shadow-xs">
                    <i class="fas fa-id-badge me-2 fs-6"></i>
                    <span class="small">
                        Menampilkan CPPT pasien:
                        <strong class="bg-vibrant-blue text-white px-3 py-1 rounded-pill ms-1 d-inline-block mt-1 mt-sm-0">
                            <?= $data->pasien["nm_pasien"] ?> . (<?= $data->pasien["no_rawat"] ?>)
                        </strong>
                    </span>
                </div>
            </div>

            <!-- 3. Tombol Cetak (Kanan - Tanpa position-absolute!) -->
            <div class="flex-shrink-0">
                <a href="<?= base_url('jenis/cppt/cetakCppt/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 py-1 border-0 fw-small shadow-none">
                    <i class="fas fa-print me-1"></i> Cetak
                </a>
            </div>

        </div>

        <!-- Card Body: Highlight Pasien & Data Tabel -->
        <div class="card-body" style="overflow-y: auto; max-height: calc(100vh - 300px);">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Tanggal/Jam</th>
                        <th style="width: 60%;">Hasil Pemeriksaan</th>
                        <th style="width: 20%;">Petugas/Dokter</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data->cppt)): ?>
                        <?php foreach ($data->cppt as $index => $item): ?>
                            <tr style="<?= $index % 2 === 1 ? 'background-color: #fdfdfd;' : '' ?>">
                                <td class="align-top"><?= $index + 1 ?></td>

                                <!-- Tanggal / Jam / Sumber -->
                                <td class="align-top">
                                    <div><?= esc($item['tanggal_hasil']) ?></div>
                                    <div class="text-xs text-gray-500" style="font-size: 0.75rem; color: #6c757d;"><?= esc($item['jam_hasil']) ?></div>
                                    <div class="badge badge-outline badge-sm mt-1" style="border: 1px solid #ccc;  color: #6c757d; padding: 2px 6px; font-size: 0.75rem; border-radius: 4px; display: inline-block; margin-top: 4px;">
                                        <?= esc($item['sumber'] ?? '-') ?>
                                    </div>
                                </td>

                                <!-- Hasil Pemeriksaan (SOAP vs SBAR) -->
                                <td class="align-top">
                                    <?php if (($item['jenis_hasil'] ?? '') === 'SOAP'): ?>
                                        <div class="space-y-2" style="display: flex; flex-direction: column; gap: 8px;">
                                            <!-- Subjective (S) -->
                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">S</div>
                                                <div style="flex: 1; white-space: pre-line;"><?= esc($item['keluhan'] ?? '-') ?></div>
                                            </div>

                                            <!-- Objective (O) -->
                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #dbeafe; color: #1e3a8a; border: 1px solid #bfdbfe;">O</div>
                                                <div style="flex: 1;">
                                                    <div style="white-space: pre-line;"><?= esc($item['pemeriksaan'] ?? '-') ?></div>
                                                    <div style="margin-top: 8px; display: flex; flex-wrap: wrap; gap: 4px; font-size: 0.75rem;">
                                                        <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">TD <?= esc($item['tensi'] ?? '-') ?></span>
                                                        <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">N <?= esc($item['nadi'] ?? '-') ?>/mnt</span>
                                                        <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">RR <?= esc($item['respirasi'] ?? '-') ?>/mnt</span>
                                                        <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">S <?= esc($item['suhu_tubuh'] ?? '-') ?></span>
                                                        <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">SpO2 <?= esc($item['spo2'] ?? '-') ?></span>
                                                        <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">GCS <?= esc($item['gcs'] ?? '-') ?></span>
                                                        <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">TB <?= esc($item['tinggi'] ?? '-') ?> cm</span>
                                                        <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">BB <?= esc($item['berat'] ?? '-') ?> kg</span>
                                                        <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;"><?= esc($item['kesadaran'] ?? '-') ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Assessment (A) -->
                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe;">A</div>
                                                <div style="flex: 1; white-space: pre-line;"><?= esc($item['penilaian'] ?? '-') ?></div>
                                            </div>

                                            <!-- Plan (P) -->
                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0;">P</div>
                                                <div style="flex: 1; white-space: pre-line;"><?= esc($item['rtl'] ?? '-') ?></div>
                                            </div>

                                            <!-- Instruction (I) -->
                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #fef9c3; color: #854d0e; border: 1px solid #fde68a;">I</div>
                                                <div style="flex: 1; white-space: pre-line;"><?= esc($item['instruksi'] ?? '-') ?></div>
                                            </div>

                                            <!-- Evaluation (E) -->
                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #ccfbf1; color: #115e59; border: 1px solid #99f6e4;">E</div>
                                                <div style="flex: 1; white-space: pre-line;"><?= esc($item['evaluasi'] ?? '-') ?></div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <!-- SBAR -->
                                        <div style="display: flex; flex-direction: column; gap: 8px;">
                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">S</div>
                                                <div style="flex: 1; white-space: pre-line;"><?= esc($item['s'] ?? '-') ?></div>
                                            </div>

                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #dbeafe; color: #1e3a8a; border: 1px solid #bfdbfe;">B</div>
                                                <div style="flex: 1; white-space: pre-line;"><?= esc($item['b'] ?? '-') ?></div>
                                            </div>

                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe;">A</div>
                                                <div style="flex: 1; white-space: pre-line;"><?= esc($item['a'] ?? '-') ?></div>
                                            </div>

                                            <div style="display: flex; align-items: stretch; gap: 8px;">
                                                <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0;">R</div>
                                                <div style="flex: 1; white-space: pre-line;"><?= esc($item['r'] ?? '-') ?></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <!-- Petugas / Dokter -->
                                <td class="align-top">

                                    <?php if (($item['jenis_hasil'] ?? '') != 'SBAR'): ?>
                                        <div><?= esc($item['nama_pelaksana'] ?? '-') ?></div>
                                    <?php endif; ?>

                                    <?php if (($item['jenis_hasil'] ?? '') != 'SBAR' && !empty($item['jenis_pelaksana'])): ?>
                                        <div style="margin-top: 4px; display: flex; flex-wrap: wrap; gap: 4px;">
                                            <span style="border: 1px solid #ccc; padding: 2px 6px; font-size: 0.75rem; border-radius: 4px; display: inline-block;">
                                                <?= esc($item['jenis_pelaksana']) ?>
                                            </span>

                                            <?php if (($item['jenis_pelaksana'] ?? '') != 'Dokter'): ?>

                                                <?php if (!empty($item['waktuVerif'])): ?>
                                                    <!-- Tampilan Jika Dokter & Sudah Diverifikasi -->
                                                    <span style="border: 1px solid #198754; color: #198754; background-color: #e8f5e9; padding: 2px 6px; font-size: 0.75rem; border-radius: 4px; display: inline-block;" title="Diverifikasi pada: <?= esc($item['waktuVerif']) ?>">
                                                        ✓ Verified
                                                    </span>
                                                <?php else: ?>
                                                    <!-- Tampilan Jika Dokter & Belum Diverifikasi -->
                                                    <span style="border: 1px solid #dc3545; color: #dc3545; background-color: #ffebee; padding: 2px 6px; font-size: 0.75rem; border-radius: 4px; display: inline-block;">
                                                        Belum Verif
                                                    </span>

                                                    <?php if (($data->dpjp['dokter'] ?? '') === session()->get('nama')): ?>
                                                        <button type="button"
                                                            class="btn btn-info btn-sm ms-1"
                                                            style="padding: 1px 6px; font-size: 0.75rem;"
                                                            onclick="verif('<?= esc($item['no_rawat']) ?>', '<?= esc($item['tanggal_hasil']) ?>', '<?= esc($item['jam_hasil']) ?>')">
                                                            Verifikasi
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if (!empty($item['penerima'])): ?>
                                                    <!-- Jika Sudah Ada Penerima -->
                                                    <span style="background: #fef9c3; border: 1px solid #ffc107; color: #334155; padding: 2px 6px; font-size: 0.75rem; border-radius: 4px; display: inline-block;">
                                                        Penerima : <?= esc($item['penerima']) ?>

                                                        <!-- Tombol Hapus Serah Terima -->
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm ms-1"
                                                            style="padding: 0px 5px; font-size: 0.70rem; line-height: 1.0;"
                                                            title="Hapus Serah Terima"
                                                            onclick="hapusSerahTerima('<?= esc($item['no_rawat']) ?>', '<?= esc($item['tanggal_hasil']) ?>', '<?= esc($item['jam_hasil']) ?>')">
                                                            &times;
                                                        </button>
                                                    </span>


                                                <?php else: ?>
                                                    <!-- Jika Belum Ada Penerima -->
                                                    <button type="button"
                                                        class="btn btn-warning btn-sm ms-1"
                                                        style="padding: 1px 6px; font-size: 0.75rem;"
                                                        onclick="serahTerima('<?= esc($item['no_rawat']) ?>', '<?= esc($item['tanggal_hasil']) ?>', '<?= esc($item['jam_hasil']) ?>')">
                                                        Serah terima
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if (!empty($item['jabatan_pelaksana'])): ?>
                                                <span style="background: #f1f5f9; padding: 2px 6px; font-size: 0.75rem; border-radius: 4px; display: inline-block;">
                                                    <?= esc($item['jabatan_pelaksana']) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (($item['jenis_hasil'] ?? '') === 'SBAR' && !empty($item['dokter'])): ?>
                                        <div style="margin-top: 4px;"><?= esc($item['petugas']) ?></div>
                                        <div style="margin-top: 4px;">
                                            <span style="border: 1px solid #ccc; padding: 2px 6px; font-size: 0.75rem; border-radius: 4px; display: inline-block;">Petugas</span>
                                        </div>
                                        <div style="margin-top: 12px;"><?= esc($item['dokter']) ?></div>
                                        <div style="margin-top: 4px;">
                                            <span style="border: 1px solid #ccc; padding: 2px 6px; font-size: 0.75rem; border-radius: 4px; display: inline-block;">Dokter</span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center" style="text-align: center; padding: 20px;">Belum ada data CPPT</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalSerahTerima" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Serah Terima</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Memilih Penerima untuk No. Rawat : <b id="sNo">-</b>. Tanggal : <b id="sTgl">--/--/----</b>. Jam : <b id="sJam">--:--</b>. <br>
                <br>
                <p class="form-label fw-bold small text-secondary mb-0">Penerima :</p>
                <select name="penerima" id="penerima" class="form-select">
                    <?php for ($i = 0; $i < count($data->petugas); $i++) {
                        echo '<option value="' . $data->petugas[$i]["nama"] . '" >' . $data->petugas[$i]["nama"] . '</option>';
                    } ?>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-estetik btn-simpan" onclick="prosesSerahTerima()">Proses</button>
            </div>
        </div>
    </div>
</div>

<script>
    function verif(noRawat, tanggal, jam) {
        if (confirm('Apakah Anda yakin ingin memverifikasi data CPPT ini?')) {
            $.ajax({
                url: '<?= base_url() ?>jenis/cppt/verifCppt',
                method: 'post',
                data: {
                    noRawat: noRawat,
                    tanggal: tanggal,
                    jam: jam,
                    // Menambahkan CSRF Token jika CSRF Protection di CI4 aktif
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function(data) {
                    location.reload();
                }
            });
        }
    }

    function serahTerima(noRawat, tanggal, jam) {
        $('#sNo').html(noRawat);
        $('#sTgl').html(tanggal);
        $('#sJam').html(jam);
        $("#modalSerahTerima").modal('show');
    }

    function prosesSerahTerima() {
        var data = {
            noRawat: $('#sNo').html(),
            tanggal: $('#sTgl').html(),
            jam: $('#sJam').html(),
            penerima: $('#penerima').val(),
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        }

        $.ajax({
            url: '<?= base_url() ?>jenis/cppt/serahTerima',
            method: 'post',
            data: data,
            dataType: 'json',
            success: function(data) {
                location.reload();
            }
        });
    }

    function hapusSerahTerima(noRawat, tanggal, jam) {
        if (confirm('Apakah Anda yakin ingin menghapus data serah terima ini?')) {
            $.ajax({
                url: '<?= base_url() ?>jenis/cppt/hapusSerahTerima',
                method: 'post',
                data: {
                    noRawat: noRawat,
                    tanggal: tanggal,
                    jam: jam,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        alert('Gagal menghapus data!');
                    }
                }
            });
        }
    }
</script>

<?php $this->endSection() ?>
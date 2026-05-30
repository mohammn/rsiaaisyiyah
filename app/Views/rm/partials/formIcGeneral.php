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
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->icGeneral['nama'] ?? '' ?>"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" <?= (empty($data->icGeneral['jk'])) ? 'selected' : '' ?> disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?= (($data->icGeneral['jk'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= (($data->icGeneral['jk'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?= $data->icGeneral['tempatLahir'] ?? '' ?>">
                    </div>
                    <div class="col-2">
                        Tgl Lahir :
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control" value="<?= $data->icGeneral['tanggalLahir'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-8">
                        <input type="text" class="form-control" id="nik" placeholder="Nomor Identitas (NIK)" value="<?= $data->icGeneral['nik'] ?? '' ?>">
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
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data->icGeneral['alamat'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sebagai" class="form-label">Beritindak sebagai :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->icGeneral['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->icGeneral['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->icGeneral['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->icGeneral['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->icGeneral['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->icGeneral['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->icGeneral['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->icGeneral['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->icGeneral['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->icGeneral['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
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
        </div>
        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Pemberian informasi :</div>
                    <hr>
                </div>

                <div class="row mb-3 mt-2">
                    <div class="col-6">
                        <label for="petugas" class="form-label">Dokter :</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="" <?= (empty($data->icGeneral['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (($data->icGeneral['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="petugas" class="form-label">Petugas :</label>
                        <input type="text" class="form-control" id="petugas" value="<?= $data->icGeneral['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-7">
                        <textarea type="text" class="form-control" id="tindakanMedis" rows="2" placeholder="Masukkan tindakan medis pasien disini.."><?= $data->icGeneral['tindakanMedis'] ?? '' ?></textarea>
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" id="saksi" placeholder="Saksi" value="<?= $data->icGeneral['saksi'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mt-4 mb-2 rounded border border-info-subtle bg-info-subtle p-3 align-items-end shadow-sm">
                    <div class="col-md-6">
                        <label for="judul" class="form-label fw-bold text-dark mb-1" style="font-size: 0.95rem;">
                            Judul <i>Informed Consent</i> :
                        </label>
                        <input type="text" class="form-control form-control-lg border-2 border-secondary bg-white fw-semibold" id="judul" value="<?= $data->icGeneral['judul'] ?? '' ?>">
                    </div>
                    <div class="col-md-6 mt-2 mt-md-0">
                        <label class="form-label d-block fw-bold text-info-emphasis mb-2" style="font-size: 0.9rem;">
                            JENIS <i>INFORMED CONSENT</i> :
                        </label>
                        <div class="btn-group btn-group-sm w-100" role="group">
                            <input type="radio" class="btn-check" name="jenis" id="setuju" value="setuju"
                                <?= (($data->icGeneral['jenis'] ?? 'setuju') === 'setuju') ? 'checked' : '' ?>>
                            <label class="btn btn-outline-success py-2 fw-bold" for="setuju">
                                <i class="fas fa-check fa-sm me-1"></i> PERSETUJUAN
                            </label>

                            <input type="radio" class="btn-check" name="jenis" id="tolak" value="tolak"
                                <?= (($data->icGeneral['jenis'] ?? '') === 'tolak') ? 'checked' : '' ?>>
                            <label class="btn btn-outline-danger py-2 fw-bold" for="tolak">
                                <i class="fas fa-times fa-sm me-1"></i> PENOLAKAN
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card border-info shadow-sm">
                <div class="card-header bg-info text-white text-center py-3">
                    <h5 class="card-title mb-0 fw-bold">
                        <i class="fas fa-info-circle me-2"></i> PEMBERIAN INFORMASI
                    </h5>
                </div>

                <div class="card-body bg-light">
                    <div class="mb-3">
                        <label for="diagnosis" class="form-label fw-bold text-secondary">1. Diagnosis</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info-subtle border-info-subtle"><i class="fas fa-stethoscope text-info"></i></span>
                            <textarea class="form-control border-info-subtle" id="diagnosis" rows="2"><?= $data->icGeneral['diagnosis'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dasar" class="form-label fw-bold text-secondary">2. Dasar Diagnosis</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info-subtle border-info-subtle"><i class="fas fa-notes-medical text-info"></i></span>
                            <textarea class="form-control border-info-subtle" id="dasar" rows="2"><?= $data->icGeneral['dasar'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tindakan" class="form-label fw-bold text-secondary">3. Tindakan Kedokteran</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info-subtle border-info-subtle"><i class="fas fa-syringe text-info"></i></span>
                            <textarea class="form-control border-info-subtle" id="tindakan" rows="2"><?= $data->icGeneral['tindakan'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="indikasi" class="form-label fw-bold text-secondary">4. Indikasi Tindakan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info-subtle border-info-subtle"><i class="fas fa-exclamation-circle text-info"></i></span>
                            <textarea class="form-control border-info-subtle" id="indikasi" rows="2"><?= $data->icGeneral['indikasi'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tataCara" class="form-label fw-bold text-secondary">5. Tata Cara</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info-subtle border-info-subtle"><i class="fas fa-list-ol text-info"></i></span>
                            <textarea class="form-control border-info-subtle" id="tataCara" rows="2"><?= $data->icGeneral['tataCara'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tujuan" class="form-label fw-bold text-secondary">6. Tujuan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info-subtle border-info-subtle"><i class="fas fa-bullseye text-info"></i></span>
                            <textarea class="form-control border-info-subtle" id="tujuan" rows="2"><?= $data->icGeneral['tujuan'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="risiko" class="form-label fw-bold text-secondary">7. Risiko</label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger-subtle border-danger-subtle"><i class="fas fa-heart-broken text-danger"></i></span>
                            <textarea class="form-control border-danger-subtle" id="risiko" rows="2"><?= $data->icGeneral['risiko'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="komplikasi" class="form-label fw-bold text-secondary">8. Komplikasi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger-subtle border-danger-subtle"><i class="fas fa-biohazard text-danger"></i></span>
                            <textarea class="form-control border-danger-subtle" id="komplikasi" rows="2"><?= $data->icGeneral['komplikasi'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="prognosis" class="form-label fw-bold text-secondary">9. Prognosis</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info-subtle border-info-subtle"><i class="fas fa-chart-line text-info"></i></span>
                            <textarea class="form-control border-info-subtle" id="prognosis" rows="2"><?= $data->icGeneral['prognosis'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alternatif" class="form-label fw-bold text-secondary">10. Alternatif</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info-subtle border-info-subtle"><i class="fas fa-code-branch text-info"></i></span>
                            <textarea class="form-control border-info-subtle" id="alternatif" rows="2"><?= $data->icGeneral['alternatif'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label for="lainLain" class="form-label fw-bold text-secondary">11. Lain-lain</label>
                        <div class="input-group">
                            <span class="input-group-text bg-info-subtle border-info-subtle"><i class="fas fa-ellipsis-h text-info"></i></span>
                            <textarea class="form-control border-info-subtle" id="lainLain" rows="2"><?= $data->icGeneral['lainLain'] ?? '' ?></textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
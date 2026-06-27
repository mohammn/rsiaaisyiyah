<?php

/** @var object $data */
?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <a class="btn btn-estetik btn-simpan" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>">Kembali</a>
            <a class="btn btn-estetik btn-lihat" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>#modalTambahForm">Daftar Form</a>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <div class="text-center">
                <h5 class="text-uppercase">BUNDLE PENGUMPULAN DATA SURVEILANS INFEKSI LUKA OPERASI</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->lukaOperasi) : ?>
                <div class="row">

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Pre Operasi :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Petugas Pre Operasi</td>
                                    <td>: <?= $data->lukaOperasi["petugasPreOperasi"] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Operasi</td>
                                    <td>: <?= !empty($data->lukaOperasi["tglOperasi"]) ? date('d/m/Y', strtotime($data->lukaOperasi["tglOperasi"])) : '' ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal MRS</td>
                                    <td>: <?= !empty($data->lukaOperasi["tglMrs"]) ? date('d/m/Y', strtotime($data->lukaOperasi["tglMrs"])) : '' ?></td>
                                </tr>
                                <tr>
                                    <td>Berat Badan</td>
                                    <td>: <?= $data->lukaOperasi["beratBadan"] ?? '...' ?> Kg</td>
                                </tr>
                                <tr>
                                    <td>Jenis Operasi</td>
                                    <td>: <?= $data->lukaOperasi["jenisOps"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Diagnosa Pre Operasi</td>
                                    <td>: <?= $data->lukaOperasi["diagnosaPre"] ?? '' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row ">
                                <div class="col-12 text-center">Data ruang operasi :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Petugas Ruang Operasi</td>
                                    <td>: <?= $data->lukaOperasi["petugasRuangOperasi"] ?></td>
                                </tr>
                                <tr>
                                    <td>Ruang Operasi</td>
                                    <td>: <?= $data->lukaOperasi["ruangOperasi"] ?? '...' ?> Ronde : <?= $data->lukaOperasi["ronde"] ?? '...' ?></td>
                                </tr>
                                <tr>
                                    <td>Lama operasi</td>
                                    <td>: Mulai Jam : <?= $data->lukaOperasi["jamMulaiOps"] ?? '...' ?>. Selesai Jam : <?= $data->lukaOperasi["jamSelesaiOps"] ?? '...' ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah staff</td>
                                    <td>: <?= $data->lukaOperasi["jumlahStaff"] ?? '' ?> Orang</td>
                                </tr>
                                <tr>
                                    <td>Diagnosa Post Operasi</td>
                                    <td>: <?= $data->lukaOperasi["diagnosaPost"] ?? '...' ?></td>
                                </tr>
                                <tr>
                                    <td>ASA Score</td>
                                    <td>: <?= $data->lukaOperasi["asaScore"] ?? '' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/lukaOperasi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->lukaOperasi['id']) ?>" target="_blank">
                            <i class="fas fa-print me-1"></i> Cetak
                        </a>
                        <button class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                            <i class="fa fa-edit me-1"></i> Edit
                        </button>
                        <button class="btn btn-estetik btn-hapus" onclick="tryHapus()">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formLukaOperasi.php") ?>

                <div class="text-center">
                    <div class="bg-info" id="pesanError"> </div>
                    <br>
                    <a class="btn btn-estetik btn-hapus" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>"><i class="fas fa-cancel me-1"></i> Batal</a>
                    <button class="btn btn-estetik btn-simpan" onclick="simpan('tambah')">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Modal edit-->
<div class="modal fade modal-xl  modal-dialog-scrollable" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data Wali pasien atas nama : <b id="namaPasienJudulEdit"></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->include("rm/partials/formLukaOperasi.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->lukaOperasi['id'] ?? '' ?>)">
                    <i class="fa fa-floppy-o me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal hapus-->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Form pasien atas nama <b id="namaPasienHapus"></b> dengan no Rawat : <b id="noRawatHapus"></b> ? <br>
                <div class="alert alert-warning p-1 mt-2"> <i class="fa-solid fa-triangle-exclamation"></i> Peringatan ! Data tidak dapat dikembalikan.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-hapus" onclick="hapus()">
                    <i class="fas fa-trash-alt me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function simpan(tujuanSimpan) {

        var data = {
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            // Input Text, Date, Time
            unit: $('#unit').val(),
            petugasPreOperasi: $('#petugasPreOperasi').val(),
            tglMrs: $('#tglMrs').val(),
            tglOperasi: $('#tglOperasi').val(),
            beratBadan: $('#beratBadan').val(),
            albumin: $('#albumin').val(),
            isiGulaDarah: $('#isiGulaDarah').val(),
            waktuPencukuran: $('#waktuCukur').val(),
            persiapanUsusDg: $('#persiapanUsusDg').val(),
            isiPenyakitLainnya: $('#isiPenyakitLainnya').val(),

            // Radio Buttons (Mengambil nilai yang sedang di-check)
            suhuPasien: $('input[name="suhuPasien"]:checked').val() || '',
            merokok: $('input[name="merokok"]:checked').val() || '',
            mrsa: $('input[name="mrsa"]:checked').val() || '',
            hasilMrsa: $('input[name="hasilMrsa"]:checked').val() || '',
            jenisOps: $('input[name="jenisOps"]:checked').val() || '',
            trauma: $('input[name="trauma"]:checked').val() || '',
            gulaDarah: $('input[name="gulaDarah"]:checked').val() || '',
            pencukuran: $('input[name="pencukuran"]:checked').val() || '',
            persiapanUsus: $('input[name="persiapanUsus"]:checked').val() || '',

            // Checkbox Multipel (Penyakit Saat Ini)
            penyakit: $('input[name="penyakit[]"]:checked').map(function() {
                return this.value;
            }).get(),

            // --- Lanjutan Item Array / Properti Data ---

            // Input Text, Time, dll.
            diagnosaPre: $('#diagnosaPre').val(),
            isiSteroid: $('#isiSteroid').val(),
            isiKualifikasiLainnya: $('#isiKualifikasiLainnya').val(),
            isipenyakitInfeksiLainnya: $('#isipenyakitInfeksiLainnya').val(),
            profilaksisObat: $('#profilaksisObat').val(),
            profilaksisJam: $('#profilaksisJam').val(),
            profilaksisDosis: $('#profilaksisDosis').val(),
            skintestHasil: $('#skintestHasil').val(),

            ronde: $('#ronde').val(),
            isiSuhuPasien: $('#isiSuhuPasien').val(),

            // Radio Buttons
            steroid: $('input[name="steroid"]:checked').val() || '',
            mandi: $('input[name="mandi"]:checked').val() || '',
            radioterapi: $('input[name="radioterapi"]:checked').val() || '',
            profilaksis: $('input[name="profilaksis"]:checked').val() || '',
            skintest: $('input[name="skintest"]:checked').val() || '',

            // Checkbox Multipel
            kualifikasi: $('input[name="kualifikasi[]"]:checked').map(function() {
                return this.value;
            }).get(),

            penyakitInfeksi: $('input[name="penyakitInfeksi[]"]:checked').map(function() {
                return this.value;
            }).get(),


            // --- Lanjutan Item Array / Properti Data (Bagian 2.1) ---

            // Input Text biasa
            petugasRuangOperasi: $('#petugasRuangOperasi').val(),
            sirkulasi: $('#sirkulasi').val(),
            suhuRuang: $('#suhuRuang').val(),
            kelembapan: $('#kelembapan').val(),
            angkaKuman: $('#angkaKuman').val(),
            isiprosedurOperasiLainnya: $('#isiprosedurOperasiLainnya').val(),
            isiprosedurOperasiLainnya2: $('#isiprosedurOperasiLainnya2').val(),
            drainJenis: $('#drainJenis').val(),
            implantJenis: $('#implantJenis').val(),

            // Radio Buttons
            ruangOperasi: $('input[name="ruangOperasi"]:checked').val() || '',
            tekananUdara: $('input[name="tekananUdara"]:checked').val() || '',
            multiProsedur: $('input[name="multiProsedur"]:checked').val() || '',
            jamurAc: $('input[name="jamurAc"]:checked').val() || '',
            drain: $('input[name="drain"]:checked').val() || '',
            implant: $('input[name="implant"]:checked').val() || '',

            // Checkbox Multipel (Prosedur Operasi)
            prosedurOperasi: $('input[name="prosedurOperasi[]"]:checked').map(function() {
                return this.value;
            }).get(),

            // --- Lanjutan Item Array / Properti Data (Bagian 2.2) ---

            // Input Text, Time, dan sejenisnya
            antibiotikObat: $('#antibiotikObat').val(),
            antibiotikJam: $('#antibiotikJam').val(),
            antibiotikDosis: $('#antibiotikDosis').val(),
            jumlahStaff: $('#jumlahStaff').val(),
            jamMulaiOps: $('#jamMulaiOps').val(),
            jamSelesaiOps: $('#jamSelesaiOps').val(),
            isiDisinfeksiKulitLainnya: $('#isiDisinfeksiKulitLainnya').val(),
            diagnosaPost: $('#diagnosaPost').val(),

            // Radio Buttons
            sterilisasi: $('input[name="sterilisasi"]:checked').val() || '',
            asaScore: $('input[name="asaScore"]:checked').val() || '',
            antibiotik: $('input[name="antibiotik"]:checked').val() || '',
            indikator: $('input[name="indikator"]:checked').val() || '',
            klasifikasiLuka: $('input[name="klasifikasiLuka"]:checked').val() || '',
            disinfeksiKulit: $('input[name="disinfeksiKulit"]:checked').val() || '',


            // --- Post operasiiiiiiii ---

            // Input Text Tambahan di baris Antibiotik
            isiAntibiotik: $('#isiAntibiotik').val() || '',

            // Array Input Text Bulan (Looping presisi dari ID bulan1 sampai bulan31)
            bulan: Array.from({
                length: 31
            }, (_, i) => $(`#bulan${i+1}`).val() || ''),

            // 1. Checkbox Tindakan Per Hari (Mengembalikan array berisi angka hari jika di-centang)
            rawatLuka: $('input[id^="rawatLuka"]:checked').map(function() {
                return this.id.replace('rawatLuka', '');
            }).get(),
            transparan: $('input[id^="transparan"]:checked').map(function() {
                return this.id.replace('transparan', '');
            }).get(),
            thypafix: $('input[id^="thypafix"]:checked').map(function() {
                return this.id.replace('thypafix', '');
            }).get(),
            drainTindakan: $('input[id^="drainTindakan"]:checked').map(function() {
                return this.id.replace('drainTindakan', '');
            }).get(),
            aff: $('input[id^="aff"]:checked').map(function() {
                return this.id.replace('aff', '');
            }).get(),
            angkat: $('input[id^="angkat"]:checked').map(function() {
                return this.id.replace('angkat', '');
            }).get(),
            antibiotikTindakan: $('input[id^="antibiotikTindakan"]:checked').map(function() {
                return this.id.replace('antibiotikTindakan', '');
            }).get(),
            krs: $('input[id^="krs"]:checked').map(function() {
                return this.id.replace('krs', '');
            }).get(),
            kontrol: $('input[id^="kontrol"]:checked').map(function() {
                return this.id.replace('kontrol', '');
            }).get(),
            mrs: $('input[id^="mrs"]:checked').map(function() {
                return this.id.replace('mrs', '');
            }).get(),

            // 2. Checkbox Identifikasi ILO Per Hari
            nyeri: $('input[id^="nyeri"]:checked').map(function() {
                return this.id.replace('nyeri', '');
            }).get(),
            demam: $('input[id^="demam"]:checked').map(function() {
                return this.id.replace('demam', '');
            }).get(),
            kemerahan: $('input[id^="kemerahan"]:checked').map(function() {
                return this.id.replace('kemerahan', '');
            }).get(),
            drainase: $('input[id^="drainase"]:checked').map(function() {
                return this.id.replace('drainase', '');
            }).get(),
            bengkak: $('input[id^="bengkak"]:checked').map(function() {
                return this.id.replace('bengkak', '');
            }).get(),
            kuman: $('input[id^="kuman"]:checked').map(function() {
                return this.id.replace('kuman', '');
            }).get(),
            ada: $('input[id^="ada"]:checked').map(function() {
                return this.id.replace('ada', '');
            }).get(),
            diagnosa: $('input[id^="diagnosa"]:checked').map(function() {
                return this.id.replace('diagnosa', '');
            }).get(),

            // 3. Petugas Dinamis petugas1 s/d petugas31
            ...Object.fromEntries(Array.from({
                length: 31
            }, (_, i) => [`petugas${i+1}`, $(`#petugas${i+1}`).val() || ''])),

            // 4. Input Text Keterangan Flat (Kolom Kanan)
            ketRawatLuka: $('#ketRawatLuka').val() || '',
            ketTransparan: $('#ketTransparan').val() || '',
            ketThypafix: $('#ketThypafix').val() || '',
            ketDrain: $('#ketDrain').val() || '',
            ketAff: $('#ketAff').val() || '',
            ketAngkat: $('#ketAngkat').val() || '',
            ketAntibiotik: $('#ketAntibiotik').val() || '',
            ketKrs: $('#ketKrs').val() || '',
            ketKontrol: $('#ketKontrol').val() || '',
            ketMrs: $('#ketMrs').val() || '',
            ketNyeri: $('#ketNyeri').val() || '',
            ketDemam: $('#ketDemam').val() || '',
            ketKemerahan: $('#ketKemerahan').val() || '',
            ketDrainase: $('#ketDrainase').val() || '',
            ketBengkak: $('#ketBengkak').val() || '',
            ketKuman: $('#ketKuman').val() || '',
            ketAda: $('#ketAda').val() || '',
            ketDiagnosa: $('#ketDiagnosa').val() || '',

            // 5. Radio Tambahan di bawah tabel
            buangCairan: $('input[name="buangCairan"]:checked').val() || '',
            affDrain: $('input[name="affDrain"]:checked').val() || '',
            jenisLokasi: $('input[name="jenisLokasi"]:checked').val() || '',
            lokasiSpesifik: $('input[name="lokasiSpesifik"]:checked').val() || '',
            isiLokasiSpesifikLainnya: $('#isiLokasiSpesifikLainnya').val() || '',

        };

        $.ajax({
            url: '<?= base_url("rm/lukaOperasi/simpan") ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });

    }


    <?php if ($data->lukaOperasi) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->lukaOperasi['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/lukaOperasi/hapus',
                method: 'post',
                data: "noRawat=" + noRawat,
                dataType: 'json',
                success: function(data) {
                    location.href = "<?= base_url('rm/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
                }
            });
        }

        $(document).ready(function() {
            if (window.location.hash === '#modalHapus') {
                tryHapus();
            }
        });

    <?php endif; ?>
</script>
<?php $this->endSection() ?>
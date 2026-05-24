<form>
    <div class="row">
        <div class="col-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>
                <input type="hidden" id="noRmTambahPersRajal">
                <input type="hidden" id="namaPasien">
                <input type="hidden" id="alamatPasien">
                <input type="hidden" id="noTelpPasien">
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-6"><input type="text" class="form-control" id="namaWali" placeholder="Nama"></div>
                    <div class="col-6"><input type="text" maxlength="13" class="form-control" id="noTelp" placeholder="Nomor HP"></div>
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col-8">
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat">
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
                            <option value="Suami">Suami</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Ayah">Ayah</option>
                            <option value="Ibu">Ibu</option>
                            <option value="Wali">Wali</option>
                            <option value="Saya sendiri">Diri saya sendiri</option>
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
                    <div class="col-12 text-center">Petugas dan saksi :</div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="petugas" class="form-label">Petugas :</label>
                            <input type="text" class="form-control" id="petugas" value="<?= session()->get('nama') ?>" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="saksi" class="form-label">Saksi :</label>
                            <input type="text" class="form-control" id="saksi" placeholder="Nama saksi">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-6">

            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Pelepasan Informasi Medis :</div>
                    <hr>
                </div>
                <div class="mb-4">
                    <small>Setuju untuk melepaskan rahasia kedokteran terkait dengan kondisi kesehatan, tindakan, dan pengobatan saya di
                        Rumah Sakit Ibu dan Anak Aisyiyah kepada :
                        <ol type="a">
                            <li>
                                Dokter dan tenaga kesehatan lain yang memberikan perawatan dan pengobatan kepada saya;
                            </li>
                            <li>
                                Perusahaan Asuransi Kesehatan atau perusahaan lainnya yang menjamin pembiayaan saya.
                            </li>
                            <li>
                                Lembaga pemerintah lain yang berwenang.
                            </li>
                            <li>
                                Anggota keluarga saya, sebutkan : <br>
                                <sub class="alert alert-warning m-1 p-0"><b>Petunjuk : </b><i>dipisah koma (,) apabila lebih dari 1.</i></sub>
                            </li>
                        </ol>
                    </small>
                    <textarea type="text" class="form-control" id="namaKeluarga" placeholder="Ketik nama keluarga. dipisah koma apabila lebih dari satu nama."></textarea>
                </div>
                <div class="mb-3">
                    <label for="pembayaran" class="form-label">Pembayaran :</label>
                    <select id="pembayaran" class="form-select">
                        <option value="Pasien Umum">Pasien Umum</option>
                        <option value="Pasien BPJS Kesehatan">Pasien BPJS Kesehatan</option>
                        <option value="Pasien Asuransi Lain">Pasien Asuransi Lain</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>
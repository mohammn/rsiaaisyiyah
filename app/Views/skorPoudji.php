<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Surat-surat</h1>
    <div class="card mb-4">
        <div class="card-header">
            <button class="btn btn-info" onclick="tryTambah()">Tambah Pasien</button>
            <i class="fas fa-table me-1"></i>
            Skor Poedji Rochjati
        </div>
        <div class="card-body">
            <table class="table table-striped" id="tabelPasien">
                <thead>
                    <tr>
                        <th>No. RM</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="tabelDataPasien">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal tambah Pasien-->
<div class="modal fade modal-xl" id="modalTambahPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Skor Poedji Rochjati</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <b class="h6"> Petunjuk : </b> Cari pasien yang akan ditambahkan surat <b>Skor Poedji Rochjati</b>, lalua klik tombol <i class="fas fa-plus"></i> di ujung kiri.
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="tabelTambahPasien">
                        <thead>
                            <tr>
                                <th>No. RM</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tgl Lahir</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="tabelDataTambahPasien">
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" onclick="tambah()" class="btn btn-primary" id="tombolTambah">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal skor poeddji -->
<div class="modal fade  modal-lg modal-dialog-scrollable" id="modalSkorPoedji" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">SKOR POEDJI ROCHJATI</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <input type="hidden" id="noRm">
                <table class="table table-bordered table-striped table-hover text-center">
                    <tr>
                        <th rowspan="3" class="table-primary" style="vertical-align: middle;">Kel. F.R.</th>
                        <th rowspan="3" class="table-primary" style="vertical-align: middle;">No.</th>
                        <th rowspan="2" class="table-primary" style="vertical-align: middle;">Masalah / Faktor Resiko</th>
                        <th rowspan="2" class="table-primary" style="vertical-align: middle;">Skor</th>
                        <th colspan="4" class="table-primary">Triwulan</th>
                    </tr>
                    <tr>
                        <th class="table-primary">I</th>
                        <th class="table-primary">II</th>
                        <th class="table-primary">III<sub>1</sub></th>
                        <th class="table-primary">III<sub>2</sub></th>
                    </tr>
                    <tr>
                        <th class="table-success" style="vertical-align: middle;">Skor Awal Kehamilan</th>
                        <td>2</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i0' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii0' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii0' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii0' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="13" class="table-danger" style="vertical-align: middle;">I</td>
                        <td class="table-danger">1.</td>
                        <td class="text-start table-danger">Terlalu Muda, hamil &le; 16 Tahun</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i1' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii1' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii1' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii1' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="table-danger" style="vertical-align: middle;">2.</td>
                        <td class="text-start table-danger">a. Terlalu lambat hami I, kawin &ge; 4 tahun</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i2' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii2' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii2' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii2' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start table-danger">b. Terlalu Tua, hamil &ge; 35 Tahun</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i3' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii3' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii3' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii3' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-danger">3.</td>
                        <td class="text-start table-danger">Terlalu cepat hamil lagi (&lt;2th)</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i4' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii4' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii4' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii4' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-danger">4.</td>
                        <td class="text-start table-danger">Terlalu lama hamil lagi (&ge;10th)</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i5' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii5' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii5' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii5' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-danger">5.</td>
                        <td class="text-start table-danger">Terlalu banyak anak, 4/lebih</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i6' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii6' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii6' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii6' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-danger">6.</td>
                        <td class="text-start table-danger">Terlalu tua, umur &ge; 35 th</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i7' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii7' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii7' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii7' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-danger">7.</td>
                        <td class="text-start table-danger">Teralalu pendek &le; 145 cm</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i8' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii8' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii8' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii8' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-danger">8.</td>
                        <td class="text-start table-danger">Pernah gagal kehamilan</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i9' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii9' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii9' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii9' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="table-danger" style="vertical-align: middle;">9.</td>
                        <td class="text-start table-danger">Pernah melahirkan dengan : a. tarikan/ vacum</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i10' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii10' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii10' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii10' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start table-danger">b. Plasenta manual</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i11' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii11' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii11' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii11' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start table-danger">c. Diberi infus/transfusi</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i12' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii12' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii12' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii12' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">10.</td>
                        <td class="text-start bg-danger text-light">Pernah operasi sesar</td>
                        <td>8</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i13' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii13' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii13' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii13' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="9" class="table-warning" style="vertical-align: middle;">II</td>
                        <td rowspan="6" class="table-warning" style="vertical-align: middle;">11.</td>
                        <td class="text-start table-warning">Penyakit pada ibu hamil : a. kurang darah</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i14' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii14' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii14' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii14' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">b. TBC Paru</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i15' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii15' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii15' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii15' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">c. Kencing Manis (DM)</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i16' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii16' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii16' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii16' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">d. Penyakit Menular Seksual</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i17' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii17' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii17' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii17' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">e. Malaria</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i18' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii18' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii18' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii18' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">f. Payah jantung</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i19' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii19' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii19' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii19' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-warning">12.</td>
                        <td class="text-start table-warning">Bengkak pada muka/tungkai dan hipertensi</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i20' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii20' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii20' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii20' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-warning">13.</td>
                        <td class="text-start table-warning">Hamil kembar 2 atau lebih</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i21' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii21' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii21' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii21' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-warning">14.</td>
                        <td class="text-start table-warning">Hamil kembar air (hydramnion)</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i22' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii22' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii22' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii22' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="6" class="bg-danger text-light" style="vertical-align: middle;">III</td>
                        <td class="bg-danger text-light">15.</td>
                        <td class="text-start bg-danger text-light">Bayi mati dalam kandungan</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i23' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii23' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii23' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii23' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">16.</td>
                        <td class="text-start bg-danger text-light">Kehamilan lebih bulan</td>
                        <td>4</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i24' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii24' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii24' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii24' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">17.</td>
                        <td class="text-start bg-danger text-light">Letang sungsang</td>
                        <td>8</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i25' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii25' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii25' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii25' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">18.</td>
                        <td class="text-start bg-danger text-light">Letak lintang</td>
                        <td>8</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i26' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii26' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii26' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii26' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">19.</td>
                        <td class="text-start bg-danger text-light">Pendarahan dalam kehamilan</td>
                        <td>8</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i27' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii27' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii27' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii27' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">20.</td>
                        <td class="text-start bg-danger text-light">Preeklampsia berat/kejang-kejang</td>
                        <td>8</td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='i28' onchange="hitungSkori()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='ii28' onchange="hitungSkorii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iii28' onchange="hitungSkoriii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select form-select-sm border-0" id='iiii28' onchange="hitungSkoriiii()">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">Jumlah Skor</td>
                        <td id="totali"></td>
                        <td id="totalii"></td>
                        <td id="totaliii"></td>
                        <td id="totaliiii"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="ubahSkor()">Perbarui</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal lihat skorpoedji -->
<div class="modal fade modal-lg" id="modalLihatSkor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Lihat Skor Poedji Rochjati</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <input type="hidden" id="noRm">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4 id="namaPasienSkor"></h4>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover text-center">
                    <tr>
                        <th rowspan="3" class="table-primary" style="vertical-align: middle;">Kel. F.R.</th>
                        <th rowspan="3" class="table-primary" style="vertical-align: middle;">No.</th>
                        <th rowspan="2" class="table-primary" style="vertical-align: middle;">Masalah / Faktor Resiko</th>
                        <th rowspan="2" class="table-primary" style="vertical-align: middle;">Skor</th>
                        <th colspan="4" class="table-primary">Triwulan</th>
                    </tr>
                    <tr>
                        <th class="table-primary">I</th>
                        <th class="table-primary">II</th>
                        <th class="table-primary">III<sub>1</sub></th>
                        <th class="table-primary">III<sub>2</sub></th>
                    </tr>
                    <tr>
                        <th class="table-success" style="vertical-align: middle;">Skor Awal Kehamilan</th>
                        <td>2</td>
                        <td id="li0"></td>
                        <td id="lii0"></td>
                        <td id="liii0"></td>
                        <td id="liiii0"></td>
                    </tr>
                    <tr>
                        <td rowspan="13" class="table-danger" style="vertical-align: middle;">I</td>
                        <td class="table-danger">1.</td>
                        <td class="text-start table-danger">Terlalu Muda, hamil &le; 16 Tahun</td>
                        <td>4</td>
                        <td id="li1"></td>
                        <td id="lii1"></td>
                        <td id="liii1"></td>
                        <td id="liiii1"></td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="table-danger" style="vertical-align: middle;">2.</td>
                        <td class="text-start table-danger">a. Terlalu lambat hami I, kawin &ge; 4 tahun</td>
                        <td>4</td>
                        <td id="li2"></td>
                        <td id="lii2"></td>
                        <td id="liii2"></td>
                        <td id="liiii2"></td>
                    </tr>
                    <tr>
                        <td class="text-start table-danger">b. Terlalu Tua, hamil &ge; 35 Tahun</td>
                        <td>4</td>
                        <td id="li3"></td>
                        <td id="lii3"></td>
                        <td id="liii3"></td>
                        <td id="liiii3"></td>
                    </tr>
                    <tr>
                        <td class="table-danger">3.</td>
                        <td class="text-start table-danger">Terlalu cepat hamil lagi (&lt;2th)</td>
                        <td>4</td>
                        <td id="li4"></td>
                        <td id="lii4"></td>
                        <td id="liii4"></td>
                        <td id="liiii4"></td>
                    </tr>
                    <tr>
                        <td class="table-danger">4.</td>
                        <td class="text-start table-danger">Terlalu lama hamil lagi (&ge;10th)</td>
                        <td>4</td>
                        <td id="li5"></td>
                        <td id="lii5"></td>
                        <td id="liii5"></td>
                        <td id="liiii5"></td>
                    </tr>
                    <tr>
                        <td class="table-danger">5.</td>
                        <td class="text-start table-danger">Terlalu banyak anak, 4/lebih</td>
                        <td>4</td>
                        <td id="li6"></td>
                        <td id="lii6"></td>
                        <td id="liii6"></td>
                        <td id="liiii6"></td>
                    </tr>
                    <tr>
                        <td class="table-danger">6.</td>
                        <td class="text-start table-danger">Terlalu tua, umur &ge; 35 th</td>
                        <td>4</td>
                        <td id="li7"></td>
                        <td id="lii7"></td>
                        <td id="liii7"></td>
                        <td id="liiii7"></td>
                    </tr>
                    <tr>
                        <td class="table-danger">7.</td>
                        <td class="text-start table-danger">Teralalu pendek &le; 145 cm</td>
                        <td>4</td>
                        <td id="li8"></td>
                        <td id="lii8"></td>
                        <td id="liii8"></td>
                        <td id="liiii8"></td>
                    </tr>
                    <tr>
                        <td class="table-danger">8.</td>
                        <td class="text-start table-danger">Pernah gagal kehamilan</td>
                        <td>4</td>
                        <td id="li9"></td>
                        <td id="lii9"></td>
                        <td id="liii9"></td>
                        <td id="liiii9"></td>
                    </tr>
                    <tr>
                        <td rowspan="3" class="table-danger" style="vertical-align: middle;">9.</td>
                        <td class="text-start table-danger">Pernah melahirkan dengan : a. tarikan/ vacum</td>
                        <td>4</td>
                        <td id="li10"></td>
                        <td id="lii10"></td>
                        <td id="liii10"></td>
                        <td id="liiii10"></td>
                    </tr>
                    <tr>
                        <td class="text-start table-danger">b. Plasenta manual</td>
                        <td>4</td>
                        <td id="li11"></td>
                        <td id="lii11"></td>
                        <td id="liii11"></td>
                        <td id="liiii11"></td>
                    </tr>
                    <tr>
                        <td class="text-start table-danger">c. Diberi infus/transfusi</td>
                        <td>4</td>
                        <td id="li12"></td>
                        <td id="lii12"></td>
                        <td id="liii12"></td>
                        <td id="liiii12"></td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">10.</td>
                        <td class="text-start bg-danger text-light">Pernah operasi sesar</td>
                        <td>8</td>
                        <td id="li13"></td>
                        <td id="lii13"></td>
                        <td id="liii13"></td>
                        <td id="liiii13"></td>
                    </tr>
                    <tr>
                        <td rowspan="9" class="table-warning" style="vertical-align: middle;">II</td>
                        <td rowspan="6" class="table-warning" style="vertical-align: middle;">11.</td>
                        <td class="text-start table-warning">Penyakit pada ibu hamil : a. kurang darah</td>
                        <td>4</td>
                        <td id="li14"></td>
                        <td id="lii14"></td>
                        <td id="liii14"></td>
                        <td id="liiii14"></td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">b. TBC Paru</td>
                        <td>4</td>
                        <td id="li15"></td>
                        <td id="lii15"></td>
                        <td id="liii15"></td>
                        <td id="liiii15"></td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">c. Kencing Manis (DM)</td>
                        <td>4</td>
                        <td id="li16"></td>
                        <td id="lii16"></td>
                        <td id="liii16"></td>
                        <td id="liiii16"></td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">d. Penyakit Menular Seksual</td>
                        <td>4</td>
                        <td id="li17"></td>
                        <td id="lii17"></td>
                        <td id="liii17"></td>
                        <td id="liiii17"></td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">e. Malaria</td>
                        <td>4</td>
                        <td id="li18"></td>
                        <td id="lii18"></td>
                        <td id="liii18"></td>
                        <td id="liiii18"></td>
                    </tr>
                    <tr>
                        <td class="text-start table-warning">f. Payah jantung</td>
                        <td>4</td>
                        <td id="li19"></td>
                        <td id="lii19"></td>
                        <td id="liii19"></td>
                        <td id="liiii19"></td>
                    </tr>
                    <tr>
                        <td class="table-warning">12.</td>
                        <td class="text-start table-warning">Bengkak pada muka/tungkai dan hipertensi</td>
                        <td>4</td>
                        <td id="li20"></td>
                        <td id="lii20"></td>
                        <td id="liii20"></td>
                        <td id="liiii20"></td>
                    </tr>
                    <tr>
                        <td class="table-warning">13.</td>
                        <td class="text-start table-warning">Hamil kembar 2 atau lebih</td>
                        <td>4</td>
                        <td id="li21"></td>
                        <td id="lii21"></td>
                        <td id="liii21"></td>
                        <td id="liiii21"></td>
                    </tr>
                    <tr>
                        <td class="table-warning">14.</td>
                        <td class="text-start table-warning">Hamil kembar air (hydramnion)</td>
                        <td>4</td>
                        <td id="li22"></td>
                        <td id="lii22"></td>
                        <td id="liii22"></td>
                        <td id="liiii22"></td>
                    </tr>
                    <tr>
                        <td rowspan="6" class="bg-danger text-light" style="vertical-align: middle;">III</td>
                        <td class="bg-danger text-light">15.</td>
                        <td class="text-start bg-danger text-light">Bayi mati dalam kandungan</td>
                        <td>4</td>
                        <td id="li23"></td>
                        <td id="lii23"></td>
                        <td id="liii23"></td>
                        <td id="liiii23"></td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">16.</td>
                        <td class="text-start bg-danger text-light">Kehamilan lebih bulan</td>
                        <td>4</td>
                        <td id="li24"></td>
                        <td id="lii24"></td>
                        <td id="liii24"></td>
                        <td id="liiii24"></td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">17.</td>
                        <td class="text-start bg-danger text-light">Letang sungsang</td>
                        <td>8</td>
                        <td id="li25"></td>
                        <td id="lii25"></td>
                        <td id="liii25"></td>
                        <td id="liiii25"></td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">18.</td>
                        <td class="text-start bg-danger text-light">Letak lintang</td>
                        <td>8</td>
                        <td id="li26"></td>
                        <td id="lii26"></td>
                        <td id="liii26"></td>
                        <td id="liiii26"></td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">19.</td>
                        <td class="text-start bg-danger text-light">Pendarahan dalam kehamilan</td>
                        <td>8</td>
                        <td id="li27"></td>
                        <td id="lii27"></td>
                        <td id="liii27"></td>
                        <td id="liiii27"></td>
                    </tr>
                    <tr>
                        <td class="bg-danger text-light">20.</td>
                        <td class="text-start bg-danger text-light">Preeklampsia berat/kejang-kejang</td>
                        <td>8</td>
                        <td id="li28"></td>
                        <td id="lii28"></td>
                        <td id="liii28"></td>
                        <td id="liiii28"></td>
                    </tr>
                    <tr>
                        <td colspan="4">Jumlah Skor</td>
                        <td id="totalil"></td>
                        <td id="totaliil"></td>
                        <td id="totaliiil"></td>
                        <td id="totaliiiil"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tutup</button>
                <a href="" target="_blank" class="btn btn-warning" id="tombolPrint">Print</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal hapus pasien -->
<div class="modal fade" id="modalHapusPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Pasien berikut ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="noRmHapus">
                Apakah anda yakin ingin menghapus <b>Skor Poedji Raochjati</b> pasien dengan nama <b id="namaPasienHapus"></b> ?<br>
                Data tidak dapat dikembalikan !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" onclick="hapusPasien()">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    muatData()

    function muatData() {
        $.ajax({
            url: '<?= base_url() ?>skorPoudji/muatdatapasien',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data)
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr>" +
                        "<td>" + data[i].noRm + "</td>" +
                        "<td>" + data[i].no_ktp + "</td>" +
                        "<td>" + data[i].nm_pasien + "</td>" +
                        "<td>" + data[i].tgl_lahir + "</td>" +
                        "<td>" + data[i].alamat + "</td>" +
                        "<td>" + data[i].jk + "</td>" +
                        "<td>" + '<button class="btn btn-info btn-sm" onclick="lihatSkor(\'' + data[i].noRm + '\',\'' + data[i].nm_pasien + '\')"><i class="fas fa-eye"></i></button> ' +
                        ' <button class="btn btn-primary btn-sm" onclick="trySkor(\'' + data[i].noRm + '\')"><i class="fa fa-pencil"></i></button> ' +
                        ' <button class="btn btn-secondary btn-sm"><i class="fas fa-trash"  onclick="tryHapus(\'' + data[i].noRm + '\',\'' + data[i].nm_pasien + '\')"></i></button> ' +
                        "</td></tr>"
                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="6">Data Masih kosong :)</td>'
                }

                $("#tabelDataPasien").html(tabel)
                $("#tabelPasien").DataTable()

            }
        });
    }

    function muatTambahPasien() {
        $.ajax({
            url: '<?= base_url() ?>skorPoudji/muattambahpasien',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr>" +
                        "<td>" + data[i].no_rkm_medis + "</td>" +
                        "<td>" + data[i].no_ktp + "</td>" +
                        "<td>" + data[i].nm_pasien + "</td>" +
                        "<td>" + data[i].tgl_lahir + "</td>" +
                        "<td>" + data[i].alamat + "</td>" +
                        "<td>" + data[i].jk + "</td>" +
                        "<td>" + '<button class="btn btn-info btn-sm" onclick="tambah(\'' + data[i].no_rkm_medis + '\')"><i class="fas fa-plus"></i></button> ' +
                        "</td></tr>"
                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="6">Data Masih kosong :)</td>'
                }

                $("#tabelDataTambahPasien").html(tabel)
                $("#tabelTambahPasien").DataTable()

            }
        });
    }

    function tryTambah() {
        muatTambahPasien()
        $("#modalTambahPasien").modal("show");
    }

    function tambah(noRm) {
        $.ajax({
            url: '<?= base_url() ?>skorPoudji/tambahpasien',
            method: 'post',
            data: "noRm=" + noRm,
            dataType: 'json',
            success: function(data) {
                muatData()

                $("#modalTambahPasien").modal("hide");
            }
        });
    }

    function tryHapus(noRm, nama) {
        $("#modalHapusPasien").modal("show");
        $("#namaPasienHapus").html(nama)
        $("#noRmHapus").val(noRm)
    }

    function hapusPasien() {
        var noRm = $("#noRmHapus").val()

        $.ajax({
            url: '<?= base_url() ?>skorPoudji/hapuspasien',
            method: 'post',
            data: "noRm=" + noRm,
            dataType: 'json',
            success: function(data) {
                $("#noRmHapus").val("")
                $("#modalHapusPasien").modal("hide");
                muatData()
            }
        });
    }

    function trySkor(noRm) {
        $("#modalSkorPoedji").modal("show");
        $.ajax({
            url: '<?= base_url() ?>skorPoudji/muatskor',
            method: 'post',
            data: "noRm=" + noRm,
            dataType: 'json',
            success: function(data) {
                $("#noRm").val(noRm)
                datai = data[0].i.split("a")
                for (let i = 0; i < datai.length; i++) {
                    $("#i" + i).val(datai[i])
                }

                dataii = data[0].ii.split("a")
                for (let i = 0; i < dataii.length; i++) {
                    $("#ii" + i).val(dataii[i])
                }

                dataiii = data[0].iii.split("a")
                for (let i = 0; i < dataiii.length; i++) {
                    $("#iii" + i).val(dataiii[i])
                }

                dataiiii = data[0].iiii.split("a")
                for (let i = 0; i < dataiiii.length; i++) {
                    $("#iiii" + i).val(dataiiii[i])
                }

                hitungSkori()
                hitungSkorii()
                hitungSkoriii()
                hitungSkoriiii()
            }
        });
    }

    function ubahSkor() {
        datai = ''
        for (let i = 0; i < 29; i++) {
            datai += $("#i" + i).val()
            if (i < 28) {
                datai += 'a'
            }
        }

        dataii = ''
        for (let i = 0; i < 29; i++) {
            dataii += $("#ii" + i).val()
            if (i < 28) {
                dataii += 'a'
            }
        }

        dataiii = ''
        for (let i = 0; i < 29; i++) {
            dataiii += $("#iii" + i).val()
            if (i < 28) {
                dataiii += 'a'
            }
        }

        dataiiii = ''
        for (let i = 0; i < 29; i++) {
            dataiiii += $("#iiii" + i).val()
            if (i < 28) {
                dataiiii += 'a'
            }
        }

        $.ajax({
            url: '<?= base_url() ?>skorPoudji/ubahskor',
            method: 'post',
            data: "noRm=" + $("#noRm").val() + '&i=' + datai + '&ii=' + dataii + '&iii=' + dataiii + '&iiii=' + dataiiii,
            dataType: 'json',
            success: function(data) {
                $("#modalSkorPoedji").modal("hide");
            }
        });

    }

    function lihatSkor(noRm, namaPasien) {
        $("#namaPasienSkor").html(namaPasien);
        $("#modalLihatSkor").modal("show");
        $("#tombolPrint").attr("href", "skorPoudji/printskor/" + noRm);
        $.ajax({
            url: '<?= base_url() ?>skorPoudji/muatskor',
            method: 'post',
            data: "noRm=" + noRm,
            dataType: 'json',
            success: function(data) {
                $("#noRm").val(noRm)
                datai = data[0].i.split("a")
                for (let i = 0; i < datai.length; i++) {
                    $("#li" + i).html(datai[i])
                }

                dataii = data[0].ii.split("a")
                for (let i = 0; i < dataii.length; i++) {
                    $("#lii" + i).html(dataii[i])
                }

                dataiii = data[0].iii.split("a")
                for (let i = 0; i < dataiii.length; i++) {
                    $("#liii" + i).html(dataiii[i])
                }

                dataiiii = data[0].iiii.split("a")
                for (let i = 0; i < dataiiii.length; i++) {
                    $("#liiii" + i).html(dataiiii[i])
                }

                hitungSkori('l')
                hitungSkorii('l')
                hitungSkoriii('l')
                hitungSkoriiii('l')
            }
        });
    }

    function hitungSkori(target = '') {
        total = 0
        if (target) {
            for (let i = 0; i < 29; i++) {
                total += parseInt($("#li" + i).html(), 10)
            }
        } else {
            for (let i = 0; i < 29; i++) {
                total += parseInt($("#i" + i).val(), 10)
            }
        }

        $("#totali" + target).html(total)
    }

    function hitungSkorii(target = '') {
        total = 0
        if (target) {
            for (let i = 0; i < 29; i++) {
                total += parseInt($("#lii" + i).html(), 10)
            }
        } else {
            for (let i = 0; i < 29; i++) {
                total += parseInt($("#ii" + i).val(), 10)
            }
        }
        $("#totalii" + target).html(total)
    }

    function hitungSkoriii(target = '') {
        total = 0
        if (target) {
            for (let i = 0; i < 29; i++) {
                total += parseInt($("#liii" + i).html(), 10)
            }
        } else {
            for (let i = 0; i < 29; i++) {
                total += parseInt($("#iii" + i).val(), 10)
            }
        }
        $("#totaliii" + target).html(total)
    }

    function hitungSkoriiii(target = '') {
        total = 0
        if (target) {
            for (let i = 0; i < 29; i++) {
                total += parseInt($("#liiii" + i).html(), 10)
            }
        } else {
            for (let i = 0; i < 29; i++) {
                total += parseInt($("#iiii" + i).val(), 10)
            }
        }
        $("#totaliiii" + target).html(total)
    }
</script>
<?php $this->endSection() ?>
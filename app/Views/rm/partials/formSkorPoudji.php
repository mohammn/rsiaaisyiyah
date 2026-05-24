<table class="table table-bordered table-striped table-hover text-center table-responsive">
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
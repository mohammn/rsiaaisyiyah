    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css">

    <input type="hidden" id="idPasien" value="<?= $id ?>">

    <style>
        @media print {
            .table-striped tbody tr:nth-child(even) td {
                -webkit-print-color-adjust: exact;
            }

            /* Add similar rules for other colored table classes if needed */
            .table-primary td,
            .table-primary th {
                -webkit-print-color-adjust: exact;
            }
        }

        .tabel td,
        .tabel th {
            padding: 1;
        }
    </style>

    <div class="row pt-4 m-1">
        <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="120%" alt=""></div>
        <div class="col-3">
            <br><br>
        </div>
        <div class="col-5 border border-dark">
            <table class="table table-borderless tabel table-sm mt-2">
                <tr>
                    <td>Nama</td>
                    <td>: <?= $nama ?></td>
                </tr>
                <tr>
                    <td>Tgl.Lahir</td>
                    <td>: <?= $tanggalLahir ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?= $alamat ?></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: <?= $nik ?></td>
                </tr>
                <tr>
                    <td>No.RM</td>
                    <td>: <?= $noRm ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mb-3">
            <h3>SKOR POEDJI ROCHJATI</h1>
        </div>
    </div>
    <table class="table table-bordered table-striped text-center">
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
            <td class="text-start table-danger">Pernah melahirkan dengan : <br> a. Tarikan/ vacum</td>
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
            <td class="text-start table-warning">Penyakit pada ibu hamil : <br> a. Kurang darah</td>
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

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        function lihatSkor() {
            idPasien = $("#idPasien").val()
            $.ajax({
                url: '<?= base_url() ?>skorPoudji/lihatskor',
                method: 'post',
                data: "idPasien=" + idPasien,
                dataType: 'json',
                success: function(data) {
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

            window.print();
        }

        lihatSkor()
    </script>
<?php

namespace App\Models;

use CodeIgniter\Model;

class Rm7bPengkajianModel extends Model
{
    protected $table         = 'rm7b_pengkajian';
    protected $primaryKey    = 'id';

    protected $allowedFields = [
        // Data Utama & Rawat
        'noRawat',
        'tgl',
        'sumberData',
        'sumberDataLainnya',
        'rujukan',
        'asalRujukan',
        'pengantarRujukan',
        'nama',
        'alamat',
        'noHp',
        'transportasiWaktuDatang',
        'transportasiLainnya',

        // Riwayat Kebidanan & Menstruasi
        'keluhanUtama',
        'riwayatKeluhan',
        'hpht',
        'hpl',
        'riwayatPerkawinan',
        'jumlahKawin',
        'lamaKawin',
        'riwayatKbTerakhir',
        'jenisKbTerakhir',

        // Gynekologi & Alergi
        'riwayatGynekologi',
        'jenisGynekologi', // Saved as JSON
        'jenisGynekologiLainnya',
        'riwayatAlergi',   // Saved as JSON
        'jenisNamaObat',
        'reaksiObat',
        'jenisMakanan',
        'reaksiMakanan',
        'jenisAlergiLainnya',
        'reaksiLainnya',

        // Psikologis, Ekonomi & Spiritual
        'keadaanPsikologis', // Saved as JSON
        'keadaanPsikologisLainnya',
        'tingkatPendidikan',
        'tingkatPendidikanLainnya',
        'pekerjaan',
        'pekerjaanLainnya',
        'tinggalBersama',    // Saved as JSON
        'tinggalBersamaLainnya',
        'statusEkonomi',
        'namaAsuransi',
        'menjalankanIbadah',
        'persepsiSakit',
        'pelayananSpiritual',

        // Pengkajian Nyeri & MST (Gizi)
        'skalaNyeri',
        'jamNyeri',
        'penurunanBb',
        'asupanMakan',
        'skorStatus',
        'diagnosaKhusus', // Saved as JSON
        'penyakitKronisLainnya',
        'keluhanLain',    // Saved as JSON
        'jenisDiet',
        'keluhanLainnyaInput',

        // Eliminasi (BAK & BAB)
        'bakFrekuensi',
        'bakVolume',
        'bakWarna',
        'bakKeluhan',
        'babFrekuensi',
        'babKonsistensi',
        'babWarna',
        'babKeluhan',

        // Aktivitas & Istirahat
        'tidurIstirahat',
        'tidurIstirahatKet',
        'aktivitasLatihan',
        'alatBantu',
        'alatBantuKet',

        // Resiko Jatuh (Morse Scale)
        'riwayatJatuh',
        'diagnosaSkunder',
        'alatBantu2', // Distinct from Aktivitas Alat Bantu
        'menggunakanInfus',
        'gayaBerjalan',
        'statusMental',
        'skorJatuh',
        'statusJatuh',
        'intervensi', // Saved as JSON

        // Pemeriksaan Umum & Tanda Vital
        'keadaanUmum',
        'kesadaran',
        'td',
        'rr',
        'rrTeratur',
        'nadi',
        'suhuAksila',
        'suhuRectal',

        // Pemeriksaan Fisik (Abdomen)
        'bekasOperasi',
        'lineaNigra',
        'lineaAlba',
        'adaPembesaran',
        'tfu',
        'involusiUteri',
        'kontraksiUteri',
        'hisFrekuensi',
        'hisLama',
        'kelainanPalpasi',
        'terabaMassa',
        'massaPanjang',
        'massaLebar',
        'bisingUsus',
        'djjFrekuensi',
        'djjTeratur',

        // Anogenital & Inspekulo
        'pengeluaranVaginal',
        'lochea',
        'volume',
        'berbau',
        'berbauKet',
        'perinium', // Saved as JSON
        'laserasiDerajat',
        'periniumLainnyaKet',
        'jahitan',  // Saved as JSON
        'kelainan', // Saved as JSON
        'kelainanLainnyaKet',
        'portio',
        'portioLainnyaKet',
        'cavumDouglasi',
        'dokter',
        'waktuVt',

        // Penunjang & Diagnosa Akhir
        'hb',
        'golonganDarah',
        'rhesus',
        'toxo',
        'hbsag',
        'hiv',
        'albumin',
        'reduksi',
        'usg',
        'pemeriksaanLainnya',
        'diagnosaKebidanan',
        'rencanaTindakLanjut',

        'petugas',
        'ttdPetugas',
        'tglinput'
    ];
}

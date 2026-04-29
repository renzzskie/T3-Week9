<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas 3C - Tabel Nilai Mahasiswa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container-large">
        <h2>📊 Rekapan Nilai Mahasiswa Kelas A Prodi Sastra Mesin</h2>
        
        <?php

        class Mahasiswa {
            public $nama, $nim, $uts, $uas;

            public function __construct($nama, $nim, $uts, $uas) {
                $this->nama = $nama;
                $this->nim = $nim;
                $this->uts = $uts;
                $this->uas = $uas;
            }

            public function hitungNA() {
                return ($this->uts * 0.4) + ($this->uas * 0.6);
            }

            public function tentukanGrade() {
                $na = $this->hitungNA();
                if ($na >= 95) return 'A+';
                if ($na >= 85) return 'A';
                if ($na >= 80) return 'B+';
                if ($na >= 75) return 'B';
                if ($na >= 70) return 'C+';
                if ($na >= 65) return 'C';
                if ($na >= 60) return 'D+';
                if ($na >= 55) return 'D';
                return 'E';
            }
        }

        $data_mahasiswa = [
            new Mahasiswa("Ahmad Rizky", "A123009", 96, 95),
            new Mahasiswa("Akbar Ramadhan", "A123010", 97, 97),
            new Mahasiswa("Alif Baba", "A123008", 30, 25), 
            new Mahasiswa("Andreana Selamat Sentosa", "A123003", 99, 98), 
            new Mahasiswa("Awaludin Siregar", "A123006", 55, 65), 
            new Mahasiswa("Bambang Sugeng", "A123011", 88, 85),
            new Mahasiswa("Budi Santoso", "A123012", 84, 87),
            new Mahasiswa("Citra Kirana", "A123013", 85, 86),
            new Mahasiswa("Datuk Syam", "A123001", 100, 100),
            new Mahasiswa("Dewi Kartika Lestari", "A123004", 67, 72), 
            new Mahasiswa("Eka Putra", "A123014", 80, 82), 
            new Mahasiswa("Eko Prasetyo", "A123015", 81, 80), 
            new Mahasiswa("Farhan Malik", "A123016", 83, 78), 
            new Mahasiswa("Gita Gutawa", "A123017", 79, 84), 
            new Mahasiswa("Hendra Wijaya", "A123018", 75, 76), 
            new Mahasiswa("Indah Permata", "A123019", 77, 74), 
            new Mahasiswa("Jamaludin Abidin", "A123005", 57, 78), 
            new Mahasiswa("Joko Widodo", "A123020", 74, 78),
            new Mahasiswa("Kurniawan Dwi", "A123021", 76, 75),
            new Mahasiswa("Lina Marlina", "A123022", 70, 71),
            new Mahasiswa("Lusi Rahmawati", "A123023", 72, 69), 
            new Mahasiswa("Maman Abdurrahman", "A123024", 65, 66), 
            new Mahasiswa("Mas Rudi", "A123002", 45.5, 45.4),
            new Mahasiswa("Nanang Kosim", "A123025", 64, 67), 
            new Mahasiswa("Oki Setiana", "A123026", 66, 64), 
            new Mahasiswa("Putri Salju", "A123027", 60, 62),
            new Mahasiswa("Qori Sandioriva", "A123028", 61, 60), 
            new Mahasiswa("Rahmat Hidayat", "A123029", 59, 63), 
            new Mahasiswa("Rizky Pratama", "A123030", 62, 59), 
            new Mahasiswa("Samsul Bahri", "A123031", 55, 56), 
            new Mahasiswa("Tatang Sutarma", "A123032", 56, 54), 
            new Mahasiswa("Ujang Memed", "A123033", 54, 58), 
            new Mahasiswa("Vina Panduwinata", "A123034", 40, 42), 
            new Mahasiswa("Zulkifli Lubis", "A123007", 80, 90)  
        ];

        $total_kelas = 0;
        $jumlah_mhs = count($data_mahasiswa);
        ?>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>UTS (40%)</th>
                    <th>UAS (60%)</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach ($data_mahasiswa as $mhs): 
                    $na = $mhs->hitungNA();
                    $grade = $mhs->tentukanGrade();
                    $total_kelas += $na;
                    $row_class = ($na < 60) ? "danger-row" : "";
                ?>
                <tr class="<?php echo $row_class; ?>">
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($mhs->nim); ?></td>
                    <td style="text-align: left; font-weight: 600;"><?php echo htmlspecialchars($mhs->nama); ?></td>
                    <td><?php echo htmlspecialchars($mhs->uts); ?></td>
                    <td><?php echo htmlspecialchars($mhs->uas); ?></td>
                    <td><strong><?php echo round($na, 2); ?></strong></td>
                    <td><strong><?php echo $grade; ?></strong></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php $rata_rata = $total_kelas / $jumlah_mhs; ?>
        
        <h3 style="text-align: right; margin-top: 10px; font-size: 1.1rem; color: #334155;">
            Rata-rata nilai Kelas R: <span style="color: #6c5ce7;"><?php echo round($rata_rata, 2); ?></span>
        </h3>
    </div>
</body>
</html>
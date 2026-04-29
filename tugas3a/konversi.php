<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas 3A - Konversi Suhu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>🌡️ Kalkulator konversi suhu cepat, kilat dan akurat.</h2>
        
        <?php
        $hasil = "";
        $error = "";
        $is_reset = isset($_GET['action']) && $_GET['action'] == 'reset';

        function hitungSuhu($suhu, $tipe) {
            switch ($tipe) {
                case "C_ke_F": return ($suhu * 9/5) + 32;
                case "F_ke_C": return ($suhu - 32) * 5/9;
                case "C_ke_K": return $suhu + 273.15;
                case "K_ke_C": return $suhu - 273.15;
                case "F_ke_K": return ($suhu - 32) * 5/9 + 273.15;
                case "K_ke_F": return ($suhu - 273.15) * 9/5 + 32;
                default: return 0;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !$is_reset) {
            $input_suhu = trim($_POST['suhu']);
            $tipe_konversi = isset($_POST['tipe_konversi']) ? $_POST['tipe_konversi'] : '';

            $labels = [
                "C_ke_F" => "Celsius ke Fahrenheit",
                "F_ke_C" => "Fahrenheit ke Celsius",
                "C_ke_K" => "Celsius ke Kelvin",
                "K_ke_C" => "Kelvin ke Celsius",
                "F_ke_K" => "Fahrenheit ke Kelvin",
                "K_ke_F" => "Kelvin ke Fahrenheit"
            ];

            if ($input_suhu === "") { 
                $error = "Input suhu tidak boleh kosong!";
            } elseif (!is_numeric($input_suhu)) {
                $error = "Input suhu harus berupa angka dan bukan huruf!";
            } elseif (empty($tipe_konversi)) {
                $error = "Pilih dulu tipe konversi yang Anda inginkan!";
            } else {
                $hasil_hitung = hitungSuhu($input_suhu, $tipe_konversi);
                $nama_konversi = $labels[$tipe_konversi];
                $hasil = "Hasil Konversi <strong>$nama_konversi</strong>: <strong>" . round($hasil_hitung, 2) . "</strong>";
            }
        }
        ?>

        <form method="POST" action="konversi.php">
            <label for="suhu">Masukkan Suhu:</label>
            <input type="text" name="suhu" id="suhu" placeholder="Contoh: 30" 
                   value="<?php echo ($is_reset) ? '' : (isset($_POST['suhu']) ? htmlspecialchars($_POST['suhu']) : ''); ?>"
                   oninput="document.getElementById('hasil_box') ? document.getElementById('hasil_box').style.display='none' : ''">
            
            <label for="tipe_konversi">Pilih Konversi:</label>
            
            <select name="tipe_konversi" id="tipe_konversi" 
                    onchange="document.getElementById('hasil_box') ? document.getElementById('hasil_box').style.display='none' : ''">
                
                <option value="" <?php echo ($is_reset || empty($_POST['tipe_konversi'])) ? 'selected' : ''; ?>>-- Pilih Konversi Suhu --</option>
                <option value="C_ke_F" <?php echo (!$is_reset && isset($_POST['tipe_konversi']) && $_POST['tipe_konversi'] == 'C_ke_F') ? 'selected' : ''; ?>>Celsius ke Fahrenheit</option>
                <option value="F_ke_C" <?php echo (!$is_reset && isset($_POST['tipe_konversi']) && $_POST['tipe_konversi'] == 'F_ke_C') ? 'selected' : ''; ?>>Fahrenheit ke Celsius</option>
                <option value="C_ke_K" <?php echo (!$is_reset && isset($_POST['tipe_konversi']) && $_POST['tipe_konversi'] == 'C_ke_K') ? 'selected' : ''; ?>>Celsius ke Kelvin</option>
                <option value="K_ke_C" <?php echo (!$is_reset && isset($_POST['tipe_konversi']) && $_POST['tipe_konversi'] == 'K_ke_C') ? 'selected' : ''; ?>>Kelvin ke Celsius</option>
                <option value="F_ke_K" <?php echo (!$is_reset && isset($_POST['tipe_konversi']) && $_POST['tipe_konversi'] == 'F_ke_K') ? 'selected' : ''; ?>>Fahrenheit ke Kelvin</option>
                <option value="K_ke_F" <?php echo (!$is_reset && isset($_POST['tipe_konversi']) && $_POST['tipe_konversi'] == 'K_ke_F') ? 'selected' : ''; ?>>Kelvin ke Fahrenheit</option>
            </select>

            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <button type="submit">Konversi Sekarang</button>

            <a href="konversi.php?action=reset" class="btn-reset">
                🔄 Bersihkan Halaman
            </a>
        </form>

        <?php if ($hasil && !$is_reset): ?>
            <div class="success" id="hasil_box"><?php echo $hasil; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
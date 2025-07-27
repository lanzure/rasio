<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Kalkulator Rasio Fiber Optik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column; /* Changed to column to stack main content and footer */
            justify-content: center;
            align-items: center; /* Center horizontally */
            min-height: 90vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            margin-bottom: 20px; /* Add some space before the footer */
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .hint {
            font-size: 0.9em;
            color: #666;
            margin-top: 5px;
            display: block;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
            margin-top: 20px;
            box-sizing: border-box;
        }
        button:hover {
            background-color: #0056b3;
        }
        .bilhanet-calc {
            font-size: 0.9em;
            color: #888;
            margin-top: 10px;
            margin-bottom: 20px;
            text-align: right;
        }
        .result-section {
            margin-top: 30px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            overflow: hidden;
        }
        .result-row {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            background-color: #e9ecef;
        }
        .result-row:last-child {
            border-bottom: none;
        }
        .result-label {
            flex: 1;
            font-weight: bold;
            color: #333;
        }
        .result-value {
            flex: 2;
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        .result-value .value-text {
            margin-right: 10px;
        }
        .redaman-odp-value.terlalu-bagus {
            color: #ffa500; /* Orange */
        }
        .redaman-odp-value.optimal {
            color: #28a745; /* Green */
        }
        .redaman-odp-value.terlalu-besar {
            color: #dc3545; /* Red */
        }

        .sisa-laser-value {
            color: #28a745;
            background-color: #ffc107;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
            box-sizing: border-box;
            border: 1px solid #e0a800;
        }
        .copy-button {
            background-color: #6c757d;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
            margin-left: 10px;
        }
        .copy-button:hover {
            background-color: #5a6268;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #555;
            font-size: 0.9em;
        }
        .social-icons {
            margin-top: 10px;
        }
        .social-icons a {
            color: #555;
            margin: 0 10px;
            font-size: 1.5em;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .social-icons a:hover {
            color: #007bff; /* Change color on hover */
        }
        .social-icons a.fa-facebook:hover {
            color: #3b5998; /* Facebook blue */
        }
        .social-icons a.fa-instagram:hover {
            color: #C13584; /* Instagram purple/pink */
        }
        .social-icons a.fa-tiktok:hover {
            color: #000; /* TikTok black */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Aplikasi Kalkulator Rasio</h1>

        <?php
        $input_laser = '';
        $persen_rasio = '1:99'; // Default value
        $varian_odp = '1:8';   // Default value
        $redaman_odp_output_power = null;
        $sisa_laser_output_power = null;
        $error_message = '';
        $redaman_odp_status_text = '';
        $redaman_odp_status_class = '';

        // Predefined values for dropdowns (display only)
        $persen_rasio_options = [
            '0:0' => '0:0', // Tanpa splitter
            '1:99' => '1:99',
            '2:98' => '2:98',
            '3:97' => '3:97',
            '5:95' => '5:95',
            '10:90' => '10:90',
            '15:85' => '15:85',
            '20:80' => '20:80',
            '25:75' => '25:75',
            '30:70' => '30:70',
            '35:65' => '35:65',
            '40:60' => '40:60',
            '45:55' => '45:55',
            '50:50' => '50:50'
        ];

        $varian_odp_options = [
            '1:2' => '1:2',
            '1:4' => '1:4',
            '1:8' => '1:8',
            '1:16' => '1:16',
            '1:32' => '1:32',
            '1:64' => '1:64',
            '1:128' => '1:128'
        ];

        // Specific Loss values in dB for each path
        $persen_rasio_loss_values = [
            'main_port' => [
                '0:0' => 0.0,
                '1:99' => 0.24,
                '2:98' => 0.35,
                '3:97' => 0.45,
                '5:95' => 0.65,
                '10:90' => 1.15,
                '15:85' => 1.55,
                '20:80' => 2.05,
                '25:75' => 2.55,
                '30:70' => 3.05,
                '35:65' => 3.45,
                '40:60' => 3.95,
                '45:55' => 4.45,
                '50:50' => 4.85
            ],
            'tap_port' => [
                '0:0' => 0.0,
                '1:99' => 20.0,
                '2:98' => 17.0,
                '3:97' => 15.2,
                '5:95' => 13.0,
                '10:90' => 10.0,
                '15:85' => 8.2,
                '20:80' => 7.0,
                '25:75' => 6.0,
                '30:70' => 5.2,
                '35:65' => 4.6,
                '40:60' => 4.0,
                '45:55' => 3.5,
                '50:50' => 3.0
            ]
        ];

        $varian_odp_loss_values = [
            '1:2' => 3.5,
            '1:4' => 7.0,
            '1:8' => 10.5,
            '1:16' => 14.0,
            '1:32' => 17.5,
            '1:64' => 21.0,
            '1:128' => 24.5
        ];

        function getLossValue($ratio_key, $port_type, $loss_array) {
            return isset($loss_array[$port_type][$ratio_key]) ? $loss_array[$port_type][$ratio_key] : 0;
        }
        function getODPLossValue($ratio_key, $loss_array) {
            return isset($loss_array[$ratio_key]) ? $loss_array[$ratio_key] : 0;
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input_laser = str_replace(',', '.', $_POST['input_laser']);
            $persen_rasio = $_POST['persen_rasio'];
            $varian_odp = $_POST['varian_odp'];

            if (!is_numeric($input_laser)) {
                $error_message = "Input Laser harus berupa angka.";
            } else {
                $input_laser = (float)$input_laser;

                $loss_persen_rasio_tap = getLossValue($persen_rasio, 'tap_port', $persen_rasio_loss_values);
                $loss_varian_odp = getODPLossValue($varian_odp, $varian_odp_loss_values);

                if ($persen_rasio == '0:0') {
                    // If no ratio splitter, the signal goes directly to ODP.
                    // If ODP is also 0:0, then total loss is 0.
                    $total_loss_for_redaman_odp_path = $loss_varian_odp;
                } else {
                    $total_loss_for_redaman_odp_path = $loss_persen_rasio_tap + $loss_varian_odp;
                }
                
                $redaman_odp_output_power = $input_laser - $total_loss_for_redaman_odp_path;

                $threshold_optimal_upper_limit = -10.0;
                $threshold_optimal_lower_limit = -16.0;

                if ($redaman_odp_output_power > $threshold_optimal_upper_limit) {
                    $redaman_odp_status_text = ' (Power Laser Masih Terlalu Bagus)';
                    $redaman_odp_status_class = 'terlalu-bagus';
                } elseif ($redaman_odp_output_power >= $threshold_optimal_lower_limit && $redaman_odp_output_power <= $threshold_optimal_upper_limit) {
                    $redaman_odp_status_text = ' (Redaman Optimal)';
                    $redaman_odp_status_class = 'optimal';
                } else {
                    $redaman_odp_status_text = ' (Redaman Terlalu Besar)';
                    $redaman_odp_status_class = 'terlalu-besar';
                }

                $loss_persen_rasio_main = getLossValue($persen_rasio, 'main_port', $persen_rasio_loss_values);
                $sisa_laser_output_power = $input_laser - $loss_persen_rasio_main;
            }
        }
        ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="input_laser">Input Laser</label>
                <input type="text" id="input_laser" name="input_laser" placeholder="Power (dB)" value="<?php echo htmlspecialchars($input_laser); ?>" required>
                <span class="hint">Gunakan tanda titik untuk angka koma</span>
                <?php if (!empty($error_message)) : ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="persen_rasio">Persen Rasio</label>
                <span class="hint">Splitter Ratio</span>
                <select id="persen_rasio" name="persen_rasio">
                    <?php foreach ($persen_rasio_options as $key => $value) : ?>
                        <option value="<?php echo htmlspecialchars($key); ?>" <?php echo ($key == $persen_rasio) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($value); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="varian_odp">Varian ODP</label>
                <span class="hint">Pasif Splitter</span>
                <select id="varian_odp" name="varian_odp">
                    <?php foreach ($varian_odp_options as $key => $value) : ?>
                        <option value="<?php echo htmlspecialchars($key); ?>" <?php echo ($key == $varian_odp) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($value); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="bilhanet-calc">
                Bilhanet Ratio Calc
            </div>

            <button type="submit">HITUNG</button>
        </form>

        <?php if ($redaman_odp_output_power !== null && $sisa_laser_output_power !== null && empty($error_message)) : ?>
            <div class="result-section">
                <div class="result-row">
                    <div class="result-label">REDAMAN<br>ODP</div>
                    <div class="result-value">
                        <span class="value-text redaman-odp-value <?php echo $redaman_odp_status_class; ?>">
                            <?php echo number_format($redaman_odp_output_power, 2); ?> dBm
                        </span>
                        <?php if (!empty($redaman_odp_status_text)) : ?>
                            <span class="redaman-odp-text"><?php echo $redaman_odp_status_text; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="result-row">
                    <div class="result-label">SISA LASER<br>(Persen Besar)</div>
                    <div class="result-value">
                        <span class="value-text sisa-laser-value" id="sisaLaserValue"><?php echo number_format($sisa_laser_output_power, 2); ?></span>
                        <button type="button" class="copy-button" onclick="copyToInput()">Tempel ke Input</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?>. All Rights Reserved.</p>
        <div class="social-icons">
            <a href="https://www.facebook.com/HasbyZF" target="_blank" class="fab fa-facebook" aria-label="Facebook"></a>
            <a href="https://www.instagram.com/hasbyzf" target="_blank" class="fab fa-instagram" aria-label="Instagram"></a>
            <a href="https://www.tiktok.com/@kinghasby" target="_blank" class="fab fa-tiktok" aria-label="TikTok"></a>
        </div>
    </footer>

    <script>
        function copyToInput() {
            var sisaLaserValue = document.getElementById('sisaLaserValue').innerText;
            var inputLaserField = document.getElementById('input_laser');
            inputLaserField.value = sisaLaserValue.replace(',', '.');
        }
    </script>
</body>
</html>

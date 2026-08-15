<?php
$units = "";
$bill = null;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $units = trim($_POST["units"]);

    if ($units === "" || !is_numeric($units) || $units < 0) {
        $error = "Please enter a valid number of units.";
    } else {
        $units = (float)$units;
        $bill = 0;

        if ($units <= 50) {
            $bill = $units * 3.50;
        } elseif ($units <= 150) {
            $bill = (50 * 3.50) + (($units - 50) * 4.00);
        } elseif ($units <= 250) {
            $bill = (50 * 3.50) + (100 * 4.00) + (($units - 150) * 5.20);
        } else {
            $bill = (50 * 3.50) + (100 * 4.00) + (100 * 5.20) + (($units - 250) * 6.50);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 15px;
        }
        .card {
            background: #fff;
            width: 100%;
            max-width: 420px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 22px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label { display: block; margin-bottom: 8px; color: #555; }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover { background: #1d4ed8; }
        .result {
            margin-top: 20px;
            padding: 15px;
            background: #e7f5e9;
            border-radius: 5px;
            text-align: center;
            font-size: 18px;
            color: #1b5e20;
        }
        .error {
            margin-top: 20px;
            padding: 12px;
            background: #fde8e8;
            border-radius: 5px;
            text-align: center;
            color: #b91c1c;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Electricity Bill Calculator</h1>

        <form method="post">
            <label for="units">Enter Units Consumed:</label>
            <input type="number" step="any" name="units" id="units"
                   value="<?php echo htmlspecialchars($units); ?>"
                   placeholder="e.g. 320" required>
            <button type="submit">Calculate Bill</button>
        </form>

        <?php if ($error != "") { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <?php if ($bill !== null && $error == "") { ?>
            <div class="result">
                Total Bill: <strong>Rs. <?php echo number_format($bill, 2); ?></strong>
            </div>
        <?php } ?>

        <table>
            <tr><th>Units</th><th>Rate/Unit</th></tr>
            <tr><td>First 50</td><td>Rs. 3.50</td></tr>
            <tr><td>Next 100</td><td>Rs. 4.00</td></tr>
            <tr><td>Next 100</td><td>Rs. 5.20</td></tr>
            <tr><td>Above 250</td><td>Rs. 6.50</td></tr>
        </table>
    </div>
</body>
</html>

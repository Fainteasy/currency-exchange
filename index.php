<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Conversion API</title>
</head>
<body>

<form method="post" id="currency-form">
    <div class="form-group">
        <label>From</label>
        <select name="from_currency">
            <option value="INR">Indian Rupee</option>
            <option value="USD" selected="1">US Dollar</option>
            <option value="AUD">Australian Dollar</option>
            <option value="EUR">Euro</option>
            <option value="EGP">Egyptian Pound</option>
            <option value="CNY">Chinese Yuan</option>
        </select>

        <label>Amount</label>
        <input type="text" placeholder="Currency" name="amount" id="amount"/>

        <label>To</label>
        <select name="to_currency">
            <option value="INR" selected="1">Indian Rupee</option>
            <option value="USD">US Dollar</option>
            <option value="AUD">Australian Dollar</option>
            <option value="EUR">Euro</option>
            <option value="EGP">Egyptian Pound</option>
            <option value="CNY">Chinese Yuan</option>
        </select>

        <button type="submit" name="convert" id="convert" class="btn btn-default">Convert</button>
    </div>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'currency_api.php';

    $from_currency = $_POST['from_currency'];
    $amount = $_POST['amount'];
    $to_currency = $_POST['to_currency'];

    $api_response = getCurrencyConvert();

    $api_data = json_decode($api_response, true);

    if ($api_data && isset($api_data['rates']) && isset($api_data['rates'][$to_currency])) {
        $converted_amount = $amount * $api_data['rates'][$to_currency];

        echo "Converted Amount: $converted_amount $to_currency";
    } else {
        if ($api_data && isset($api_data['error'])) {
            echo "API Error: " . $api_data['error'];
        } else {
            echo "Error in currency conversion. Please try again.";
        }
    }
}
?>






</body>
</html>

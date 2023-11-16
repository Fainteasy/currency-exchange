
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Conversion</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.2/components/contacts/contact-4/assets/css/contact-4.css">
    <script src="https://kit.fontawesome.com/90f23d29c2.js" crossorigin="anonymous"></script>
    </head>
<body>
<section class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
        <h3 class="fs-6 text-secondary mb-2 text-uppercase text-center">Currency Converter</h3>
        <h2 class="display-5 mb-4 mb-md-5 text-center">Convert your money from one currency to another with a live actualisation of the rates.</h2>
        <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row gy-3 gy-md-4 gy-lg-0 align-items-xl-center">
      <div class="col-12 col-lg-6">
        <img class="img-fluid rounded" src="img/money.jpg" alt="">
      </div>
      <div class="col-12 col-lg-6">
        <div class="row justify-content-xl-center">
          <div class="col-12 col-xl-11">
            <div class="bg-white border rounded shadow-sm overflow-hidden">
              <form method="post" id="currency-form">
                <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                  <div class="col-12">
                    <label class="form-label">From (Currency) <span class="text-danger">*</span></label>
                    <select name="from_currency" class="form-select" id="from_currency">
                        <option value="INR">Indian Rupee (INR)</option>
                        <option value="USD" selected="1">US Dollar (USD)</option>
                        <option value="AUD">Australian Dollar (AUD)</option>
                        <option value="EUR">Euro (EUR)</option>
                        <option value="EGP">Egyptian Pound (EGP)</option>
                        <option value="CNY">Chinese Yuan (CNY)</option>
                    </select>
                  </div>
                  <div class="col-8">
                    <label class="form-label" for="amount">Amount <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="amount" name="amount" value="" required placeholder="Currency">
                  </div>
                  <div class="col-4 d-flex align-items-center justify-content-center">
                    <button type="button" id="invertButton" class="btn btn-primary" onclick="swapCurrencies();">                     <i class="fa-solid fa-arrow-right-arrow-left fa-rotate-90" style="color: white;"></i></button>
                  </div>
                  <div class="col-12">
                    <label class="form-label">To <span class="text-danger">*</span></label>
                    <select name="to_currency" class="form-select" id="to_currency">
                        <option value="INR" selected="1">Indian Rupee (INR)</option>
                        <option value="USD">US Dollar (USD)</option>
                        <option value="AUD">Australian Dollar (AUD)</option>
                        <option value="EUR">Euro (EUR)</option>
                        <option value="EGP">Egyptian Pound (EGP)</option>
                        <option value="CNY">Chinese Yuan (CNY)</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button name="convert" id="convert" class="btn btn-primary btn-lg" type="submit">Convert</button>
                    </div>
                  </div>
                </div>
              </form>
                <div class="col-12 px-4 text-center">
                    <p>Résultat :</p>
                        <span class="border border-primary col-3 py-3 px-2 rounded">
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

                                        echo round($converted_amount,2) . " " . "$to_currency";
                                    } else {
                                        if ($api_data && isset($api_data['error'])) {
                                            echo "API Error: " . $api_data['error'];
                                        } else {
                                            echo "Error in currency conversion. Please try again.";
                                        }
                                    }
                                    
                                }
                            ?>
                        </span>
                    </p>
                </div>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  function swapCurrencies() {
    var fromCurrencySelect = document.getElementById('from_currency');
    var toCurrencySelect = document.getElementById('to_currency');

    var temp = fromCurrencySelect.value;
    fromCurrencySelect.value = toCurrencySelect.value;
    toCurrencySelect.value = temp;
  }
</script>
</body>
</html>

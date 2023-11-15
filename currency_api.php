<?php

function getCurrencyConvert() {
	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://currency-conversion-and-exchange-rates.p.rapidapi.com/latest",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"X-RapidAPI-Host: currency-conversion-and-exchange-rates.p.rapidapi.com",
			"X-RapidAPI-Key: addc954cffmsh90fb7cbe65b370bp1a6aeejsn73f86ac0c61c"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		
	}
	return $response;
}
echo $response;
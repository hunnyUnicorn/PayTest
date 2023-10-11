<?php
namespace Win\Test;
require_once('./src/Exchange.php');

$call = Exchange::CallAPI('GET', 'http://api.exchangeratesapi.io/latest', array('access_key' => '4e08a55f7e018524cefdf564190e44da'));
if ( !$call ) {
  echo 'Failed at getting exchange rate data';
  exit();
}
$exchangeRates = json_decode($call, true);

$lines = file($argv[1], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
  $values = explode(',', $line);
  $bin = trim(explode(':', $values[0])[1], '"');
  $amount = trim(explode(':', $values[1])[1], '"}');
  $currency = trim(explode(':', $values[2])[1], '"}');

  $binResults = file_get_contents('https://lookup.binlist.net/' . $bin);
  if (!$binResults) {
    echo 'Failed at fetching rate data';
    exit();
  }
  $result = json_decode($binResults);
  $isEu = Exchange::isEu($result->country->alpha2);
  $rate = $exchangeRates['rates'][$currency];

  $amntFixed = ($currency == 'EUR' || $rate == 0) ? $amount : $amount / $rate;
  echo Exchange::round_up($amntFixed * ($isEu ? 0.01 : 0.02)) . "\n";
}
?>
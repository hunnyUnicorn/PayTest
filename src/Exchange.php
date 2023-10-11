<?php
namespace Win\Test;

final class Exchange {
  public static function CallAPI($method, $url, $data = false)
  {
    $curl = curl_init();
    switch ($method) {
      case 'POST':
        curl_setopt($curl, CURLOPT_POST, 1);
        if ($data)
          curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        break;
      case 'PUT':
        curl_setopt($curl, CURLOPT_PUT, 1);
        if ($data)
           curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
        break;
      default:
        if ($data)
          $url = sprintf('%s?%s', $url, http_build_query($data));
    }
  
    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  
    $result = curl_exec($curl);
  
    curl_close($curl);
  
    return $result;
  }

  public static function round_up($value, $precision = 2) { 
    $pow = pow ( 10, $precision ); 
    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow; 
  } 
  
  public static function isEu($countryCode) {
    $euCountries = [
      'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'
    ];
    return in_array($countryCode, $euCountries);
  }
}
?>
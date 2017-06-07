<?php 
define("FIXER_BASE_URL", "http://api.fixer.io/");

class Fixer {
    public static function getAllCurrencies($client)
    {
        $url = FIXER_BASE_URL.'latest';

        $res = $client->get($url);
        $currencies = json_decode($res->getBody(), true);

        $allCurrencies = array_keys($currencies['rates']);
        $allCurrencies[] = $currencies['base'];

        return $allCurrencies;
    }

    public static function getRateByCurrency($client, $baseCurrency, $targetCurrency)
    {
        $url = FIXER_BASE_URL.'latest?base='.$baseCurrency.'&symbols='.strtoupper($targetCurrency);

        $res = $client->get($url);
        $rates = json_decode($res->getBody(), true);

        return $rates['rates'][$targetCurrency];       
    }

    public static function getAllRates($client, $baseCurrency)
    {
        $url = FIXER_BASE_URL.'latest?base='.$baseCurrency;

        $res = $client->get($url);
        $rates = json_decode($res->getBody(), true);

        return $rates['rates'];
    }
}
?>
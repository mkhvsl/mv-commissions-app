<?php

namespace Mkhvsl\MvCommissionsApp;

class ExchangeRatesApiProvider implements ExchangeRateProviderInterface {
    public function getRate(string $currency): float {
        try {
            $response = @file_get_contents("http://api.exchangeratesapi.io/latest?access_key=845b0ba5709fa8c9b9448f2942ea0e1f");
            if (!$response) {
                $error = error_get_last();
                throw new \Exception("Empty response from exchange rate service: " . $error['message']);
            }

            $data = json_decode($response, true);
            if (!isset($data['rates'][$currency])) {
                throw new \Exception("Rate for currency {$currency} not found.");
            }

            return (float) $data['rates'][$currency];
        } catch (\Throwable $e) {
            throw new \Exception("Exchange rate lookup failed: " . $e->getMessage());
        }
    }
}
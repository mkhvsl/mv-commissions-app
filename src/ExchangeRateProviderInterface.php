<?php

namespace Mkhvsl\MvCommissionsApp;

interface ExchangeRateProviderInterface {
    public function getRate(string $currency): float;
}
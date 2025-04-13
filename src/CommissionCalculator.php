<?php

namespace Mkhvsl\MvCommissionsApp;

class CommissionCalculator {
    private BinProviderInterface $binProvider;
    private ExchangeRateProviderInterface $rateProvider;

    public function __construct(BinProviderInterface $binProvider, ExchangeRateProviderInterface $rateProvider) {
        $this->binProvider = $binProvider;
        $this->rateProvider = $rateProvider;
    }

    public function calculate(string $bin, float $amount, string $currency): float {
        $isEu = Utils::isEu($this->binProvider->getCountryCode($bin));

        $rate = $currency === 'EUR' ? 1.0 : $this->rateProvider->getRate($currency);

        if ($rate <= 0) {
            throw new \Exception("Invalid rate for currency: $currency");
        }

        $amountEur = $amount / $rate;
        $commission = $amountEur * ($isEu ? 0.01 : 0.02);

        return ceil($commission * 100) / 100;
    }
}
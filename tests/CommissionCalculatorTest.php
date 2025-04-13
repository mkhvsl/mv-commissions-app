<?php

use PHPUnit\Framework\TestCase;
use Mkhvsl\MvCommissionsApp\CommissionCalculator;
use Mkhvsl\MvCommissionsApp\ExchangeRateProviderInterface;
use Mkhvsl\MvCommissionsApp\BinProviderInterface;

class CommissionCalculatorTest extends TestCase {
    public function testEuCommissionCeiling() {
        $binMock = $this->createMock(BinProviderInterface::class);
        $rateMock = $this->createMock(ExchangeRateProviderInterface::class);

        $binMock->method('getCountryCode')->willReturn('ES');
        $rateMock->method('getRate')->willReturn(1.0);

        $calc = new CommissionCalculator($binMock, $rateMock);
        $this->assertEquals(0.47, $calc->calculate('45717360', 46.1234, 'EUR'));
    }

    public function testNonEuCommissionCeiling() {
        $binMock = $this->createMock(BinProviderInterface::class);
        $rateMock = $this->createMock(ExchangeRateProviderInterface::class);

        $binMock->method('getCountryCode')->willReturn('US');
        $rateMock->method('getRate')->willReturn(2.0);

        $calc = new CommissionCalculator($binMock, $rateMock);
        $this->assertEquals(0.47, $calc->calculate('123456', 46.1234, 'USD'));
    }
}
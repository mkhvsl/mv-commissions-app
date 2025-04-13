<?php

namespace Mkhvsl\MvCommissionsApp;

interface BinProviderInterface {
    public function getCountryCode(string $bin): string;
}
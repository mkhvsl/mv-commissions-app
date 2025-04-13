<?php

namespace Mkhvsl\MvCommissionsApp;

class BinListProvider implements BinProviderInterface {
    public function getCountryCode(string $bin): string {
        try {
            $response = @file_get_contents("https://lookup.binlist.net/{$bin}");
            if (!$response) {
                $error = error_get_last();
                throw new \Exception("Empty response from BIN service: " . $error['message']);
            }

            $data = json_decode($response);
            if (!isset($data->country->alpha2)) {
                throw new \Exception("Country code not found in BIN response.");
            }

            return $data->country->alpha2;
        } catch (\Throwable $e) {
            throw new \Exception("BIN lookup failed: " . $e->getMessage());
        }
    }
}
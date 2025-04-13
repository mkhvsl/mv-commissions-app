<?php

namespace Mkhvsl\MvCommissionsApp;

class Utils {
    public static function isEu(string $countryCode): bool {
        return in_array($countryCode, [
            'AT','BE','BG','CY','CZ','DE','DK','EE','ES','FI','FR',
            'GR','HR','HU','IE','IT','LT','LU','LV','MT','NL','PL',
            'PT','RO','SE','SI','SK'
        ]);
    }
}
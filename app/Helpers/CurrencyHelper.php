<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function format($amount, $currency = null)
    {
        $currency = $currency ?? config('currency.default');
        $currencyConfig = config("currency.currencies.{$currency}");
        
        if (!$currencyConfig) {
            return number_format($amount, 2);
        }
        
        $symbol = $currencyConfig['symbol'];
        $position = $currencyConfig['position'];
        $decimalPlaces = $currencyConfig['decimal_places'];
        
        $formattedAmount = number_format($amount, $decimalPlaces);
        
        if ($position === 'left') {
            return $symbol . $formattedAmount;
        } else {
            return $formattedAmount . $symbol;
        }
    }
    
    public static function getSymbol($currency = null)
    {
        $currency = $currency ?? config('currency.default');
        $currencyConfig = config("currency.currencies.{$currency}");
        
        return $currencyConfig['symbol'] ?? '₹';
    }
    
    public static function getCurrencies()
    {
        return config('currency.currencies');
    }
} 
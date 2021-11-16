<?php

namespace NathanDunn\CurrencyCasts;

use Brick\Money\Exception\UnknownCurrencyException;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Arr;

class CurrencyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return Money
     * @throws UnknownCurrencyException
     */
    public function get($model, $key, $value, $attributes)
    {
        $data = json_decode($value);

        return Money::ofMinor(
            Arr::get($data, 'amount'), 
            Arr::get($data, 'currency')
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Model $model
     * @param string $key
     * @param Money|null $value
     * @param array $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return json_encode([
            'currency' => $value->getCurrency()->getCurrencyCode(),
            'amount' => $value->getMinorAmount()->toInt(),
        ]);
    }
}

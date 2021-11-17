<?php

namespace NathanDunn\CurrencyCasts;

use Brick\Money\Exception\UnknownCurrencyException;
use Brick\Money\Money;
use Exception;
use Illuminate\Database\Eloquent\Model;

class NullableCurrencyCast extends CurrencyCast
{
    /**
     * Cast the given value.
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return Money|null
     * @throws UnknownCurrencyException
     */
    public function get($model, $key, $value, $attributes)
    {
        if (null === $value) {
            return null;
        }

        return parent::get($model, $key, $value, $attributes);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Model $model
     * @param string $key
     * @param Money|null $value
     * @param array $attributes
     * @return string|null
     * @throws Exception
     */
    public function set($model, $key, $value, $attributes)
    {
        if (null === $value) {
            return null;
        }

        return parent::set($model, $key, $value, $attributes);
    }
}
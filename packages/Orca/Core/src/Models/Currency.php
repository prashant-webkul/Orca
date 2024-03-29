<?php

namespace Orca\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Orca\Core\Contracts\Currency as CurrencyContract;

class Currency extends Model implements CurrencyContract
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name'
    ];

    /**
     * Set currency code in capital
     *
     * @param  string  $value
     * @return void
     */
    public function setCodeAttribute($code)
    {
        $this->attributes['code'] = strtoupper($code);
    }

    /**
     * Get the currency_exchange associated with the currency.
     */
    public function CurrencyExchangeRate()
    {
        return $this->hasOne(CurrencyExchangeRateProxy::modelClass(), 'target_currency');
    }
}
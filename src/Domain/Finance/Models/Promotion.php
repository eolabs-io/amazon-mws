<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use EolabsIo\AmazonMws\Database\Factories\PromotionFactory;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;

class Promotion extends AmazonMwsModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'promotion_type',
                    'promotion_id',
                    'promotion_amount_id',
                ];

    protected $hidden = ['pivot'];

    public function promotionAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'promotion_amount_id', 'id')->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PromotionFactory::new();
    }
}

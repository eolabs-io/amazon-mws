<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Database\Factories\DebtRecoveryItemFactory;

class DebtRecoveryItem extends AmazonMwsModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'group_begin_date' => 'datetime',
        'group_end_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'recovery_amount_id',
                    'original_amount_id',
                    'group_begin_date',
                    'group_end_date',
                ];

    protected $hidden = ['pivot'];

    public function recoveryAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'recovery_amount_id', 'id')->withDefault();
    }

    public function originalAmount()
    {
        return $this->belongsTo(CurrencyAmount::class, 'original_amount_id', 'id')->withDefault();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return DebtRecoveryItemFactory::new();
    }
}

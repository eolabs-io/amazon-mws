<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\CurrencyAmount;
use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\TaxWithheldComponent;
use Illuminate\Database\Eloquent\Model;


class RentalTransactionEvent extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'posted_date' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'amazon_order_id',
                    'rental_event_type',
                    'extension_length',
                    'posted_date',
                    'marketplace_name',
                    'rental_initial_value_id',
                    'rental_reimbursement_id',
				];
    
    protected $hidden = ['pivot'];

    public function rentalChargeList()
    {
        return $this->belongsToMany(ChargeComponent::class, 'charge_component_rental_charge');
    }

    public function rentalFeeList()
    {
        return $this->belongsToMany(FeeComponent::class, 'fee_component_rental_fee');
    }

    public function rentalInitialValue()
    {
        return $this->belongsTo(CurrencyAmount::class, 'rental_initial_value_id', 'id')->withDefault();
    }

    public function rentalReimbursement()
    {
        return $this->belongsTo(CurrencyAmount::class, 'rental_reimbursement_id', 'id')->withDefault();
    }

    public function rentalTaxWithheldList()
    {
        return $this->belongsToMany(TaxWithheldComponent::class, 'rental_tax_withheld_tax_withheld_component');
    }

}
<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\FeeComponent;
use Illuminate\Database\Eloquent\Model;


class ServiceFeeEvent extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'amazon_order_id',
                    'fee_reason',
                    'seller_sku',
                    'fn_sku',
                    'fee_description',
                    'asin',
				];

    public function feeList()
    {
        return $this->belongsToMany(FeeComponent::class, 'fee_component_service_fee_list');
    }

}
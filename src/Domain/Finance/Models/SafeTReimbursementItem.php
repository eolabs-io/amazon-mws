<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;
use EolabsIo\AmazonMws\Database\Factories\SafeTReimbursementItemFactory;

class SafeTReimbursementItem extends AmazonMwsModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['safe_t_reimbursement_event_id',];

    public function safeTReimbursementEvent()
    {
        return $this->belongsTo(SafeTReimbursementEvent::class);
    }

    public function itemChargeList()
    {
        return $this->belongsToMany(ChargeComponent::class);
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return SafeTReimbursementItemFactory::new();
    }
}

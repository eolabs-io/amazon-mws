<?php

namespace EolabsIo\AmazonMws\Domain\Finance\Models;

use EolabsIo\AmazonMws\Domain\Finance\Models\ChargeComponent;
use EolabsIo\AmazonMws\Domain\Finance\Models\SafeTReimbursementEvent;
use Illuminate\Database\Eloquent\Model;


class SafeTReimbursementItem extends Model
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
}
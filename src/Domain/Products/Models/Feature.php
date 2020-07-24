<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;
use Illuminate\Database\Eloquent\Model;


class Feature extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
							'feature', 
                            'item_attribute_id'
    					];

    public function itemAttribute()
    {
        return $this->belongsTo(ItemAttributes::class);
    }

}
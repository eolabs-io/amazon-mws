<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;
use EolabsIo\AmazonMws\Domain\Products\Models\SalesRank;
use EolabsIo\AmazonMws\Domain\Products\Models\VariationChild;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'asin',
                            'marketplace_id',
                            'name',
                        ];


    public function attributeSets()
    {
        return $this->hasMany(ItemAttributes::class);
    }

    public function relationships()
    {
        return $this->hasMany(VariationChild::class);
    }

    public function salesRankings()
    {
        return $this->hasMany(SalesRank::class);
    }
}

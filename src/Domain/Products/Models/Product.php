<?php

namespace EolabsIo\AmazonMws\Domain\Products\Models;

use EolabsIo\AmazonMws\Domain\Products\Models\SalesRank;
use EolabsIo\AmazonMws\Database\Factories\ProductFactory;
use EolabsIo\AmazonMws\Domain\Shared\Models\AmazonMwsModel;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;
use EolabsIo\AmazonMws\Domain\Products\Models\VariationChild;

class Product extends AmazonMwsModel
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return ProductFactory::new();
    }
}

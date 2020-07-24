<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use EolabsIo\AmazonMws\Domain\Products\Models\Image;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemAttributes;
use EolabsIo\AmazonMws\Domain\Products\Models\ItemDimension;
use EolabsIo\AmazonMws\Domain\Products\Models\PackageDimension;
use EolabsIo\AmazonMws\Domain\Products\Models\Product;
use Faker\Generator as Faker;

$factory->define(ItemAttributes::class, function (Faker $faker) {
    return [
			'binding' => $faker->text(30), 
			'brand' => $faker->text(30), 
			'is_adult_product' => $faker->boolean, 
			'label' => $faker->text(30), 
			'manufacturer' => $faker->text(30), 
			'package_quantity' => $faker->randomNumber(), 
			'part_number' => $faker->text(30), 
			'product_group' => $faker->text(30), 
			'product_type_name' => $faker->text(30), 
			'publisher' => $faker->text(30), 
			'size' => $faker->text(30), 
			'studio' => $faker->text(30), 
			'title' => $faker->text(30), 
			'product_id' => function() {
            	return factory(Product::class)->create()->id;
            },			
			'item_dimension_id' => function() {
            	return factory(ItemDimension::class)->create()->id;
            },
			'package_dimension_id' => function() {
            	return factory(PackageDimension::class)->create()->id;
            },
			'small_image_id' => function() {
            	return factory(Image::class)->create()->id;
            },
    ];
});
<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Models;

use Illuminate\Database\Eloquent\Model;


class Timepoint extends Model
{
	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
	    'date_time' => 'datetime',
	];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		            'timepoint_type',
		            'date_time',
				];
}
<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait FormatsModelAttributes
{
    /** @var Illuminate\Support\Collection */
    private $fillable;

    /** @var Illuminate\Support\Collection */
    private $castable;

    private function setModelToFormat(Model $model)
    {
        $this->fillable = collect(($model)->getFillable());
        $this->castable = collect(($model)->getCasts());
    }

	public function getFormatedAttributes(array $items, Model $model): array
    {
        $this->setModelToFormat($model);

        return $this->fillable->flatMap(function($item) use($items) {
            $key = $this->customFormats( Str::ucfirst(Str::camel($item)) );
            $value = data_get($items, $key);
            if(is_null($value) ) {
                return [];
            }

            $value = $this->cast($item, $value);

            return [$item => $value];
        })->toArray();
    }

    public function customFormats($element): string
    {
        $element = Str::replaceFirst('Sku', 'SKU', $element);
        $element = Str::replaceFirst('Asin', 'ASIN', $element);
        $element = Str::replaceFirst('SafeTClaimId', 'SAFETClaimId', $element);
        $element = Str::replaceFirst('Igst', 'IGST', $element);
        $element = Str::replaceFirst('Cgst', 'CGST', $element);
        $element = Str::replaceFirst('Sgst', 'SGST', $element);

        return $element;
    }

    public function cast($key, $value)
    {
        if(! $this->castable->keys()->contains($key)) {
            return $value;
        }

        $castable = data_get($this->castable, $key);

        switch($castable) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            default:
                return $value;
        }
    }

}
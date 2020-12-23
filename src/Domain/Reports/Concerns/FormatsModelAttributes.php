<?php

namespace EolabsIo\AmazonMws\Domain\Reports\Concerns;

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

        return $this->fillable->flatMap(function ($item) use ($items) {
            $key = $this->formatKey($item);
            $value = data_get($items, $key);
            $value = $this->cast($item, $value);

            return [$item => $value];
        })->toArray();
    }

    public function formatKey($key): string
    {
        return Str::of($key)->camel()->kebab();
    }

    public function cast($key, $value)
    {
        if (! $this->castable->keys()->contains($key)) {
            return $value;
        }

        $castable = data_get($this->castable, $key);

        switch ($castable) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            default:
                return $value;
        }
    }
}

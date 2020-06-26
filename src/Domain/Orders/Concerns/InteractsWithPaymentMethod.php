<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Concerns;

trait InteractsWithPaymentMethod
{
    /** @var array */
    private $paymentMethod = [];

    public function withPaymentMethodAll(): self
    {
        $this->paymentMethod = [];

        return $this;
    }

    public function withPaymentMethodCOD(): self
    {
        array_push($this->paymentMethod, 'COD');

        return $this;
    }

    public function withPaymentMethodCVS(): self
    {
        array_push($this->paymentMethod, 'CVS');

        return $this;
    }

    public function withPaymentMethodOther(): self
    {
        array_push($this->paymentMethod, 'Other');

        return $this;
    }

    public function hasPaymentMethod(): bool
    {
        return count($this->paymentMethod) > 0;
    }

    public function getPaymentMethod(): array
    {
        return $this->paymentMethod;
    }

    public function formattedPaymentMethod(): array
    {
        return collect($this->getPaymentMethod())->mapWithKeys(function ($item, $key){
             $key++;
             return ["PaymentMethod.Method.{$key}" => $item ];
        })->toArray();
    }

    public function getPaymentMethodParameter(): array
    {
        if(! $this->hasPaymentMethod()){
            return [];
        }

        return $this->formattedPaymentMethod();
    }

}
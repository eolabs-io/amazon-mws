<?php

namespace EolabsIo\AmazonMws\Domain\Orders\Jobs;

use EolabsIo\AmazonMws\Domain\Orders\Models\Address;
use EolabsIo\AmazonMws\Domain\Orders\Models\BuyerTaxInfo;
use EolabsIo\AmazonMws\Domain\Orders\Models\Money;
use EolabsIo\AmazonMws\Domain\Orders\Models\Order;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentExecutionDetailItem;
use EolabsIo\AmazonMws\Domain\Orders\Models\PaymentMethodDetail;
use EolabsIo\AmazonMws\Domain\Orders\Models\TaxClassification;
use EolabsIo\AmazonMws\Domain\Shared\Concerns\FormatsModelAttributes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProcessListOrdersResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, FormatsModelAttributes;

    /** @var Illuminate\Support\Collection */
    public $results;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $results)
    {
        $this->results = $results;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->persistListOrders();
    }

    public function persistListOrders()
    {
        $items = data_get($this->results, 'Orders');
        array_walk($items, [$this,'createOrderFromList']);
    }

    public function createOrderFromList($orderList)
    {
        $store_id = data_get($this->results, 'store_id');
        $attributes = ['amazon_order_id' => data_get($orderList, 'AmazonOrderId')];
        $values = array_merge( $this->getFormatedAttributes($orderList, new Order), compact('store_id') );

        $order = Order::updateOrCreate($attributes, $values);

        $this->associateShippingAddress($orderList, $order);
        $this->associateOrderTotal($orderList, $order);
        $this->associatePaymentExecutionDetail($orderList, $order);
        $this->associatePaymentMethodDetails($orderList, $order);
        $this->associateBuyerTaxInfo($orderList, $order);
    }


    public function associateShippingAddress($orderList, Order $order)
    {
        $shippingAddressList = data_get($orderList, 'ShippingAddress', null);

        if (!$shippingAddressList) {
            return;
        }

        $values = $this->getFormatedAttributes($shippingAddressList, new Address);

        $shippingAddress = $order->shippingAddress;
        $shippingAddress->fill($values)->save();

        $order->shippingAddress()
              ->associate($shippingAddress);

        $order->save();
    }

    public function associateOrderTotal($orderList, Order $order)
    {
        $orderTotalList = data_get($orderList, 'OrderTotal', null);

        if (!$orderTotalList) {
            return;
        }

        $values = $this->getFormatedAttributes($orderTotalList, new Money);

        $orderTotal = $order->orderTotal;
        $orderTotal->fill($values)->save();

        $order->orderTotal()
              ->associate($orderTotal);

        $order->save();
    }

    public function associatePaymentExecutionDetail($orderList, Order $order)
    {

        $paymentExecutionDetailList = data_get($orderList, 'PaymentExecutionDetail', null);

        if (!$paymentExecutionDetailList) {
            return;
        }

        foreach ($paymentExecutionDetailList as $item) {

            $values = $this->getFormatedAttributes($item, new PaymentExecutionDetailItem);
            $moneyValues = $this->getFormatedAttributes(data_get($item, 'Payment'), new Money);
            
            $payment = Money::create($moneyValues);
            $values['money_id'] = $payment->id;

            $paymentExecutionDetail = $order->paymentExecutionDetail()->create($values);
        }
    }

    public function associatePaymentMethodDetails($orderList, Order $order)
    {
        $paymentMethodDetailsList = data_get($orderList, 'PaymentMethodDetails', null);

        if (!$paymentMethodDetailsList) {
            return;
        }

        foreach ($paymentMethodDetailsList as $item) {
            $values = ['payment_method_detail' => $item];

            $paymentMethodDetails = $order->paymentMethodDetails;
            $paymentMethodDetails->fill($values)->save();

            $order->paymentMethodDetails()
                  ->associate($paymentMethodDetails);

            $order->save();
        }
    }

    public function associateBuyerTaxInfo($orderList, Order $order)
    {
        $buyerTaxInfoList = data_get($orderList, 'BuyerTaxInfo', null);

        if (!$buyerTaxInfoList) {
            return;
        }

        $values = $this->getFormatedAttributes($buyerTaxInfoList, new BuyerTaxInfo);

        $buyerTaxInfo = $order->buyerTaxInfo()->create($values);
        
        $taxClassificationsValues = data_get($buyerTaxInfoList, 'TaxClassifications');

        foreach($taxClassificationsValues as $taxClassificationsValue) {
            TaxClassification::create(array_merge(['buyer_tax_info_id' => $buyerTaxInfo->id],
                                          $this->getFormatedAttributes($taxClassificationsValue, new TaxClassification)));

        }

        $order->buyerTaxInfo()->associate($buyerTaxInfo);
    }  
}

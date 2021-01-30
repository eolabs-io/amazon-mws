<?php

namespace EolabsIo\AmazonMws\Domain\Shared\Listeners;

use EolabsIo\AmazonMws\Domain\Reports\Models\AmazonFulfilledShipment;
use EolabsIo\AmazonMws\Domain\Shared\Models\Buyer;

class CreateOrUpdateBuyer
{
    public function handle($event)
    {
        $shipment = data_get($event, 'shipment');
        if ($shipment instanceof AmazonFulfilledShipment) {
            $this->createOrUpdateFromAmazonFulfilledShipment($shipment);
        }
    }

    private function createOrUpdateFromAmazonFulfilledShipment(AmazonFulfilledShipment $shipment)
    {
        if (is_null($shipment->buyer_email)) {
            return;
        }

        $attributes = [
            'email' => $shipment->buyer_email
        ];

        $values = [
            'email' => $shipment->buyer_email,
            'name' => $shipment->recipient_name,
            'address_1' => $shipment->ship_address1,
            'address_2' => $shipment->ship_address2,
            'address_3' => $shipment->ship_address3,
            'city' => $shipment->ship_city,
            'state' => $shipment->ship_state,
            'postal_code' => $shipment->ship_postal_code,
            'country' => $shipment->ship_country,
            'phone_number' => $shipment->ship_phone_number,
        ];

        Buyer::lockForUpdate()->updateOrCreate($attributes, $values);
    }
}

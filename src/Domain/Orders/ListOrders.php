<?php

namespace EolabsIo\AmazonMws\Domain\Orders;

use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithBuyerEmail;
use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithCreatedTimeFrames;
use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithEasyShipShipmentStatus;
use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithFulfillmentChannel;
use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithLastUpdatedTimeFrames;
use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithMarketplaceIds;
use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithMaxResultsPerPage;
use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithOrderStatus;
use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithPaymentMethod;
use EolabsIo\AmazonMws\Domain\Orders\Concerns\InteractsWithSellerOrderId;
use EolabsIo\AmazonMws\Domain\Orders\OrderCore;


class ListOrders extends OrderCore
{
	use InteractsWithCreatedTimeFrames, 
		InteractsWithLastUpdatedTimeFrames,
	    InteractsWithOrderStatus,
	    InteractsWithMarketplaceIds,
	    InteractsWithFulfillmentChannel,
	    InteractsWithPaymentMethod,
	    InteractsWithBuyerEmail,
	    InteractsWithSellerOrderId,
	    InteractsWithMaxResultsPerPage,
	    InteractsWithEasyShipShipmentStatus;


	public function resolveOptionalParameters(): void
	{
		$this->mergeParameters( [$this->getCreatedTimeFrameParameter(),
								 $this->getLastUpdatedTimeFrameParameter(),
								 $this->getOrderStatusParameter(),
								 $this->getMarketplaceIdsParameter(),
								 $this->getFulfillmentChannelParameter(),
								 $this->getPaymentMethodParameter(),
								 $this->getBuyerEmailParameter(),
								 $this->getSellerOrderIdParameter(),
								 $this->getMaxResultsPerPageParameter(),
								 $this->formattedEasyShipShipmentStatus(),
								 ]
		);
	}


}

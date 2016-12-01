<?php
/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductBundle\Business\ProductBundle;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Orm\Zed\Sales\Persistence\Base\SpySalesOrderItemQuery;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemBundle;

class ProductBundleSalesOrderSaver
{

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponse
     */
    public function saveSaleOrderBundleItems(QuoteTransfer $quoteTransfer, CheckoutResponseTransfer $checkoutResponse)
    {
        $bundleItemsSaved = $this->saveBundleProducts($quoteTransfer);
        $this->updateRelatedSalesOrderItems($checkoutResponse, $bundleItemsSaved);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array
     */
    protected function saveBundleProducts(QuoteTransfer $quoteTransfer)
    {
        $bundleItemsSaved = [];
        foreach ($quoteTransfer->getBundleItems() as $itemTransfer) {

            $salesOrderItemBundleEntity = $this->mapSalesOrderItemBundleEntity($itemTransfer);
            $salesOrderItemBundleEntity->save();

            $bundleItemsSaved[$itemTransfer->getBundleItemIdentifier()] = $salesOrderItemBundleEntity->getIdSalesOrderItemBundle();
        }
        return $bundleItemsSaved;
    }

    /**
     * @param ItemTransfer $itemTransfer
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItemBundle
     */
    protected function mapSalesOrderItemBundleEntity(ItemTransfer $itemTransfer)
    {
        $salesOrderItemBundleEntity = new SpySalesOrderItemBundle();
        $salesOrderItemBundleEntity->fromArray($itemTransfer->toArray());
        $salesOrderItemBundleEntity->setGrossPrice($itemTransfer->getUnitGrossPrice());

        return $salesOrderItemBundleEntity;
    }

    /**
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponse
     * @param array $bundleItemsSaved
     *
     * @return void
     */
    protected function updateRelatedSalesOrderItems(CheckoutResponseTransfer $checkoutResponse, array $bundleItemsSaved)
    {
        foreach ($checkoutResponse->getSaveOrder()->getOrderItems() as $itemTransfer) {
            if (!$itemTransfer->getRelatedBundleItemIdentifier()) {
                continue;
            }

            $salesOrderItemEntity = SpySalesOrderItemQuery::create()
                ->findOneByIdSalesOrderItem($itemTransfer->getIdSalesOrderItem());

            $salesOrderItemEntity->setFkSalesOrderItemBundle($bundleItemsSaved[$itemTransfer->getRelatedBundleItemIdentifier()]);
            $salesOrderItemEntity->save();
        }
    }
}

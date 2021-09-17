<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsBlockProductStorage\Communication\Plugin\Event\Listener;

use Spryker\Zed\CmsBlockProductConnector\Dependency\CmsBlockProductConnectorEvents;
use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

/**
 * @deprecated Use {@link \Spryker\Zed\CmsBlockProductStorage\Communication\Plugin\Event\Listener\CmsBlockProductConnectorStoragePublishListener}
 *   and {@link \Spryker\Zed\CmsBlockProductStorage\Communication\Plugin\Event\Listener\CmsBlockProductConnectorStorageUnpublishListener} instead.
 *
 * @method \Spryker\Zed\CmsBlockProductStorage\Communication\CmsBlockProductStorageCommunicationFactory getFactory()
 * @method \Spryker\Zed\CmsBlockProductStorage\Persistence\CmsBlockProductStorageQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\CmsBlockProductStorage\Business\CmsBlockProductStorageFacadeInterface getFacade()
 * @method \Spryker\Zed\CmsBlockProductStorage\CmsBlockProductStorageConfig getConfig()
 */
class CmsBlockProductConnectorPublishStorageListener extends AbstractPlugin implements EventBulkHandlerInterface
{
    use DatabaseTransactionHandlerTrait;

    /**
     * @param array<\Generated\Shared\Transfer\EventEntityTransfer> $eventEntityTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName)
    {
        $this->preventTransaction();
        $idProductAbstracts = $this->getFactory()->getEventBehaviorFacade()->getEventTransferIds($eventEntityTransfers);

        if ($eventName === CmsBlockProductConnectorEvents::CMS_BLOCK_PRODUCT_CONNECTOR_UNPUBLISH) {
            $this->getFacade()->refreshOrUnpublish($idProductAbstracts);

            return;
        }

        $this->getFacade()->publish($idProductAbstracts);
    }
}

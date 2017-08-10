<?php

/**
 * Copyright © 2017-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\Shipment\Presentation;

use SprykerTest\Zed\Shipment\PageObject\ShipmentListPage;
use SprykerTest\Zed\Shipment\ShipmentPresentationTester;

/**
 * Auto-generated group annotations
 * @group SprykerTest
 * @group Zed
 * @group Shipment
 * @group Presentation
 * @group ShipmentMethodEditCest
 * Add your own group annotations below this line
 */
class ShipmentMethodEditCest
{

    /**
     * @param \SprykerTest\Zed\Shipment\ShipmentPresentationTester $i
     *
     * @return void
     */
    public function breadcrumbIsVisible(ShipmentPresentationTester $i)
    {
        $i->amOnPage(ShipmentListPage::URL);
        $i->clickDataTableEditButton();
        $i->seeBreadcrumbNavigation('Dashboard / Shipment / Shipment Methods / Edit Shipment Method');
    }

}
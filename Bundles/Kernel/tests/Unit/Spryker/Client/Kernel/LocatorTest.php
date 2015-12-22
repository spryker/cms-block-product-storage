<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\Spryker\Client\Kernel;

use Spryker\Client\Kernel\Locator;
use Spryker\Shared\Kernel\BundleProxy;

/**
 * @group Spryker
 * @group Client
 * @group Kernel
 * @group Locator
 */
class LocatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testCallShouldReturnBundleProxy()
    {
        $locator = Locator::getInstance();

        $this->assertInstanceOf(BundleProxy::class, $locator->foo());
    }

}
<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Unit\Spryker\Shared\Error\ErrorRenderer;

use Exception;
use Spryker\Shared\Error\ErrorRenderer\WebExceptionErrorRenderer;

/**
 * @group Unit
 * @group Spryker
 * @group Shared
 * @group Error
 * @group ErrorRenderer
 * @group WebErrorRendererTest
 */
class WebErrorRendererTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testRenderExceptionShouldReturnString()
    {
        $errorRenderer = new WebExceptionErrorRenderer();
        $exception = new Exception('ExceptionMessage');
        $exceptionString = $errorRenderer->render($exception);

        $this->assertInternalType('string', $exceptionString);
    }

}

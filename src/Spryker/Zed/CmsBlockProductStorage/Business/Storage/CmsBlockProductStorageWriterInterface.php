<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsBlockProductStorage\Business\Storage;

interface CmsBlockProductStorageWriterInterface
{
    /**
     * @param array<int> $productAbstractIds
     *
     * @return void
     */
    public function publish(array $productAbstractIds): void;

    /**
     * @param array<int> $productAbstractIds
     *
     * @return void
     */
    public function refreshOrUnpublish(array $productAbstractIds): void;
}

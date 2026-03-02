<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsBlockProductStorage\Business;

use Spryker\Zed\CmsBlockProductStorage\Business\CmsBlock\CmsBlockFeatureDetector;
use Spryker\Zed\CmsBlockProductStorage\Business\CmsBlock\CmsBlockFeatureDetectorInterface;
use Spryker\Zed\CmsBlockProductStorage\Business\Storage\CmsBlockProductStorageWriter;
use Spryker\Zed\CmsBlockProductStorage\Business\Storage\CmsBlockProductStorageWriterInterface;
use Spryker\Zed\CmsBlockProductStorage\CmsBlockProductStorageDependencyProvider;
use Spryker\Zed\CmsBlockProductStorage\Dependency\Service\CmsBlockProductStorageToUtilSanitizeServiceInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\CmsBlockProductStorage\CmsBlockProductStorageConfig getConfig()
 * @method \Spryker\Zed\CmsBlockProductStorage\Persistence\CmsBlockProductStorageQueryContainerInterface getQueryContainer()
 */
class CmsBlockProductStorageBusinessFactory extends AbstractBusinessFactory
{
    public function createCmsBlockProductStorageWriter(): CmsBlockProductStorageWriterInterface
    {
        return new CmsBlockProductStorageWriter(
            $this->getQueryContainer(),
            $this->getUtilSanitizeService(),
            $this->getConfig()->isSendingToQueue(),
            $this->createCmsBlockFeatureDetector(),
        );
    }

    public function getUtilSanitizeService(): CmsBlockProductStorageToUtilSanitizeServiceInterface
    {
        return $this->getProvidedDependency(CmsBlockProductStorageDependencyProvider::SERVICE_UTIL_SANITIZE);
    }

    public function createCmsBlockFeatureDetector(): CmsBlockFeatureDetectorInterface
    {
        return new CmsBlockFeatureDetector();
    }
}

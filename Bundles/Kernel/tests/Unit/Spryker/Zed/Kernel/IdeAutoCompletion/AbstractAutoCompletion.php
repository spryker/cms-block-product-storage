<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\Spryker\Zed\Kernel\IdeAutoCompletion;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

abstract class AbstractAutoCompletion extends \PHPUnit_Framework_TestCase
{

    public function __construct()
    {
        $this->baseDir = __DIR__ . '/Fixtures/';
    }

    /**
     * @return void
     */
    public function setUp()
    {
        $testDirectory = $this->baseDir . 'test';
        if (!is_dir($testDirectory)) {
            mkdir($testDirectory, 0777, true);
        }
    }

    /**
     * @return void
     */
    public function tearDown()
    {
        $this->cleanUpTestDir();
    }

    /**
     * @return void
     */
    protected function cleanUpTestDir()
    {
        if ($this->baseDir . 'test/') {
            $finder = new Finder();
            /** @var SplFileInfo $file */
            foreach ($finder->files()->in($this->baseDir . 'test/') as $file) {
                unlink($file->getPathname());
            }
            rmdir($this->baseDir . 'test/');
        }
    }

}
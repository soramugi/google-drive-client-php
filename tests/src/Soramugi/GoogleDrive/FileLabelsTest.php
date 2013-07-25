<?php

namespace Soramugi\GoogleDrive\Tests;

use Soramugi\GoogleDrive\FileLabels;
use Mockery;

class FileLabelsTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $this->fileLabels = new FileLabels;
    }

    function tearDown()
    {
        $this->fileLabels = null;
    }

    function testUseObjects()
    {
        $ref = new \ReflectionMethod(
            'Soramugi\GoogleDrive\FileLabels',
            'useObjects'
        );
        $ref->setAccessible(true);
        $this->assertTrue($ref->invoke(new FileLabels()));
    }
}

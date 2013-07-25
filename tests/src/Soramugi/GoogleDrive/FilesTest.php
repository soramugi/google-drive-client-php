<?php

namespace Soramugi\GoogleDrive\Tests;

use Soramugi\GoogleDrive\Files;
use Mockery;

class FilesTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $service = Mockery::mock('Soramugi\GoogleDrive\Service');
        $files = Mockery::mock('Soramugi\GoogleDrive\Files[getService]');
        $files->shouldReceive('getService')->andReturn($service);
        $this->files = $files;
    }

    function tearDown()
    {
        $this->files = null;
    }

    function testCall()
    {
        $client = Mockery::mock('Soramugi\GoogleDrive\Client');
        $files = new Files($client);
        $this->assertInstanceOf('Soramugi\GoogleDrive\Files', $files);
    }

    //function testListFiles()
    //{
    //    $this->assertInstanceOf(
    //        'Soramugi\GoogleDrive\FileList',
    //        $this->files->listFiles()
    //    );
    //}
}

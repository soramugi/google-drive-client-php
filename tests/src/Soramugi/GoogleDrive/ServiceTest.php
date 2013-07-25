<?php

namespace Soramugi\GoogleDrive\Tests;

use Soramugi\GoogleDrive\Service;
use Mockery;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $client = Mockery::mock('Soramugi\GoogleDrive\Client[]');
        $client->shouldReceive('setUseObjects')->with(false);
        $this->service = new Service($client);
    }

    function tearDown()
    {
        $this->service = null;
    }

    function testNew()
    {
        $this->assertInstanceOf('Soramugi\GoogleDrive\Service', $this->service);
    }

    function testGetFiles()
    {
        $this->assertInstanceOf(
            'Google_FilesServiceResource',
            $this->service->getFiles()
        );
    }
}

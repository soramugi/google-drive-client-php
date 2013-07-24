<?php

namespace Soramugi\GoogleDrive\Tests;

use Soramugi\GoogleDrive\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    function testNew()
    {
        $client = new Client;
        $this->assertInstanceOf('Soramugi\GoogleDrive\Client', $client);
    }
}

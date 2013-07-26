<?php

namespace Soramugi\GoogleDrive\Tests;

use Soramugi\GoogleDrive\File;
use Mockery;

class FileTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $this->file = new File;
    }

    function tearDown()
    {
        $this->file = null;
    }

    function testSetClient()
    {
        $client = Mockery::mock('Soramugi\GoogleDrive\Client');
        $this->assertEquals($client, $this->file->setClient($client));
    }

    function testGetFiles()
    {
        $client = Mockery::mock('Soramugi\GoogleDrive\Client');
        $this->file->setClient($client);
        $this->assertInstanceOf(
            'Soramugi\GoogleDrive\Files',
            $this->file->getFiles()
        );
    }

    function testInsert()
    {
        $file = Mockery::mock('Soramugi\GoogleDrive\File[getFiles]');
        $files = Mockery::mock('Soramugi\GoogleDrive\Files[insert]');
        $data = 'hi';
        $optParams = array(
                'data'     => $data,
                'mimeType' => ''
        );
        $files->shouldReceive('insert')
            ->with($file, $optParams)
            ->andReturn($file);
        $file->shouldReceive('getFiles')->andReturn($files);

        $this->assertEquals($file, $file->insert($data));
    }

    function testSetOptParams()
    {
        $optParams = array('hi' => 'foo');
        $this->file->setOptParams($optParams);
        $_optParams = $this->file->getOptParams();
        $this->assertEquals($optParams, $_optParams);
    }

    function testUseObjects()
    {
        $ref = new \ReflectionMethod(
            'Soramugi\GoogleDrive\File',
            'useObjects'
        );
        $ref->setAccessible(true);
        $this->assertTrue($ref->invoke(new File()));
    }

    function testIsFolder()
    {
        $this->file->setMimeType('hi');
        $this->assertFalse($this->file->isFolder());
        $this->file->setMimeType('application/vnd.google-apps.folder');
        $this->assertTrue($this->file->isFolder());
    }

    function testSetParentId()
    {
        $parentId = 'foofoofoofoofoofoofoofoofoofoo';
        $file = Mockery::mock('Soramugi\GoogleDrive\File[setParents]');
        $parent = new \Soramugi\GoogleDrive\ParentReference();
        $parent->setId($parentId);
        $file->shouldReceive('setParents')->with(array($parent));
        $this->assertNull($file->setParentId($parentId));
    }
}

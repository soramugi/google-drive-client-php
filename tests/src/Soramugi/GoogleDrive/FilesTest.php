<?php

namespace Soramugi\GoogleDrive\Tests;

use Soramugi\GoogleDrive\Files;
use Mockery;

class FilesExt extends Files
{
    public function setService($service)
    {
        $this->_service = $service;
    }
}

class FilesTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $client = Mockery::mock('Soramugi\GoogleDrive\Client');
        $files = new Files($client);
        $this->files = $files;
    }

    function tearDown()
    {
        $this->files = null;
    }

    //function testGetService()
    //{
    //    $this->assertInstanceOf(
    //        'Soramugi\GoogleDrive\Service',
    //        $this->files->getService()
    //    );
    //}

    function testNew()
    {
        $this->assertInstanceOf('Soramugi\GoogleDrive\Files', $this->files);
    }

    function testListFiles()
    {
        $method = 'listFiles';
        $_files = Mockery::mock("\Google_FilesServiceResource[$method]");
        $_files->shouldReceive($method)->andReturn(array());
        $service = Mockery::mock('Soramugi\GoogleDrive\Service[getFiles]');
        $service->shouldReceive('getFiles')->andReturn($_files);
        $files = new FilesExt('');
        $files->setService($service);

        $this->assertInstanceOf(
            'Soramugi\GoogleDrive\FileList',
            $files->listFiles()
        );
    }

    /**
     * @dataProvider callMethods
     */
    function testCallReturnFile()
    {
        $args = func_get_args();
        $method = array_shift($args);
        $_files = Mockery::mock("\Google_FilesServiceResource[$method]");
        $_files->shouldReceive($method)->andReturn(array());
        $service = Mockery::mock('Soramugi\GoogleDrive\Service[getFiles]');
        $service->shouldReceive('getFiles')->andReturn($_files);
        $files = new FilesExt('');
        $files->setService($service);

        $this->assertInstanceOf(
            'Soramugi\GoogleDrive\File',
            call_user_func_array(array($files, $method), $args)
        );
    }

    function callMethods()
    {
        $file      = Mockery::mock('Soramugi\GoogleDrive\File');
        $fileId    = 'hugehuge';
        $optParams = array();
        return array(
            array('copy', $fileId, $file, $optParams),
            array('get', $fileId, $optParams),
            array('insert', $file, $optParams),
            array('patch', $fileId, $file, $optParams),
            array('touch', $file, $optParams),
            array('trash', $file, $optParams),
            array('untrash', $file, $optParams),
            array('update', $fileId, $file, $optParams)
        );
    }


    function testSearchTitle()
    {
        $fileFoo = Mockery::mock('Soramugi\GoogleDrive\File[getTitle]');
        $fileHivarbor = clone $fileVar = clone $fileFoo;
        $fileFoo->shouldReceive('getTitle')->andReturn('foo');
        $fileVar->shouldReceive('getTitle')->andReturn('var');
        $fileHivarbor->shouldReceive('getTitle')->andReturn('hivarbor');

        $fileList = Mockery::mock('Soramugi\GoogleDrive\FileList[getItems]');
        $fileList->shouldReceive('getItems')->andReturn(
            array($fileFoo, $fileVar, $fileHivarbor)
        );

        $files = Mockery::mock('Soramugi\GoogleDrive\Files[listFiles]');
        $files->shouldReceive('listFiles')->andReturn($fileList);

        $keyword = 'neko';
        $_files = array();
        $this->assertEquals($_files, $files->searchTitle($keyword));

        $keyword = 'foo';
        $_files = array($fileFoo);
        $this->assertEquals($_files, $files->searchTitle($keyword));

        $keyword = 'var';
        $_files = array($fileVar, $fileHivarbor);
        $this->assertEquals($_files, $files->searchTitle($keyword));
    }
}

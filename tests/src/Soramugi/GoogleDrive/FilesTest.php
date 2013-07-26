<?php

namespace Soramugi\GoogleDrive\Tests;

use Soramugi\GoogleDrive\Files;
use Mockery;

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

    //function testListFiles()
    //{
    //    $this->assertInstanceOf(
    //        'Soramugi\GoogleDrive\FileList',
    //        $this->files->listFiles()
    //    );
    //}

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

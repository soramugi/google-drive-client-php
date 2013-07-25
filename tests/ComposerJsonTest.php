<?php

namespace Soramugi\GoogleDrive\Tests;

class ComposerJsonTest extends \PHPUnit_Framework_TestCase
{
    function testJson()
    {
        $json = file_get_contents(__DIR__ . '/../composer.json');
        $this->assertInstanceOf('stdClass', json_decode($json), 'not json type');
    }
}

<?php

namespace Soramugi\GoogleDrive\Tests;

use Soramugi\GoogleDrive\Spreadsheet;

class SpreadsheetTest extends \PHPUnit_Framework_TestCase
{
    function setUp()
    {
        $this->spreadsheet = new Spreadsheet;
    }

    function tearDown()
    {
        $this->spreadsheet = null;
    }

    function testNew()
    {
        $this->assertInstanceOf(
            'Soramugi\GoogleDrive\Spreadsheet', $this->spreadsheet
        );
    }

    function testSpreadsheetType()
    {
        $this->assertEquals(
            'text/csv',
            $this->spreadsheet->getMimeType()
        );
        $this->assertEquals(
            array('convert' => true),
            $this->spreadsheet->getOptParams()
        );
    }
}

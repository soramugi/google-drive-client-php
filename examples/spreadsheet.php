<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/client.php';

$file = new Soramugi\GoogleDrive\Spreadsheet();
$file->setClient($client);
$file->setTitle('test file '. time());
$file->setDescription('test description');
// folder id
//$file->setParentId($folderId);


$data = "foo,var\nhi";
$createdFile = $file->insert($data);
echo $createdFile->getTitle() . "\n";

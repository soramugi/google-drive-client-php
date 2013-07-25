<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/client.php';

$files = new Soramugi\GoogleDrive\Files($client);

$fileId = '0AjjjyR-K3-zzdG9DSWxRcUJ2RFpocEFoeVhabzVrUVE';
$file = $files->get($fileId);
echo "file : {$file->getTitle()}\n";
echo "{$file->getId()}\n";

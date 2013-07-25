<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/client.php';

$files = new Soramugi\GoogleDrive\Files($client);

foreach($files->searchTitle('新しい') as $file) {
    if ($file->isFolder()) {
        echo $file->getTitle() . "\n";
        echo $file->getMimeType() . "\n";
        echo $file->getId() . "\n";
    }
}

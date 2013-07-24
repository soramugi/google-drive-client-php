<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/client.php';

$files = new Soramugi\GoogleDrive\Files($client);

foreach ($files->listFiles()->getItems() as $item) {
    if (!$item->getLabels()->getTrashed()) {
        echo "file : {$item->getTitle()}\n";
        echo "{$item->getId()}\n";
    }
}

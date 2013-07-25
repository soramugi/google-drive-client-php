<?php

namespace Soramugi\GoogleDrive;

class Service extends \Google_DriveService
{
    public function __construct($client)
    {
        $client->setUseObjects(false);
        return parent::__construct($client);
    }

    /**
     * @return Google_FilesServiceResource
     */
    public function getFiles()
    {
        return $this->files;
    }
}

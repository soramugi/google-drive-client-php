<?php

namespace Soramugi\GoogleDrive;

class File extends \Google_DriveFile
{
    /** var Google_Client $_client */
    private $_client;

    private $_optParams = array();

    public function __construct()
    {
        foreach (func_get_args() as $arg) {
            if (get_class($arg) === 'Soramugi\GoogleDrive\Client') {
                $this->_client = $arg;
            }
        }
    }

    public function setClient($client)
    {
        return $this->_client = $client;
    }

    public function insert($data)
    {
        $files = new Files($this->_client);
        $optParams = array_merge(
            array(
                'data'     => $data,
                'mimeType' => $this->getMimeType()
            ),
            $this->getOptParams()
        );
        return $files->insert($this, $optParams);
    }

    public function getOptParams()
    {
        return $this->_optParams;
    }

    public function setOptParams(array $optParams)
    {
        return $this->_optParams = $optParams;
    }
}

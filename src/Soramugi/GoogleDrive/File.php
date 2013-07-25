<?php

namespace Soramugi\GoogleDrive;

class File extends \Google_DriveFile
{
    protected $__labelsType = 'Soramugi\GoogleDrive\FileLabels';

    /** var Google_Client $_client */
    private $_client;

    private $_optParams = array();

    public function setClient($client)
    {
        return $this->_client = $client;
    }

    public function getFiles()
    {
        return new Files($this->_client);
    }

    public function insert($data)
    {
        $files = $this->getFiles();
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

    /**
     * @param folder id $parentId
     */
    public function setParentId($parentId)
    {
        $parent = new ParentReference();
        $parent->setId($parentId);
        $this->setParents(array($parent));
    }

    public function isFolder()
    {
        return $this->getMimeType() === 'application/vnd.google-apps.folder';
    }

    protected function useObjects()
    {
        return true;
    }
}

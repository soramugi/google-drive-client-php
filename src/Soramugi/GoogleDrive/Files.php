<?php

namespace Soramugi\GoogleDrive;

class Files
{
    private $_client;
    private $_service;

    public function __construct($client)
    {
        $this->_client = $client;
    }

    public function getService()
    {
        if (!$this->_service) {
            $this->_service = new Service($this->_client);
        }
        return $this->_service;
    }

    public function __call($method, $args)
    {
        $data = call_user_func_array(
            array($this->getService()->getFiles(), $method),
            $args
        );
        $fileMethods = array(
            'copy', 'get', 'insert', 'patch',
            'touch', 'trash', 'untrash', 'update'
        );
        return in_array($method, $fileMethods)
            ? new File($data)
            : $data;
    }

    public function listFiles()
    {
        $data = $this->__call('listFiles', func_get_args());
        return new FileList($data);
    }

    public function searchTitle($keyword)
    {
        $files = array();
        foreach ($this->listFiles()->getItems() as $item) {
            if (preg_match("/$keyword/", $item->getTitle())) {
                $files[] = $item;
            }
        }
        return $files;
    }
}

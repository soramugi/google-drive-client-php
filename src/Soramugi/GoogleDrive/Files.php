<?php

namespace Soramugi\GoogleDrive;

class Files
{
    private $_service;

    public function __construct($client)
    {
        $this->_service = new Service($client);
    }

    public function __call($method, $args)
    {
        return call_user_func_array(
            array($this->_service->getFiles(), $method),
            $args
        );
    }
}

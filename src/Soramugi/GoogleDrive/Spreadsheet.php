<?php

namespace Soramugi\GoogleDrive;

class Spreadsheet extends File
{
    public function __construct()
    {
        $this->setMimeType('text/csv');
        $this->setOptParams(array('convert' => true));

        return call_user_func_array(
            array($this, 'parent::__construct'),
            func_get_args()
        );
    }
}

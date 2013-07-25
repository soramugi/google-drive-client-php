<?php


namespace Soramugi\GoogleDrive;

class FileList extends \Google_FileList
{
    protected $__itemsType = 'Soramugi\GoogleDrive\File';

    protected function useObjects()
    {
        return true;
    }
}

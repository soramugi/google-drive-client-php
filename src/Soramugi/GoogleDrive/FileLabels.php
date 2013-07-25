<?php

namespace Soramugi\GoogleDrive;

class FileLabels extends \Google_DriveFileLabels
{
    protected function useObjects()
    {
        return true;
    }
}

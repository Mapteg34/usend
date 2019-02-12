<?php

namespace App\Legacy;

class FileLogger
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function log($msg)
    {
        // write msg to $this->file
    }
}
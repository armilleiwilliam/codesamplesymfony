<?php

namespace Casa\Front2Bundle\Listener;

use Oneup\UploaderBundle\Uploader\File\FileInterface;
use Oneup\UploaderBundle\Uploader\Naming\NamerInterface;

class CatNamer implements NamerInterface
{
    
    public function name(FileInterface $file)
    {
                return $file->getClientOriginalName();
    }
}

<?php

/** @copyright Sven Ullmann <kontakt@sumedia-webdesign.de> **/namespace BricksCmf\EventizrService\Bootstrap;

use BricksCmf\EventizrService\Bootstrap\Initializer\EventizrInitializer;
use BricksFramework\Bootstrap\Module\AbstractModule;

class Module extends AbstractModule
{
    public function getInitializerClasses(): array
    {
        return [
            EventizrInitializer::class
        ];
    }
}

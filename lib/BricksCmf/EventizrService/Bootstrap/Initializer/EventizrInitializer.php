<?php

/** @copyright Sven Ullmann <kontakt@sumedia-webdesign.de> **/namespace BricksCmf\EventizrService\Bootstrap\Initializer;

use BricksCmf\EventizrService\EventizrService;
use BricksFramework\Bootstrap\BootstrapInterface;
use BricksFramework\Bootstrap\Initializer\AbstractInitializer;

class EventizrInitializer extends AbstractInitializer
{
    public function initialize(BootstrapInterface $bootstrap): void
    {
        if (in_array(EventizrService::SERVICE_NAME, $bootstrap->getServices())) {
            return;
        }

        $config = $bootstrap->getBootstrapConfig()->getModuleConfig(EventizrService::SERVICE_NAME);
        $compileDir = $config['compileDir'] ?? $bootstrap->getEnvironment()->getApplicationDirectory() .
            DIRECTORY_SEPARATOR . 'compile';
        $tempDir = $config['tempDir'] ?? $bootstrap->getEnvironment()->getApplicationDirectory() .
            DIRECTORY_SEPARATOR . 'var' . DIRECTORY_SEPARATOR . 'tmp';

        /** @var \BricksFramework\Eventizr\Eventizr $eventizrService */
        $eventizrService = $bootstrap->getInstance('BricksCmf\EventizrService\EventizrService', [
            $bootstrap->getEnvironment()->getAutoloader(),
            $compileDir,
            $tempDir
        ]);

        $eventizrService->loadClassMap();

        $bootstrap->setService(EventizrService::SERVICE_NAME, $eventizrService);
    }

    public function getPriority(): int
    {
        return -10000;
    }
}

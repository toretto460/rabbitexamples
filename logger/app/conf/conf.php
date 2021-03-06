<?php

require_once __DIR__.'/../../vendor/autoload.php';

use Symfony\Component\Console\Application;

$conf = new \Pimple\Container();

foreach (new DirectoryIterator(__DIR__) as $fileInfo) {
    if($fileInfo->getExtension() !== 'php' ) {
        continue;
    }

    require_once $fileInfo->getFilename();
}

$conf['application'] = function ($container) {
    $app = new Application();
    $app->add($container['logger.command']);

    return $app;
};

return $conf;
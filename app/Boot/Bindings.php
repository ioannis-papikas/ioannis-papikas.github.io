<?php

namespace App\Boot;

use Panda\Contracts\Bootstrap\Bootstrapper;
use Panda\Contracts\Localization\FileProcessor;
use Panda\Contracts\Storage\StorageInterface;
use Panda\Foundation\Application;
use Panda\Localization\Translation\JsonProcessor;
use Panda\Storage\Filesystem\Filesystem;
use Panda\Storage\StorageHandler;
use Panda\Ui\Contracts\Factories\DOMFactoryInterface;
use Panda\Ui\Contracts\Factories\HTMLFactoryInterface;
use Panda\Ui\Contracts\Factories\HTMLFormFactoryInterface;
use Panda\Ui\Contracts\Handlers\DOMHandlerInterface;
use Panda\Ui\Contracts\Handlers\HTMLHandlerInterface;
use Panda\Ui\Factories\DOMFactory;
use Panda\Ui\Factories\FormFactory;
use Panda\Ui\Factories\HTMLFactory;
use Panda\Ui\Handlers\DOMHandler;
use Panda\Ui\Handlers\HTMLHandler;

/**
 * Class Bindings
 *
 * @package App\Boot
 *
 * @version 0.1
 */
class Bindings implements Bootstrapper
{
    /**
     * @var Application
     */
    private $app;

    /**
     * Bindings constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Boot the bootstrapper.
     *
     * @param \Panda\Http\Request $request
     */
    public function boot($request)
    {
        // Translation file processor
        $this->app->set(FileProcessor::class, \DI\object(JsonProcessor::class));

        // Storage handler
        $this->app->set(StorageInterface::class, \DI\object(Filesystem::class));
        /** @var StorageHandler $storageHandler */
        $storageHandler = $this->app->get(StorageHandler::class);
        $directory = $storageHandler->getFilesystemBaseDirectory();
        /** @var StorageInterface $fileStorage */
        $fileStorage = $this->app->get(StorageInterface::class);
        $fileStorage->setStorageDirectory($directory);

        // HTML Engine
        // Handlers
        $this->app->set(DOMHandlerInterface::class, \DI\object(DOMHandler::class));
        $this->app->set(HTMLHandlerInterface::class, \DI\object(HTMLHandler::class));

        // Factories
        $this->app->set(DOMFactoryInterface::class, \DI\object(DOMFactory::class));
        $this->app->set(HTMLFactoryInterface::class, \DI\object(HTMLFactory::class));
        $this->app->set(HTMLFormFactoryInterface::class, \DI\object(FormFactory::class));
    }
}

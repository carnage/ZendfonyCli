<?php

namespace Carnage\ZendfonyCli\Service;

use Symfony\Component\Console\Command\Command;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

class CommandPluginManager extends AbstractPluginManager
{
    /**
     * Validate the plugin
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Command) {
            return;
        }

        throw new Exception\RuntimeException(sprintf('Invalid command %s', get_class($plugin)));
    }

}
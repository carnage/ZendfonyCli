<?php

namespace Carnage\ZendfonyCli\Service;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CliFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $commands = $serviceLocator->get('Config')['cli_commands'];
        $commandsConfig = new Config($commands);

        $commands = array_merge(
            array_keys($commandsConfig->getInvokables()),
            array_keys($commandsConfig->getServices()),
            array_keys($commandsConfig->getFactories())
        );

        $cli = new Application;
        $cli->setName('Command Line Interface');
        $cli->setVersion('1');
        $cli->setHelperSet(new HelperSet);
        $cli->setCatchExceptions(true);
        $cli->setAutoExit(false);

        $commandLocator = $serviceLocator->get(CommandPluginManager::class);

        foreach ($commands as $command) {
            $cli->add($commandLocator->get($command));
        }

        return $cli;
    }
}
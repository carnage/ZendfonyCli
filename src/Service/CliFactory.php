<?php

namespace Carnage\ZendfonyCli\Service;

use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CliFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator, $name = null, $requestedName = null)
    {
        return $this($serviceLocator, $requestedName);
    }

    public function __invoke(ContainerInterface $container, $name, $options = [])
    {
        $commands = $container->get('Config')['cli_commands'];
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

        $commandLocator = $container->get(CommandPluginManager::class);

        foreach ($commands as $command) {
            $cli->add($commandLocator->get($command));
        }

        return $cli;
    }
}
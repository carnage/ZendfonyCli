<?php

namespace Carnage\ZendfonyCli\Service;

use Interop\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Zend\ServiceManager\Factory\FactoryInterface;

class CliFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $commands = $container->get('Config')['cli_commands'];

        $commands = array_merge(
            array_keys(isset($commands['invokables']) ? $commands['invokables'] : []),
            array_keys(isset($commands['services']) ? $commands['services'] : []),
            array_keys(isset($commands['factories']) ? $commands['factories'] : [])
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
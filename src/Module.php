<?php

namespace Carnage\ZendfonyCli;

use Carnage\ZendfonyCli\Service\CliFactory;
use Carnage\ZendfonyCli\Service\CommandPluginManager;
use Carnage\ZendfonyCli\Service\CommandPluginManagerFactory;

class Module
{
    public function getConfig()
    {
        return [
            'service_manager' => [
                'factories' => [
                    CliFactory::class => CliFactory::class,
                    CommandPluginManager::class => CommandPluginManagerFactory::class
                ],
                'aliases' => [
                    'ZendfonyCli' => CliFactory::class
                ]
            ],
            'cli_commands' => []
        ];
    }
}

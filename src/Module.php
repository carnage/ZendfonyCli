<?php

namespace Carnage\ZendfonyCli;

use Carnage\ZendfonyCli\Service\CliFactory;

class Module
{
    public function getConfig()
    {
        return [
            'service_manager' => [
                'factories' => [
                    CliFactory::class => CliFactory::class
                ],
                'aliases' => [
                    'ZendfonyCli' => CliFactory::class
                ]
            ],
            'cli_commands' => []
        ];
    }
}

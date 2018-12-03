<?php

namespace Carnage\ZendfonyCli\Service;

use Symfony\Component\Console\Command\Command;
use Zend\ServiceManager\AbstractPluginManager;

class CommandPluginManager extends AbstractPluginManager
{
    protected $instanceOf = Command::class;
}
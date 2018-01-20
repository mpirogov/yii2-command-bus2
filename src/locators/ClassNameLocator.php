<?php

namespace mpirogov\bus\locators;

use mpirogov\bus\interfaces\Handler;
use mpirogov\bus\interfaces\HandlerLocator;
use yii\base\Object;
use yii\di\Instance;

/**
 * Class ClassNameLocator
 *
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ClassNameLocator extends Object implements HandlerLocator
{
    /**
     * @var
     */
    public $handlers;

    /**
     * @param $command
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     * @internal param CommandBus $commandBus
     */
    public function locate($command)
    {
        $className = get_class($command);

        if (array_key_exists($className, $this->handlers)) {
            return Instance::ensure($this->handlers[$className], Handler::class);
        }

        return false;
    }

    /**
     * @param Handler $handler
     * @param $className
     */
    public function addHandler(Handler $handler, $className)
    {
        $this->handlers[$className] = $handler;
    }
}

<?php

declare(strict_types=1);

namespace Handlr\Core;

use Handlr\Core\Exceptions\ContainerException;
use ReflectionClass;
use ReflectionException;
use ReflectionParameter;

class Container
{
    private array $bindings = [];

    public function set(string $abstract, callable $factory): void
    {
        $this->bindings[$abstract] = $factory;
    }

    public function get(string $abstract)
    {
        if (isset($this->bindings[$abstract])) {
            return $this->bindings[$abstract]($this);
        }

        return $this->resolve($abstract);
    }

    /**
     * @throws ReflectionException
     */
    private function resolve(string $class)
    {
        $reflector = new ReflectionClass($class);
        $constructor = $reflector->getConstructor();

        if (!$constructor) {
            return new $class();
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);

        return $reflector->newInstanceArgs($dependencies);
    }

    private function getDependencies(array $parameters): array
    {
        return array_map(function ($param) {
            /** @var ReflectionParameter $type */
            $type = $param->getType();
            $abstract = $type?->getName();

            if ($type && $type->isBuiltin()) {
                if ($param->isDefaultValueAvailable()) {
                    return $param->getDefaultValue();
                }
                throw new ContainerException(
                    "Cannot resolve parameter: {$param->getName()} of built-in type `$abstract`."
                    . ' Please ensure it has a default value.'
                );
            }

            // Resolve class-based dependencies through the container
            return $this->get($abstract);
        }, $parameters);
    }
}

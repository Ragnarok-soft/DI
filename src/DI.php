<?php

namespace Ragnarok;

/**
 * Class DI
 *
 * @package Ragnarok
 */
class DI
{
    private $dependencies;

    public function __get($name): ?object
    {
        return $this->get($name);
    }

    public function __set(string $name, object $object): object
    {
        return $this->inject($name, $object);
    }

    public function has(string $name): bool
    {
        return isset($this->dependencies[$name]);
    }

    public function inject(string $name, object $object): object
    {
        if (!$this->has($name)) {
            $this->dependencies[$name] = $object;
        }

        return $this->dependencies[$name];
    }

    public function get(string $name): ?object
    {
        if ($this->has($name)) {
            return $this->dependencies[$name];
        }

        return null;
    }

    public function all(): ?array
    {
        return $this->dependencies;
    }
}
<?php


namespace Ragnarok;


class DI
{
    private $collection;

    public function __get($name): ?object
    {
        return $this->get($name);
    }

    public function __set(string $name, object $object): object
    {
        return $this->inject($name, $object);
    }

    public function inject(string $name, object $object): object
    {
        if (!isset($this->collection[$name])) {
            $this->collection[$name] = $object;
        }

        return $this->collection[$name];

    }

    public function get(string $name): ?object
    {
        if (isset($this->collection[$name])) {
            return $this->collection[$name];
        }

        return null;
    }
}
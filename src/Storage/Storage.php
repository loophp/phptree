<?php

declare(strict_types=1);

namespace drupol\phptree\Storage;

use ArrayAccess;
use ArrayObject;
use InvalidArgumentException;

/**
 * Class Storage.
 *
 * @internal
 *
 * @implements ArrayAccess<string, mixed>
 */
abstract class Storage implements ArrayAccess, StorageInterface
{
    /**
     * @var ArrayObject<string, mixed>
     */
    private $storage;

    /**
     * Storage constructor.
     */
    public function __construct()
    {
        $this->storage = new ArrayObject();
    }

    /**
     * {@inheritdoc}
     */
    public function __clone()
    {
        $this->storage = clone $this->storage;

        $children = new ArrayObject();

        foreach ($this->get('children') as $key => $child) {
            $children[] = clone $child;
        }
        $this->set('children', $children);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        if (!$this->offsetExists($key)) {
            throw new InvalidArgumentException('Invalid key ' . $key . '.');
        }

        return $this->offsetGet($key);
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->storage->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->storage->offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->storage->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->storage->offsetUnset($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $value): StorageInterface
    {
        $this->offsetSet($key, $value);

        return $this;
    }
}

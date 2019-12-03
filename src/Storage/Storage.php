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
 */
abstract class Storage implements ArrayAccess, StorageInterface
{
    /**
     * @var ArrayObject
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
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->storage->offsetExists($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->storage->offsetGet($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value): void
    {
        $this->storage->offsetSet($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset): void
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

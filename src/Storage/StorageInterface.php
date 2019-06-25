<?php

declare(strict_types = 1);

namespace drupol\phptree\Storage;

/**
 * Interface StorageInterface.
 */
interface StorageInterface
{
    /**
     * Get a value.
     *
     * @param string $key
     *   The identifier name of the value.
     *
     * @return null|int|mixed|string
     *   The value.
     */
    public function get($key);

    /**
     * Store a value.
     *
     * @param string $key
     *   The identifier name of the value.
     * @param mixed $value
     *   The value.
     *
     * @return StorageInterface
     */
    public function set($key, $value): StorageInterface;
}

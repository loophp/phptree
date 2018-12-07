<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Interface KeyValueNodeInterface
 */
interface KeyValueNodeInterface extends ValueNodeInterface
{
    /**
     * Get the node key.
     *
     * @return string|mixed|int|null
     *   The key value.
     */
    public function getKey();
}

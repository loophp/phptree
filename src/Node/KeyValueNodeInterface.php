<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

/**
 * Interface KeyValueNodeInterface.
 */
interface KeyValueNodeInterface extends ValueNodeInterface
{
    /**
     * Get the key property.
     *
     * @return int|mixed|string|null
     *   The key property
     */
    public function getKey();
}

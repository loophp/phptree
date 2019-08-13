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
     * @return null|int|mixed|string
     *   The key property
     */
    public function getKey();
}

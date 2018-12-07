<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Interface ValueNodeInterface
 */
interface ValueNodeInterface extends NodeInterface
{
    /**
     * Get the node value.
     *
     * @return string|mixed|null
     *   The node value.
     */
    public function getValue();
}

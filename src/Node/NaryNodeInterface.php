<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Interface NaryNodeInterface
 */
interface NaryNodeInterface
{
    /**
     * Get the node capacity.
     *
     * @return int
     *   The node capacity.
     */
    public function capacity(): int;
}

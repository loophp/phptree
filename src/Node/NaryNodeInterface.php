<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

use drupol\phptree\Traverser\TraverserInterface;

/**
 * Interface NaryNodeInterface.
 */
interface NaryNodeInterface extends NodeInterface
{
    /**
     * Get the node capacity.
     *
     * @return null|int
     *   The node capacity or null if no children is allowed.
     */
    public function capacity(): ?int;

    /**
     * Get the traverser in use.
     *
     * @return \drupol\phptree\Traverser\TraverserInterface
     *   The traverser
     */
    public function getTraverser(): TraverserInterface;
}

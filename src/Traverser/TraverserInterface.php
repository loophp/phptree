<?php

declare(strict_types = 1);

namespace drupol\phptree\Traverser;

use drupol\phptree\Node\NodeInterface;

/**
 * Interface TraverserInterface.
 */
interface TraverserInterface
{
    /**
     * Traverse the tree.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node
     *
     * @return \Generator|NodeInterface[]|\Traversable
     */
    public function traverse(NodeInterface $node): \Traversable;
}

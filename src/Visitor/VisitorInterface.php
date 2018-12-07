<?php

namespace drupol\phptree\Visitor;

use drupol\phptree\Node\NodeInterface;

/**
 * Interface VisitorInterface
 */
interface VisitorInterface
{
    /**
     * Traverse the tree.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node.
     *
     * @return \Traversable
     */
    public function traverse(NodeInterface $node): \Traversable;
}

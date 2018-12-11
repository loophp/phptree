<?php

declare(strict_types = 1);

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
     * @param int|null $level
     *   The level.
     *
     * @return \Traversable
     */
    public function traverse(NodeInterface $node, int $level = null): \Traversable;
}

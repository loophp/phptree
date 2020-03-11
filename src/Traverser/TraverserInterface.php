<?php

declare(strict_types=1);

namespace loophp\phptree\Traverser;

use Generator;
use loophp\phptree\Node\NodeInterface;
use Traversable;

/**
 * Interface TraverserInterface.
 */
interface TraverserInterface
{
    /**
     * Traverse the tree.
     *
     * @param NodeInterface $node
     *   The node
     *
     * @return Generator|Traversable<NodeInterface>
     */
    public function traverse(NodeInterface $node): Traversable;
}

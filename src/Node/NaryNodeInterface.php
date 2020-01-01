<?php

declare(strict_types=1);

namespace loophp\phptree\Node;

use loophp\phptree\Traverser\TraverserInterface;

/**
 * Interface NaryNodeInterface.
 */
interface NaryNodeInterface extends NodeInterface
{
    /**
     * Get the node capacity.
     *
     * @return int|null
     *   The node capacity or null if no children is allowed.
     */
    public function capacity(): ?int;

    /**
     * Get the traverser in use.
     *
     * @return \loophp\phptree\Traverser\TraverserInterface
     *   The traverser
     */
    public function getTraverser(): TraverserInterface;
}

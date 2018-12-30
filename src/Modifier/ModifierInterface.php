<?php

declare(strict_types = 1);

namespace drupol\phptree\Modifier;

use drupol\phptree\Node\NodeInterface;

/**
 * Interface ModifierInterface
 */
interface ModifierInterface
{
    /**
     * Modify the tree.
     *
     * @param NodeInterface $tree
     *   The original tree.
     *
     * @return NodeInterface
     *   A new tree.
     */
    public function modify(NodeInterface $tree): NodeInterface;
}

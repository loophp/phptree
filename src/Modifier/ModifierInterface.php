<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\MerkleNodeInterface;
use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Node\ValueNodeInterface;

/**
 * Interface ModifierInterface.
 */
interface ModifierInterface
{
    /**
     * Modify the tree.
     *
     * @param NodeInterface $tree
     *   The original tree.
     *
     * @return AttributeNodeInterface|MerkleNodeInterface|NodeInterface|ValueNodeInterface
     *   A new tree.
     */
    public function modify(NodeInterface $tree): NodeInterface;
}

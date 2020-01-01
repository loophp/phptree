<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;

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
     * @return \loophp\phptree\Node\AttributeNodeInterface|\loophp\phptree\Node\MerkleNodeInterface|\loophp\phptree\Node\ValueNodeInterface|NodeInterface
     *   A new tree.
     */
    public function modify(NodeInterface $tree): NodeInterface;
}

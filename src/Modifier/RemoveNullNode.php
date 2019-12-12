<?php

declare(strict_types=1);

namespace drupol\phptree\Modifier;

use drupol\phptree\Node\NodeInterface;

/**
 * Class RemoveNullNode.
 */
class RemoveNullNode implements ModifierInterface
{
    /**
     * {@inheritdoc}
     */
    public function modify(NodeInterface $tree): NodeInterface
    {
        /** @var \drupol\phptree\Node\MerkleNode $item */
        foreach ($tree->all() as $item) {
            if (null === $parent = $item->getParent()) {
                continue;
            }

            if (true !== $item->isLeaf()) {
                continue;
            }

            if (null !== $item->getValue()) {
                continue;
            }

            $parent->remove($item);
        }

        return $tree;
    }
}

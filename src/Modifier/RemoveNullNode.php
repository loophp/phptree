<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;

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
        /** @var \loophp\phptree\Node\MerkleNode $item */
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
            $this->modify($parent);
        }

        return $tree;
    }
}

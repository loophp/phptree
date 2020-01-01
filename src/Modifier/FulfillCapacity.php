<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;

/**
 * Class FulfillCapacity.
 */
class FulfillCapacity implements ModifierInterface
{
    /**
     * {@inheritdoc}
     */
    public function modify(NodeInterface $tree): NodeInterface
    {
        /** @var \loophp\phptree\Node\MerkleNode $item */
        foreach ($tree->all() as $item) {
            $capacity = $item->capacity();

            if (false === $item->isLeaf()) {
                $children = iterator_to_array($item->children());

                while ($item->degree() !== $capacity) {
                    $item->add(current($children)->clone());
                }
            }
        }

        return $tree;
    }
}

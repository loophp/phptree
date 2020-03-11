<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NaryNodeInterface;
use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Traverser\PostOrder;
use loophp\phptree\Traverser\PreOrder;
use loophp\phptree\Traverser\TraverserInterface;

/**
 * Class FulfillCapacity.
 */
class FulfillCapacity implements ModifierInterface
{
    /**
     * @var PreOrder|TraverserInterface
     */
    private $traverser;

    /**
     * FulfillCapacity constructor.
     *
     * @param TraverserInterface|null $traverser
     */
    public function __construct(?TraverserInterface $traverser = null)
    {
        $this->traverser = $traverser ?? new PostOrder();
    }

    /**
     * {@inheritdoc}
     */
    public function modify(NodeInterface $tree): NodeInterface
    {
        /** @var NaryNodeInterface $item */
        foreach ($this->traverser->traverse($tree) as $item) {
            $capacity = $item->capacity();

            if (!$item->isLeaf()) {
                $children = iterator_to_array($item->children());

                while ($item->degree() !== $capacity) {
                    $item->add(current($children)->clone());
                }
            }
        }

        return $tree;
    }
}

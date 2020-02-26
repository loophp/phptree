<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Traverser\PostOrder;
use loophp\phptree\Traverser\TraverserInterface;

/**
 * Class FulfillCapacity.
 */
class FulfillCapacity implements ModifierInterface
{
    /**
     * @var \loophp\phptree\Traverser\PreOrder|\loophp\phptree\Traverser\TraverserInterface
     */
    private $traverser;

    /**
     * FulfillCapacity constructor.
     *
     * @param \loophp\phptree\Traverser\TraverserInterface|null $traverser
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
        /** @var \loophp\phptree\Node\NaryNodeInterface $item */
        foreach ($this->traverser->traverse($tree) as $item) {
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

<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Traverser\PostOrder;
use loophp\phptree\Traverser\TraverserInterface;

/**
 * Class RemoveNullNode.
 */
class RemoveNullNode implements ModifierInterface
{
    /**
     * @var \loophp\phptree\Traverser\PreOrder|\loophp\phptree\Traverser\TraverserInterface
     */
    private $traverser;

    /**
     * RemoveNullNode constructor.
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
        /** @var \loophp\phptree\Node\ValueNodeInterface $item */
        foreach ($this->traverser->traverse($tree) as $item) {
            if (null === $parent = $item->getParent()) {
                continue;
            }

            if (false === $item->isLeaf()) {
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

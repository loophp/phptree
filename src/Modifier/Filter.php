<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Traverser\PostOrder;
use loophp\phptree\Traverser\TraverserInterface;

/**
 * Class Filter.
 */
class Filter implements ModifierInterface
{
    /**
     * @var callable
     */
    private $filter;

    /**
     * @var \loophp\phptree\Traverser\PreOrder|\loophp\phptree\Traverser\TraverserInterface
     */
    private $traverser;

    /**
     * Filter constructor.
     *
     * @param callable $filter
     * @param \loophp\phptree\Traverser\TraverserInterface|null $traverser
     */
    public function __construct(callable $filter, ?TraverserInterface $traverser = null)
    {
        $this->filter = $filter;
        $this->traverser = $traverser ?? new PostOrder();
    }

    /**
     * {@inheritdoc}
     */
    public function modify(NodeInterface $tree): NodeInterface
    {
        foreach ($this->traverser->traverse($tree) as $item) {
            if (null === $parent = $item->getParent()) {
                continue;
            }

            if (false === (bool) ($this->filter)($item)) {
                continue;
            }

            $parent->remove($item);
        }

        return $tree;
    }
}

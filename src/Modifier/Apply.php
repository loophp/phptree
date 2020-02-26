<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Traverser\PostOrder;
use loophp\phptree\Traverser\TraverserInterface;

/**
 * Class Apply.
 */
class Apply implements ModifierInterface
{
    /**
     * @var callable
     */
    private $apply;

    /**
     * @var \loophp\phptree\Traverser\TraverserInterface|null
     */
    private $traverser;

    /**
     * Apply constructor.
     *
     * @param callable $apply
     * @param \loophp\phptree\Traverser\TraverserInterface|null $traverser
     */
    public function __construct(callable $apply, ?TraverserInterface $traverser = null)
    {
        $this->apply = $apply;
        $this->traverser = $traverser ?? new PostOrder();
    }

    /**
     * {@inheritdoc}
     */
    public function modify(NodeInterface $tree): NodeInterface
    {
        foreach ($this->traverser->traverse($tree) as $item) {
            ($this->apply)($item);
        }

        return $tree;
    }
}

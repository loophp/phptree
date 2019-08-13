<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

use drupol\phptree\Traverser\TraverserInterface;

/**
 * Class ValueNode.
 */
class ValueNode extends NaryNode implements ValueNodeInterface
{
    /**
     * ValueNode constructor.
     *
     * @param null|mixed $value
     * @param null|int $capacity
     * @param null|\drupol\phptree\Traverser\TraverserInterface $traverser
     * @param null|\drupol\phptree\Node\NodeInterface $parent
     */
    public function __construct(
        $value,
        ?int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($capacity, $traverser, $parent);

        $this->storage()->set('value', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->storage()->get('value');
    }
}

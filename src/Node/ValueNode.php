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
     * @var mixed
     */
    private $value;

    /**
     * ValueNode constructor.
     *
     * @param mixed|null $value
     * @param int|null $capacity
     * @param \drupol\phptree\Traverser\TraverserInterface|null $traverser
     * @param \drupol\phptree\Node\NodeInterface|null $parent
     */
    public function __construct(
        $value,
        ?int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($capacity, $traverser, $parent);

        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function label(): string
    {
        return (string) $this->getValue();
    }
}

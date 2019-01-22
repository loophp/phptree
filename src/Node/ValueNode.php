<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class ValueNode.
 */
class ValueNode extends NaryNode implements ValueNodeInterface
{
    /**
     * The value property.
     *
     * @var null|mixed|string
     */
    private $value;

    /**
     * ValueNode constructor.
     *
     * @param null|mixed $value
     * @param int $capacity
     * @param null|\drupol\phptree\Node\NodeInterface $parent
     */
    public function __construct($value = null, int $capacity = 0, NodeInterface $parent = null)
    {
        parent::__construct($capacity, $parent);

        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }
}

<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class ValueNode.
 */
class ValueNode extends NaryNode implements ValueNodeInterface
{
    /**
     * ValueNode constructor.
     *
     * @param null|mixed $value
     * @param int $capacity
     * @param null|\drupol\phptree\Node\NodeInterface $parent
     */
    public function __construct($value, int $capacity = 0, NodeInterface $parent = null)
    {
        parent::__construct($capacity, $parent);

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

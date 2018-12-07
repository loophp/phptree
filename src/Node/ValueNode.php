<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class ValueNode
 */
class ValueNode extends Node implements ValueNodeInterface
{
    /**
     * @var string|mixed|null
     */
    private $value;

    /**
     * KeyValueNode constructor.
     *
     * @param mixed|null $value
     * @param \drupol\phptree\Node\NodeInterface|NULL $parent
     */
    public function __construct($value = null, NodeInterface $parent = null)
    {
        parent::__construct($parent);

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

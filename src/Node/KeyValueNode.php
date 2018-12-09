<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class KeyValueNode
 */
class KeyValueNode extends ValueNode implements KeyValueNodeInterface
{
    /**
     * The key property.
     *
     * @var string|mixed|int|null
     */
    private $key;

    /**
     * KeyValueNode constructor.
     *
     * @param mixed|null $key
     * @param mixed|null $value
     * @param int $capacity
     * @param \drupol\phptree\Node\NodeInterface|NULL $parent
     */
    public function __construct($key = null, $value = null, int $capacity = 0, NodeInterface $parent = null)
    {
        parent::__construct($value, $capacity, $parent);

        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return $this->key;
    }
}

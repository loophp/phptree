<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class KeyValueNode.
 */
class KeyValueNode extends ValueNode implements KeyValueNodeInterface
{
    /**
     * The key property.
     *
     * @var null|int|mixed|string
     */
    private $key;

    /**
     * KeyValueNode constructor.
     *
     * @param null|mixed $key
     * @param null|mixed $value
     * @param int $capacity
     * @param null|\drupol\phptree\Node\NodeInterface $parent
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

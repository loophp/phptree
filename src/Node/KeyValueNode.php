<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class KeyValueNode.
 */
class KeyValueNode extends ValueNode implements KeyValueNodeInterface
{
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

        $this->storage()->set('key', $key);
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return $this->storage()->get('key');
    }
}

<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class Node
 */
class KeyValueNode extends ValueNode implements KeyValueNodeInterface
{
    /**
     * @var mixed|null
     */
    private $key;

    /**
     * KeyValueNode constructor.
     *
     * @param mixed|null $key
     * @param mixed|null $value
     * @param \drupol\phptree\Node\NodeInterface|NULL $parent
     */
    public function __construct($key = null, $value = null, NodeInterface $parent = null)
    {
        parent::__construct($value, $parent);

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

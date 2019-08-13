<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

use drupol\phptree\Traverser\TraverserInterface;

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
     * @param null|int $capacity
     * @param null|\drupol\phptree\Traverser\TraverserInterface $traverser
     * @param null|\drupol\phptree\Node\NodeInterface $parent
     */
    public function __construct(
        $key,
        $value,
        ?int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($value, $capacity, $traverser, $parent);

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

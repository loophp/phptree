<?php

declare(strict_types=1);

namespace loophp\phptree\Node;

use loophp\phptree\Traverser\TraverserInterface;

/**
 * Class KeyValueNode.
 */
class KeyValueNode extends ValueNode implements KeyValueNodeInterface
{
    /**
     * @var mixed
     */
    private $key;

    /**
     * KeyValueNode constructor.
     *
     * @param mixed|null $key
     * @param mixed|null $value
     * @param int|null $capacity
     * @param \loophp\phptree\Traverser\TraverserInterface|null $traverser
     * @param \loophp\phptree\Node\NodeInterface|null $parent
     */
    public function __construct(
        $key,
        $value,
        ?int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($value, $capacity, $traverser, $parent);

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

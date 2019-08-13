<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

use drupol\phptree\Traverser\TraverserInterface;

/**
 * Class AttributeNode.
 */
class AttributeNode extends NaryNode implements AttributeNodeInterface
{
    /**
     * ValueNode constructor.
     *
     * @param array $attributes
     * @param null|int $capacity
     * @param null|\drupol\phptree\Traverser\TraverserInterface $traverser
     * @param null|\drupol\phptree\Node\NodeInterface $parent
     */
    public function __construct(
        array $attributes = [],
        ?int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($capacity, $traverser, $parent);

        $this->storage()->set('attributes', new \ArrayObject($attributes));
    }

    /**
     * {@inheritdoc}
     */
    public function getAttribute(string $key)
    {
        return $this->getAttributes()[$key] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes(): \Traversable
    {
        return $this->storage()->get('attributes');
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute(string $key, $value): AttributeNodeInterface
    {
        $this->getAttributes()[$key] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributes(\Traversable $attributes): AttributeNodeInterface
    {
        $this->storage()->set('attributes', $attributes);

        return $this;
    }
}

<?php

declare(strict_types=1);

namespace loophp\phptree\Node;

use loophp\phptree\Traverser\TraverserInterface;

/**
 * Class AttributeNode.
 */
class AttributeNode extends NaryNode implements AttributeNodeInterface
{
    /**
     * @var array
     */
    private $attributes;

    /**
     * ValueNode constructor.
     *
     * @param array<int|string, mixed> $attributes
     * @param int|null $capacity
     * @param \loophp\phptree\Traverser\TraverserInterface|null $traverser
     * @param \loophp\phptree\Node\NodeInterface|null $parent
     */
    public function __construct(
        array $attributes = [],
        ?int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($capacity, $traverser, $parent);

        $this->attributes = $attributes;
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
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function label(): string
    {
        return (string) $this->getAttribute('label');
    }

    /**
     * {@inheritdoc}
     */
    public function setAttribute(string $key, $value): AttributeNodeInterface
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributes(array $attributes): AttributeNodeInterface
    {
        $this->attributes = $attributes;

        return $this;
    }
}

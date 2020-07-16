<?php

declare(strict_types=1);

namespace loophp\phptree\Node;

use loophp\phptree\Traverser\TraverserInterface;

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
     */
    public function __construct(
        array $attributes = [],
        int $capacity = 0,
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

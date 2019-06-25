<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Interface AttributeNodeInterface.
 */
interface AttributeNodeInterface extends NaryNodeInterface
{
    /**
     * {@inheritdoc}
     */
    public function getAttribute($key);

    /**
     * {@inheritdoc}
     */
    public function getAttributes(): \Traversable;

    /**
     * {@inheritdoc}
     */
    public function setAttribute(string $key, $value): AttributeNodeInterface;

    /**
     * {@inheritdoc}
     */
    public function setAttributes(\Traversable $attributes): AttributeNodeInterface;
}

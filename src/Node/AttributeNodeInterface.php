<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

/**
 * Interface AttributeNodeInterface.
 */
interface AttributeNodeInterface extends NaryNodeInterface
{
    /**
     * Get an attribute.
     *
     * @param string $key
     *
     * @return mixed
     *   The value of the attribute.
     */
    public function getAttribute(string $key);

    /**
     * Get the attributes.
     *
     * @return array<int|string, mixed>
     *   The attributes.
     */
    public function getAttributes(): array;

    /**
     * Set an attribute.
     *
     * @param string $key
     *   The attribute key.
     * @param mixed $value
     *   The attribute value.
     *
     * @return \drupol\phptree\Node\AttributeNodeInterface
     *   The node.
     */
    public function setAttribute(string $key, $value): AttributeNodeInterface;

    /**
     * Set the attributes.
     *
     * @param array<int|string, mixed> $attributes
     *   The attributes.
     *
     * @return \drupol\phptree\Node\AttributeNodeInterface
     *   The node.
     */
    public function setAttributes(array $attributes): AttributeNodeInterface;
}

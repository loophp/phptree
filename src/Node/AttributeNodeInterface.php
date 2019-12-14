<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

use Traversable;

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
     * @return Traversable<int|string, mixed>
     *   The attributes.
     */
    public function getAttributes(): Traversable;

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
     * @param Traversable<int|string, mixed> $attributes
     *   The attributes.
     *
     * @return \drupol\phptree\Node\AttributeNodeInterface
     *   The node.
     */
    public function setAttributes(Traversable $attributes): AttributeNodeInterface;
}

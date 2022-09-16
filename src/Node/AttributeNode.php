<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Node;

use loophp\phptree\Traverser\TraverserInterface;

class AttributeNode extends NaryNode implements AttributeNodeInterface
{
    /**
     * @var array<array-key, mixed>
     */
    private array $attributes;

    public function __construct(
        array $attributes = [],
        int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($capacity, $traverser, $parent);

        $this->attributes = $attributes;
    }

    public function getAttribute(string $key)
    {
        return $this->getAttributes()[$key] ?? null;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function label(): string
    {
        return (string) $this->getAttribute('label');
    }

    public function setAttribute(string $key, $value): AttributeNodeInterface
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function setAttributes(array $attributes): AttributeNodeInterface
    {
        $this->attributes = $attributes;

        return $this;
    }
}

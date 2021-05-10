<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Node;

use loophp\phptree\Traverser\TraverserInterface;

/**
 * Class ValueNode.
 */
class ValueNode extends NaryNode implements ValueNodeInterface
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * ValueNode constructor.
     *
     * @param mixed|null $value
     */
    public function __construct(
        $value,
        int $capacity = 0,
        ?TraverserInterface $traverser = null,
        ?NodeInterface $parent = null
    ) {
        parent::__construct($capacity, $traverser, $parent);

        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function label(): string
    {
        return (string) $this->getValue();
    }
}

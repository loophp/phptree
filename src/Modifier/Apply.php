<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Traverser\PostOrder;
use loophp\phptree\Traverser\TraverserInterface;

class Apply implements ModifierInterface
{
    /**
     * @var callable
     */
    private $apply;

    /**
     * @var TraverserInterface
     */
    private $traverser;

    /**
     * Apply constructor.
     */
    public function __construct(callable $apply, ?TraverserInterface $traverser = null)
    {
        $this->apply = $apply;
        $this->traverser = $traverser ?? new PostOrder();
    }

    public function modify(NodeInterface $tree): NodeInterface
    {
        foreach ($this->traverser->traverse($tree) as $item) {
            ($this->apply)($item);
        }

        return $tree;
    }
}

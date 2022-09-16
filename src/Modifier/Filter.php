<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Traverser\PostOrder;
use loophp\phptree\Traverser\PreOrder;
use loophp\phptree\Traverser\TraverserInterface;

class Filter implements ModifierInterface
{
    /**
     * @var callable
     */
    private $filter;

    /**
     * @var PreOrder|TraverserInterface
     */
    private $traverser;

    /**
     * Filter constructor.
     */
    public function __construct(callable $filter, ?TraverserInterface $traverser = null)
    {
        $this->filter = $filter;
        $this->traverser = $traverser ?? new PostOrder();
    }

    public function modify(NodeInterface $tree): NodeInterface
    {
        foreach ($this->traverser->traverse($tree) as $item) {
            if (null === $parent = $item->getParent()) {
                continue;
            }

            if (!(bool) ($this->filter)($item)) {
                continue;
            }

            $parent->remove($item);
        }

        return $tree;
    }
}

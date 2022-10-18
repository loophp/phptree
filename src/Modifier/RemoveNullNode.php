<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Node\ValueNodeInterface;
use loophp\phptree\Traverser\PostOrder;
use loophp\phptree\Traverser\PreOrder;
use loophp\phptree\Traverser\TraverserInterface;

class RemoveNullNode implements ModifierInterface
{
    /**
     * @var PreOrder|TraverserInterface
     */
    private $traverser;

    public function __construct(?TraverserInterface $traverser = null)
    {
        $this->traverser = $traverser ?? new PostOrder();
    }

    public function modify(NodeInterface $tree): NodeInterface
    {
        /** @var ValueNodeInterface $item */
        foreach ($this->traverser->traverse($tree) as $item) {
            if (null === $parent = $item->getParent()) {
                continue;
            }

            if (!$item->isLeaf()) {
                continue;
            }

            if (null !== $item->getValue()) {
                continue;
            }

            $parent->remove($item);
        }

        return $tree;
    }
}

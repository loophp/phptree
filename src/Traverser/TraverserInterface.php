<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Traverser;

use Generator;
use loophp\phptree\Node\NodeInterface;
use Traversable;

/**
 * Interface TraverserInterface.
 */
interface TraverserInterface
{
    /**
     * Traverse the tree.
     *
     * @param NodeInterface $node
     *   The node
     *
     * @return Generator|Traversable<NodeInterface>
     */
    public function traverse(NodeInterface $node): Traversable;
}

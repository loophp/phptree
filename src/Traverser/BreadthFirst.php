<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Traverser;

use loophp\phptree\Node\NodeInterface;
use SplQueue;
use Traversable;

class BreadthFirst implements TraverserInterface
{
    public function traverse(NodeInterface $node): Traversable
    {
        $queue = new SplQueue();
        $queue->enqueue($node);

        yield $node;

        while (0 < $queue->count()) {
            foreach ($queue->dequeue()->children() as $child) {
                $queue->enqueue($child);

                yield $child;
            }
        }
    }
}

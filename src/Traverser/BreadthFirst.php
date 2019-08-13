<?php

declare(strict_types=1);

namespace drupol\phptree\Traverser;

use drupol\phptree\Node\NodeInterface;

/**
 * Class BreadthFirst.
 */
class BreadthFirst implements TraverserInterface
{
    /**
     * {@inheritdoc}
     */
    public function traverse(NodeInterface $node): \Traversable
    {
        $queue = new \SplQueue();
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

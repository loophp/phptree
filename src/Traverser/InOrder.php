<?php

declare(strict_types = 1);

namespace drupol\phptree\Traverser;

use drupol\phptree\Node\NodeInterface;

/**
 * Class InOrder
 */
class InOrder implements TraverserInterface
{
    /**
     * @var int
     */
    private $index = 0;

    /**
     * {@inheritdoc}
     */
    public function traverse(NodeInterface $node): \Traversable
    {
        $this->index = 0;

        return $this->doTraverse($node);
    }

    /**
     * {@inheritdoc}
     */
    private function doTraverse(NodeInterface $node): \Traversable
    {
        foreach ($node->children() as $child) {
            if ($node->lastChild() === $child) {
                yield $this->index => $node;
                $this->index++;
            }

            if ($child->isLeaf()) {
                yield $this->index => $child;
                $this->index++;
            }

            yield from $this->doTraverse($child);
        }
    }
}

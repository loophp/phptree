<?php

declare(strict_types = 1);

namespace drupol\phptree\Traverser;

use drupol\phptree\Node\NodeInterface;

/**
 * Class PreOrder
 */
class PreOrder implements TraverserInterface
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
        yield $this->index => $node;

        foreach ($node->children() as $child) {
            $this->index++;
            yield from $this->doTraverse($child);
        }
    }
}

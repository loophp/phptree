<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

/**
 * Class ABNode.
 *
 * An auto-balanced node.
 */
class ABNode extends NaryNode
{
    /**
     * {@inheritdoc}
     */
    public function add(NodeInterface ...$nodes): NodeInterface
    {
        foreach ($nodes as $node) {
            if (0 === $this->count()) {
                parent::add($node);

                continue;
            }

            $count = [];

            foreach ($this->children() as $child) {
                $count[$child->count()] = $child;
            }

            $keys = array_keys($count);
            $keys[] = 0;

            if (min($keys) === max($keys)) {
                parent::add($node);

                continue;
            }

            ksort($count);

            $child = array_shift($count);
            $child->add($node);
        }

        return $this;
    }
}

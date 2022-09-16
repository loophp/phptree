<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Node;

class ABNode extends NaryNode
{
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

            if (null !== $child = array_shift($count)) {
                $child->add($node);
            }
        }

        return $this;
    }
}

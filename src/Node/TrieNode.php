<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Node;

use Exception;

class TrieNode extends ValueNode
{
    /**
     * @param ValueNodeInterface ...$nodes
     */
    public function add(NodeInterface ...$nodes): NodeInterface
    {
        foreach ($nodes as $node) {
            [$key, $data] = $node->getValue();

            $hash = hash('sha256', $key . $data);

            $node = new self([$hash, substr($data, 0, 1)]);
            $parent = $this->append($node);

            $dataWithoutFirstLetter = substr($data, 1);

            if ('' < $dataWithoutFirstLetter) {
                $parent->add(new self([$hash, $dataWithoutFirstLetter]));
            } else {
                $nodes = [$node->getValue()];

                /** @var KeyValueNodeInterface $ancestor */
                foreach ($node->getAncestors() as $ancestor) {
                    $nodes[] = $ancestor->getValue();
                }
                array_pop($nodes);
                $node->append(new self([$hash, strrev(implode('', $nodes))]));
            }
        }

        return $this;
    }

    /**
     * @throws Exception
     *
     * @return NodeInterface|ValueNodeInterface
     */
    private function append(ValueNodeInterface $node)
    {
        /** @var ValueNodeInterface $child */
        foreach ($this->children() as $child) {
            if ($node->getValue() === $child->getValue()) {
                return $child;
            }
        }

        parent::add($node);

        return $node;
    }
}

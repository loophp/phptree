<?php

declare(strict_types=1);

namespace loophp\phptree\Node;

use Exception;

/**
 * Class TrieNode.
 */
class TrieNode extends KeyValueNode
{
    /**
     * {@inheritdoc}
     */
    public function add(NodeInterface ...$nodes): NodeInterface
    {
        foreach ($nodes as $node) {
            $data = $node->getValue();

            $hash = hash('sha256', $node->getKey() . $data);

            $node = new self($hash, mb_substr($data, 0, 1));
            $parent = $this->append($node);

            $dataWithoutFirstLetter = mb_substr($data, 1);

            if ('' < $dataWithoutFirstLetter) {
                $parent->add(new self($hash, $dataWithoutFirstLetter));
            } else {
                $nodes = [$node->getValue()];

                /** @var KeyValueNodeInterface $ancestor */
                foreach ($node->getAncestors() as $ancestor) {
                    $nodes[] = $ancestor->getValue();
                }
                array_pop($nodes);
                $node->append(new self($hash, strrev(implode('', $nodes))));
            }
        }

        return $this;
    }

    /**
     * @param ValueNodeInterface $node
     *
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

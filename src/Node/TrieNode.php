<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

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
        /** @var \drupol\phptree\Node\KeyValueNodeInterface $node */
        foreach ($nodes as $node) {
            $data = $node->getValue();

            $hash = \hash('sha256', $node->getKey() . $data);

            $node = new TrieNode($hash, \substr($data, 0, 1));
            $parent = $this->append($node);

            $dataWithoutFirstLetter = \substr($data, 1);
            if ('' < $dataWithoutFirstLetter) {
                $parent->add(new TrieNode($hash, $dataWithoutFirstLetter));
            } else {
                $nodes = [$node->getValue()];
                foreach ($node->getAncestors() as $ancestor) {
                    $nodes[] = $ancestor->getValue();
                }
                \array_pop($nodes);
                $node->append(new TrieNode($hash, \strrev(\implode('', $nodes))));
            }
        }

        return $this;
    }

    /**
     * @param \drupol\phptree\Node\ValueNodeInterface $node
     *
     * @throws \Exception
     *
     * @return \drupol\phptree\Node\NodeInterface|\drupol\phptree\Node\ValueNodeInterface
     */
    private function append(ValueNodeInterface $node)
    {
        /** @var \drupol\phptree\Node\ValueNodeInterface $child */
        foreach ($this->children() as $child) {
            if ($node->getValue() === $child->getValue()) {
                return $child;
            }
        }

        parent::add($node);

        return $node;
    }
}

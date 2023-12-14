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

            $node = new self([$hash, mb_substr($data, 0, 1)]);
            $parent = $this->append($node);

            $dataWithoutFirstLetter = mb_substr($data, 1);

            if ('' < $dataWithoutFirstLetter) {
                $parent->add(new self([$hash, $dataWithoutFirstLetter]));
            } else {
                $values = [$node->getValue()[1]];

                /** @var ValueNode $ancestor */
                foreach ($node->getAncestors() as $ancestor) {
                    $values[] = $ancestor->getValue()[1];
                }
                array_pop($nodes);
                $node->append(new self([$hash, $this->mbStrRev(implode('', $values))]));
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
            if ($node->getValue()[1] === $child->getValue()[1]) {
                return $child;
            }
        }

        parent::add($node);

        return $node;
    }

    private function mbStrRev(string $string): string
    {
        $chars = mb_str_split($string);

        return implode('', array_reverse($chars));
    }
}

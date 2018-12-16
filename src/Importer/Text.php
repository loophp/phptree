<?php

declare(strict_types = 1);

namespace drupol\phptree\Importer;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNode;
use drupol\phptree\Node\ValueNodeInterface;

/**
 * Class Text
 */
class Text implements ImporterInterface
{
    /**
     * {@inheritdoc}
     */
    public function import($data): NodeInterface
    {
        $parsed = $this->parse($data);

        return $this->arrayToTree($parsed[0]);
    }

    /**
     * Convert an array into a tree.
     *
     * @param array $data
     *
     * @return \drupol\phptree\Node\ValueNodeInterface
     *   The tree.
     */
    private function arrayToTree(array $data): ValueNodeInterface
    {
        $data += [
            'children' => [],
        ];

        $node = new ValueNode($data['value']);

        foreach ($data['children'] as $key => $child) {
            $node->add($this->arrayToTree($child));
        }

        return $node;
    }

    /**
     * Parse a string into an array.
     *
     * @param string $subject
     *   The subject string.
     *
     * @return array|bool
     *   The array.
     */
    private function parse(string $subject)
    {
        $result = false;

        \preg_match_all('~[^\[\]]+|\[(?<nested>(?R)*)\]~', $subject, $matches);

        foreach (\array_filter($matches['nested']) as $match) {
            $item = [];
            $position = \strpos($match, '[');

            if (false !== $position) {
                $item['value'] = \substr($match, 0, $position);
            } else {
                $item['value'] = $match;
            }

            if (false !== $children = $this->parse($match)) {
                $item['children'] = $children;
            }

            $result[] = $item;
        }

        return $result;
    }
}

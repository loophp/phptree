<?php

declare(strict_types=1);

namespace drupol\phptree\Importer;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNode;

/**
 * Class Text.
 */
class Text extends SimpleArray
{
    /**
     * {@inheritdoc}
     */
    public function import($data): NodeInterface
    {
        $parsed = $this->parse($data);

        if ([] === $parsed) {
            throw new \InvalidArgumentException('Unable to import the given data.');
        }

        return $this->arrayToTree($parsed[0]);
    }

    /**
     * Create a node.
     *
     * @param mixed $arguments
     *   The arguments
     *
     * @return \drupol\phptree\Node\Node
     *   The node
     */
    protected function createNode($arguments): NodeInterface
    {
        return new ValueNode($arguments);
    }

    /**
     * Parse a string into an array.
     *
     * @param string $subject
     *   The subject string
     *
     * @return array|bool
     *   The array
     */
    private function parse(string $subject)
    {
        $result = [];

        preg_match_all('~[^\[\]]+|\[(?<nested>(?R)*)\]~', $subject, $matches);

        $matches = (array) $matches['nested'];

        foreach (array_filter($matches) as $match) {
            $item = [];
            $position = mb_strpos($match, '[');

            if (false !== $position) {
                $item['value'] = mb_substr($match, 0, $position);
            } else {
                $item['value'] = $match;
            }

            if ([] !== $children = $this->parse($match)) {
                $item['children'] = $children;
            }

            $result[] = $item;
        }

        return $result;
    }
}

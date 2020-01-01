<?php

declare(strict_types=1);

namespace loophp\phptree\Importer;

use loophp\phptree\Node\NodeInterface;
use loophp\phptree\Node\ValueNode;

/**
 * Class SimpleArray.
 */
class SimpleArray implements ImporterInterface
{
    /**
     * {@inheritdoc}
     */
    public function import($data): NodeInterface
    {
        return $this->arrayToTree($data);
    }

    /**
     * Convert an array into a tree.
     *
     * @param array<string, mixed> $data
     *
     * @return \loophp\phptree\Node\NodeInterface
     *   The tree
     */
    protected function arrayToTree(array $data): NodeInterface
    {
        $data += [
            'children' => [],
        ];

        $node = $this->createNode($data['value']);

        foreach ($data['children'] as $key => $child) {
            $node->add($this->arrayToTree($child));
        }

        return $node;
    }

    /**
     * Create a node.
     *
     * @param mixed $data
     *   The arguments
     *
     * @return \loophp\phptree\Node\NodeInterface
     *   The node
     */
    protected function createNode($data): NodeInterface
    {
        return new ValueNode($data);
    }
}

<?php

declare(strict_types = 1);

namespace drupol\phptree\Importer;

use drupol\phptree\Node\Node;
use drupol\phptree\Node\NodeInterface;

/**
 * Class SimpleArray
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
     * @param array $data
     *
     * @return \drupol\phptree\Node\NodeInterface
     *   The tree.
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
     *   The arguments.
     *
     * @return \drupol\phptree\Node\NodeInterface
     *   The node.
     */
    protected function createNode($data): NodeInterface
    {
        return new Node();
    }
}

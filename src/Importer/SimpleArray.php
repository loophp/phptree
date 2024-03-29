<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Importer;

use loophp\phptree\Node\AttributeNode;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;

final class SimpleArray implements ImporterInterface
{
    public function import($data): NodeInterface
    {
        return $this->parseNode(new AttributeNode(['label' => 'root']), $data);
    }

    /**
     * Create a node.
     *
     * @param mixed $data
     *   The arguments
     *
     * @return AttributeNodeInterface
     *   The node
     */
    private function createNode($data): AttributeNodeInterface
    {
        return new AttributeNode([
            'data' => $data,
        ]);
    }

    private function parseNode(AttributeNodeInterface $parent, array ...$nodes): NodeInterface
    {
        return array_reduce(
            $nodes,
            function (AttributeNodeInterface $carry, array $node): NodeInterface {
                $node += ['children' => []];

                return $carry
                    ->add(
                        $this->parseNode(
                            $this->createNode($node),
                            ...$node['children']
                        )
                    );
            },
            $parent
        );
    }
}

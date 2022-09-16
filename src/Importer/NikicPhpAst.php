<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Importer;

use ast\Node;
use Exception;
use loophp\phptree\Node\AttributeNode;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;

use function ast\get_metadata;

final class NikicPhpAst implements ImporterInterface
{
    /**
     * @var array<int, \ast\Metadata>
     */
    private $metadata = [];

    /**
     * @param Node $data
     *
     * @throws Exception
     */
    public function import($data): NodeInterface
    {
        $this->metadata = get_metadata();

        return $this->parseNode($this->createNode(['label' => 'root']), $data);
    }

    private function createNode(array $attributes): AttributeNodeInterface
    {
        return new AttributeNode($attributes);
    }

    private function parseNode(AttributeNodeInterface $parent, Node ...$astNodes): NodeInterface
    {
        return array_reduce(
            $astNodes,
            function (AttributeNodeInterface $carry, Node $astNode): NodeInterface {
                return $carry
                    ->add(
                        $this->parseNode(
                            $this->createNode([
                                'label' => $this->metadata[$astNode->kind]->name,
                                'astNode' => $astNode,
                            ]),
                            ...array_values(array_filter($astNode->children, 'is_object'))
                        )
                    );
            },
            $parent
        );
    }
}

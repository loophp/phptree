<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Importer;

use Exception;
use loophp\phptree\Node\AttributeNode;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;
use PhpParser\Node;

use function is_array;

final class NikicPhpParser implements ImporterInterface
{
    /**
     * @param Node[] $data
     *
     * @throws Exception
     */
    public function import($data): NodeInterface
    {
        return $this->parseNode($this->createNode(['label' => 'root']), ...$data);
    }

    private function createNode(array $attributes): AttributeNodeInterface
    {
        return new AttributeNode($attributes);
    }

    /**
     * @return array<int, Node>
     */
    private function getAllNodeChildren(Node $astNode): array
    {
        /** @var array<int, array<int, Node>> $astNodes */
        $astNodes = array_map(
            static function (string $subNodeName) use ($astNode): array {
                $subNodes = $astNode->{$subNodeName};

                if (!is_array($subNodes)) {
                    $subNodes = [$subNodes];
                }

                return array_filter(
                    $subNodes,
                    'is_object'
                );
            },
            $astNode->getSubNodeNames()
        );

        return [] === $astNodes ?
            [] :
            array_merge(...$astNodes);
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
                                'label' => $astNode->getType(),
                                'astNode' => $astNode,
                            ]),
                            ...$this->getAllNodeChildren($astNode)
                        )
                    );
            },
            $parent
        );
    }
}

<?php

declare(strict_types=1);

namespace loophp\phptree\Importer;

use Exception;
use loophp\phptree\Node\AttributeNode;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;
use PhpParser\Node;

use function is_array;

/**
 * Class NikicPhpParser.
 */
final class NikicPhpParser implements ImporterInterface
{
    /**
     * @param Node[] $data
     *
     * @throws Exception
     *
     * @return \loophp\phptree\Node\NodeInterface
     */
    public function import($data): NodeInterface
    {
        return $this->parseNode($this->createNode(['label' => 'root']), ...$data);
    }

    /**
     * @param array $attributes
     *
     * @return \loophp\phptree\Node\AttributeNodeInterface
     */
    private function createNode(array $attributes): AttributeNodeInterface
    {
        return new AttributeNode($attributes);
    }

    /**
     * @param \PhpParser\Node $astNode
     *
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

    /**
     * @param \loophp\phptree\Node\AttributeNodeInterface $parent
     * @param Node ...$astNodes
     *
     * @return \loophp\phptree\Node\NodeInterface
     */
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

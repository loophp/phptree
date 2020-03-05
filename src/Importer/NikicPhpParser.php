<?php

declare(strict_types=1);

namespace loophp\phptree\Importer;

use Exception;
use loophp\phptree\Node\AttributeNode;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;
use PhpParser\Node;
use SplObjectStorage;

use function is_array;

/**
 * Class NikicPhpParser.
 */
final class NikicPhpParser implements ImporterInterface
{
    /**
     * @var SplObjectStorage
     */
    private $nodeMap;

    public function __construct()
    {
        $this->nodeMap = new SplObjectStorage();
    }

    /**
     * @param Node[] $data
     *
     * @throws Exception
     *
     * @return \loophp\phptree\Node\NodeInterface
     */
    public function import($data): NodeInterface
    {
        return $this->parseNode(new AttributeNode(['label' => 'root']), ...$data);
    }

    /**
     * @param \PhpParser\Node $astNode
     *
     * @return \loophp\phptree\Node\AttributeNodeInterface
     */
    private function createNode(Node $astNode): AttributeNodeInterface
    {
        return new AttributeNode([
            'label' => $astNode->getType(),
            'astNode' => $astNode,
        ]);
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

        return array_merge(...$astNodes);
    }

    /**
     * @param \PhpParser\Node $astNode
     * @param callable $default
     *
     * @return \loophp\phptree\Node\AttributeNodeInterface
     */
    private function getNodeFromCache(Node $astNode, callable $default): AttributeNodeInterface
    {
        if (false === $this->nodeMap->contains($astNode)) {
            $this->nodeMap->attach($astNode, $default($astNode));
        }

        return $this->nodeMap->offsetGet($astNode);
    }

    /**
     * @param \loophp\phptree\Node\AttributeNodeInterface $parent
     * @param \PhpParser\Node ...$astNodes
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
                            $this->getNodeFromCache($astNode, [$this, 'createNode']),
                            ...$this->getAllNodeChildren($astNode)
                        )
                    );
            },
            $parent
        );
    }
}

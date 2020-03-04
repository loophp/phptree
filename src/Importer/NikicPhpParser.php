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
        return (new AttributeNode(['label' => 'root']))
            ->add(...$this->parseNodes(...$data));
    }

    /**
     * @param \PhpParser\Node $astNode
     *
     * @throws \Exception
     *
     * @return \loophp\phptree\Node\NodeInterface
     */
    private function createNewNode(Node $astNode): NodeInterface
    {
        $defaultAttributes = [
            'label' => $astNode->getType(),
            'astNode' => $astNode,
        ];

        return (new AttributeNode($defaultAttributes))
            ->add(...$this->parseNodes(...$this->getAllNodeChildren($astNode)));
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
     * @param Node ...$astNodes
     *
     * @throws \Exception
     *
     * @return AttributeNodeInterface[]
     */
    private function parseNodes(Node ...$astNodes): array
    {
        $treeNodes = [];

        foreach ($astNodes as $astNode) {
            $treeNodes[] = $this->getNodeFromCache($astNode, [$this, 'createNewNode']);
        }

        return $treeNodes;
    }
}

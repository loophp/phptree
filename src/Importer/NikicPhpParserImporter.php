<?php

declare(strict_types=1);

namespace loophp\phptree\Importer;

use Exception;
use loophp\phptree\Node\AttributeNode;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;
use PhpParser\Node;
use SplObjectStorage;

use function get_class;
use function is_array;

final class NikicPhpParserImporter implements ImporterInterface
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
            ->add(...$this->parseNodes($data));
    }

    /**
     * @param \PhpParser\Node $astNode
     *
     * @return array<int, Node>
     */
    private function getNodeChildren(Node $astNode): array
    {
        $subNodeNames = $astNode->getSubNodeNames();

        $nodes = [];

        foreach ($subNodeNames as $subNodeName) {
            $subNodes = $astNode->{$subNodeName};

            if (!is_array($subNodes)) {
                $subNodes = [$subNodes];
            }

            foreach ($subNodes as $subNode) {
                if (false === ($subNode instanceof Node)) {
                    continue;
                }

                $nodes[] = $subNode;
            }
        }

        return $nodes;
    }

    /**
     * @param \PhpParser\Node $astNode
     *
     * @throws \Exception
     *
     * @return AttributeNodeInterface
     */
    private function parseNode(Node $astNode): AttributeNodeInterface
    {
        $attributes = [
            'label' => sprintf('%s', $astNode->getType()),
            'type' => $astNode->getType(),
            'class' => get_class($astNode),
            'shape' => 'rect',
            'astNode' => $astNode,
        ];

        return (new AttributeNode($attributes))
            ->add(...$this->parseNodes($this->getNodeChildren($astNode)));
    }

    /**
     * @param Node[] $astNodes
     *
     * @throws \Exception
     *
     * @return AttributeNodeInterface[]
     */
    private function parseNodes(array $astNodes): array
    {
        $treeNodes = [];

        foreach ($astNodes as $node) {
            if (false === $this->nodeMap->contains($node)) {
                $treeNode = $this->parseNode($node);
                $treeNode->setAttribute('astNode', $node);
                $this->nodeMap->attach($node, $treeNode);
            }

            $treeNodes[] = $this->nodeMap->offsetGet($node);
        }

        return $treeNodes;
    }
}

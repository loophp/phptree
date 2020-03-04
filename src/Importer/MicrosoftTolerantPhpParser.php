<?php

declare(strict_types=1);

namespace loophp\phptree\Importer;

use Exception;
use loophp\phptree\Node\AttributeNode;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;
use Microsoft\PhpParser\Node;
use Microsoft\PhpParser\Node\SourceFileNode;

/**
 * Class MicrosoftTolerantPhpParser.
 */
final class MicrosoftTolerantPhpParser implements ImporterInterface
{
    /**
     * @param SourceFileNode $data
     *
     * @throws Exception
     *
     * @return \loophp\phptree\Node\NodeInterface
     */
    public function import($data): NodeInterface
    {
        return $this->parseNode($this->createNode(['label' => 'root']), $data);
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
     * @param \loophp\phptree\Node\AttributeNodeInterface $parent
     * @param \Microsoft\PhpParser\Node ...$astNodes
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
                                'label' => $astNode->getNodeKindName(),
                                'astNode' => $astNode,
                            ]),
                            ...$astNode->getChildNodes()
                        )
                    );
            },
            $parent
        );
    }
}

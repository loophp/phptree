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
use Microsoft\PhpParser\Node;
use Microsoft\PhpParser\Node\SourceFileNode;

final class MicrosoftTolerantPhpParser implements ImporterInterface
{
    /**
     * @param SourceFileNode $data
     *
     * @throws Exception
     */
    public function import($data): NodeInterface
    {
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

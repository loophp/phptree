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

final class Text implements ImporterInterface
{
    public function import($data): NodeInterface
    {
        return $this->parseNode(new AttributeNode(['label' => 'root']), $data);
    }

    /**
     * Create a node.
     *
     * @param string $label
     *   The node label
     *
     * @return AttributeNodeInterface
     *   The node
     */
    private function createNode(string $label): AttributeNodeInterface
    {
        return new AttributeNode([
            'label' => $label,
        ]);
    }

    /**
     * Parse a string into an array.
     *
     * @param string $subject
     *   The subject string
     *
     * @return array<string, mixed>
     *   The array
     */
    private function parse(string $subject): array
    {
        $result = [
            'value' => mb_substr($subject, 1, mb_strpos($subject, '[', 1) - 1),
            'children' => [],
        ];

        if (false === $nextBracket = mb_strpos($subject, '[', 1)) {
            return $result;
        }

        // Todo: Improve the regex.
        preg_match_all('#[^\[\]]+|\[(?<nested>(?R)*)]#u', mb_substr($subject, $nextBracket, -1), $matches);

        $result['children'] = array_map(
            static function (string $match): string {
                return sprintf('[%s]', $match);
            },
            array_filter((array) $matches['nested'])
        );

        return $result;
    }

    private function parseNode(AttributeNodeInterface $parent, string ...$nodes): NodeInterface
    {
        return array_reduce(
            $nodes,
            function (AttributeNodeInterface $carry, string $node): NodeInterface {
                $data = $this->parse($node);

                return $carry
                    ->add(
                        $this->parseNode(
                            $this->createNode($data['value']),
                            ...$data['children']
                        )
                    );
            },
            $parent
        );
    }
}

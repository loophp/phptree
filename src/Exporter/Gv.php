<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use Generator;
use loophp\phptree\Node\AttributeNodeInterface;
use loophp\phptree\Node\NodeInterface;

use function is_array;

use const PHP_EOL;

/**
 * Class Gv.
 */
final class Gv implements ExporterInterface
{
    /**
     * The graph attributes.
     *
     * @var string[]|string[][]
     */
    private $attributes = [];

    /**
     * The graph type.
     *
     * @var bool
     */
    private $directed = true;

    public function export(NodeInterface $node): string
    {
        $attributes = array_map(
            function ($key, $data) {
                if (is_array($data)) {
                    return sprintf(
                        '  %s %s',
                        $key,
                        $this->attributesArrayToText($data)
                    );
                }

                return sprintf(
                    '  %s = %s',
                    $key,
                    $data
                );
            },
            array_keys($this->attributes),
            $this->attributes
        );

        $nodes = [];

        foreach ($node->all() as $child) {
            $nodes[] = sprintf(
                '  "%s" %s',
                $this->getHash($child),
                $this->attributesArrayToText($this->getNodeAttributes($child))
            );
        }

        $edges = [];

        foreach ($this->findEdges($node) as $parent => $child) {
            $edges[] = sprintf(
                '  "%s" %s "%s";',
                $this->getHash($parent),
                $this->getDirected() ? '->' : '--',
                $this->getHash($child)
            );
        }

        return $this->getGv(
            implode(PHP_EOL, $attributes),
            implode(PHP_EOL, $nodes),
            implode(PHP_EOL, $edges)
        );
    }

    /**
     * Check if the graph is directed or undirected.
     *
     * @return bool
     *   True if directed, false otherwise.
     */
    public function getDirected(): bool
    {
        return $this->directed;
    }

    /**
     * Set the graph type, directed or undirected.
     *
     * @param bool $directed
     *   True for a directed graph, false otherwise.
     *
     * @return \loophp\phptree\Exporter\Gv
     *   The exporter.
     */
    public function setDirected(bool $directed = true): self
    {
        $this->directed = $directed;

        return $this;
    }

    /**
     * Set the graph attributes.
     *
     * @param array<mixed, mixed> $attributes
     *   The graph attributes.
     *
     * @return \loophp\phptree\Exporter\Gv
     *   The exporter.
     */
    public function setGraphAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Converts an attributes array to string.
     *
     * @param array<mixed, mixed> $attributes
     *   The attributes.
     *
     * @return string
     *   The attributes as string.
     */
    private function attributesArrayToText(array $attributes): string
    {
        $attributesText = array_filter(
            array_map(
                static function ($key, $value) {
                    if (null === $value || is_scalar($value) || method_exists($value, '__toString')) {
                        $value = (string) $value;
                    } else {
                        return null;
                    }

                    return sprintf('%s="%s"', $key, $value);
                },
                array_keys($attributes),
                $attributes
            )
        );

        return '[' . implode(' ', $attributesText) . ']';
    }

    /**
     * Recursively find all the edges in a tree.
     *
     * @param \loophp\phptree\Node\NodeInterface $node
     *   The root node.
     *
     * @return Generator<NodeInterface, NodeInterface>
     *   Yield the parent and child node.
     */
    private function findEdges(NodeInterface $node): iterable
    {
        foreach ($node->children() as $child) {
            yield $node => $child;

            yield from $this->findEdges($child);
        }
    }

    /**
     * Get the default GV file content.
     *
     * @param string $edges
     *   The edges.
     *
     * @return string
     *   The content of the .gv file.
     */
    private function getGv(string $attributes = '', string $nodes = '', string $edges = ''): string
    {
        $graphType = $this->getDirected() ?
            'digraph' :
            'graph';

        return implode(
            PHP_EOL,
            [
                sprintf('%s PHPTreeGraph {', $graphType),
                '// The graph attributes.',
                $attributes,
                '',
                '// The graph nodes.',
                $nodes,
                '',
                '// The graph edges.',
                $edges,
                '}',
            ]
        );
    }

    /**
     * Get the hash of a node.
     *
     * @param \loophp\phptree\Node\NodeInterface $node
     *   The node.
     *
     * @return string
     *   The hash of the node.
     */
    private function getHash(NodeInterface $node): string
    {
        return sha1(spl_object_hash($node));
    }

    /**
     * Get the node attributes.
     *
     * @param \loophp\phptree\Node\NodeInterface $node
     *   The node interface.
     *
     * @return array<mixed, mixed>
     *   The attributes as an array.
     */
    private function getNodeAttributes(NodeInterface $node): array
    {
        $attributes = [
            'label' => $node->label(),
        ];

        if ($node instanceof AttributeNodeInterface) {
            foreach ($node->getAttributes() as $key => $value) {
                $attributes[$key] = $value;
            }
        }

        return $attributes;
    }
}

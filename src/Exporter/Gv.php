<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\AttributeNodeInterface;
use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNodeInterface;

/**
 * Class Gv.
 */
class Gv implements ExporterInterface
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

    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node): string
    {
        $attributes = [];
        foreach ($this->attributes as $key => $attribute) {
            if (\is_string($attribute)) {
                $attributes[] = \sprintf(
                    '  %s = %s',
                    $key,
                    $attribute
                );

                continue;
            }

            if (\is_array($attribute)) {
                $attributes[] = \sprintf(
                    '  %s %s',
                    $key,
                    $this->attributesArrayToText($attribute)
                );

                continue;
            }
        }

        $nodes = [];
        foreach ($node->all() as $child) {
            $nodes[] = \sprintf(
                '  "%s" %s',
                $this->getHash($child),
                $this->getNodeAttributes($child)
            );
        }

        $edges = [];
        foreach ($this->findEdges($node) as $parent => $child) {
            $edges[] = \sprintf(
                '  "%s" %s "%s";',
                $this->getHash($parent),
                true === $this->getDirected() ? '->' : '--',
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
     * @return \drupol\phptree\Exporter\Gv
     *   The exporter.
     */
    public function setDirected(bool $directed = true): Gv
    {
        $this->directed = $directed;

        return $this;
    }

    /**
     * Set the graph attributes.
     *
     * @param array $attributes
     *   The graph attributes.
     *
     * @return \drupol\phptree\Exporter\Gv
     *   The exporter.
     */
    public function setGraphAttributes(array $attributes): Gv
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Converts an attributes array to string.
     *
     * @param array $attributes
     *   The attributes.
     *
     * @return string
     *   The attributes as string.
     */
    protected function attributesArrayToText(array $attributes): string
    {
        $attributesText = \array_map(
            static function ($key, $value) {
                return \sprintf('%s="%s"', $key, $value);
            },
            \array_keys($attributes),
            $attributes
        );

        return '[' . \implode(' ', $attributesText) . ']';
    }

    /**
     * Recursively find all the edges in a tree.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The root node.
     *
     * @return \Generator
     *   Yield the parent and child node.
     */
    protected function findEdges(NodeInterface $node): iterable
    {
        foreach ($node->children() as $child) {
            yield $node => $child;

            yield from $this->findEdges($child);
        }
    }

    /**
     * Get the default GV file content.
     *
     * @param string $attributes
     * @param string $nodes
     * @param string $edges
     *   The edges.
     *
     * @return string
     *   The content of the .gv file.
     */
    protected function getGv(string $attributes = '', string $nodes = '', string $edges = ''): string
    {
        $graphType = $this->getDirected() ?
            'digraph' :
            'graph';

        return <<<EOF
{$graphType} PHPTreeGraph {
// The graph attributes.
{$attributes}

// The graph nodes.
{$nodes}

// The graph edges.
{$edges}
}
EOF;
    }

    /**
     * Get the hash of a node.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node.
     *
     * @return string
     *   The hash of the node.
     */
    protected function getHash(NodeInterface $node): string
    {
        return \sha1(\spl_object_hash($node));
    }

    /**
     * Get the node attributes.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node interface.
     *
     * @return string
     *   The attributes as a string.
     */
    protected function getNodeAttributes(NodeInterface $node): string
    {
        $attributes = [];

        if ($node instanceof ValueNodeInterface) {
            $attributes['label'] = $node->getValue();
        }

        if ($node instanceof AttributeNodeInterface) {
            foreach ($node->getAttributes() as $key => $value) {
                $attributes[$key] = $value;
            }
        }

        return $this->attributesArrayToText($attributes);
    }
}

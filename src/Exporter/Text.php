<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNodeInterface;

/**
 * Class Text.
 */
class Text implements ExporterInterface
{
    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node): string
    {
        $children = [];

        /** @var ValueNodeInterface $child */
        foreach ($node->children() as $child) {
            $children[] = $this->export($child);
        }

        return [] === $children ?
            \sprintf('[%s]', $this->getNodeValue($node)) :
            \sprintf('[%s%s]', $this->getNodeValue($node), \implode('', $children));
    }

    /**
     * Get a string representation of a node.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node.
     *
     * @return string
     *   The string representation.
     */
    protected function getNodeValue(NodeInterface $node): string
    {
        return $node instanceof ValueNodeInterface ?
            (string) $node->getValue() :
            (string) \spl_object_hash($node);
    }
}

<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;

/**
 * Class SimpleArray
 */
class SimpleArray implements ExporterInterface
{
    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node)
    {
        $children = [];
        /** @var ValueNodeInterface $child */
        foreach ($node->children() as $child) {
            $children[] = $this->export($child);
        }

        return [] === $children ?
            ['value' => $node->getValue()]:
            ['value' => $node->getValue(), 'children' => $children];
    }
}

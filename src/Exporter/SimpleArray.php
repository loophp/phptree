<?php

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use loophp\phptree\Node\NodeInterface;

/**
 * Class SimpleArray.
 */
final class SimpleArray implements ExporterInterface
{
    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node)
    {
        $children = [];

        /** @var NodeInterface $child */
        foreach ($node->children() as $child) {
            $children[] = $this->export($child);
        }

        return [] === $children ?
            ['value' => $node->label()] :
            ['value' => $node->label(), 'children' => $children];
    }
}

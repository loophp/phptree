<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNodeInterface;

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
        if (!($node instanceof ValueNodeInterface)) {
            throw new \InvalidArgumentException('Must implements ValueNodeInterface');
        }

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

<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNodeInterface;

/**
 * Class Text.
 */
class Text extends AbstractExporter
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
            \sprintf('[%s]', $this->getNodeRepresentation($node)) :
            \sprintf('[%s%s]', $this->getNodeRepresentation($node), \implode('', $children));
    }
}

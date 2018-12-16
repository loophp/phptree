<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\ValueNodeInterface;

/**
 * Class Text
 */
class Text implements ExporterInterface
{
    /**
     * Export the node in a string.
     *
     * @param \drupol\phptree\Node\ValueNodeInterface $node
     *   The node.
     *
     * @return string
     *   The string.
     */
    public function export(ValueNodeInterface $node): string
    {
        $children = [];
        /** @var ValueNodeInterface $child */
        foreach ($node->children() as $child) {
            $children[] = $this->export($child);
        }

        return [] === $children ?
            \sprintf('[%s]', $node->getValue()):
            \sprintf('[%s %s]', $node->getValue(), \implode(' ', $children));
    }
}

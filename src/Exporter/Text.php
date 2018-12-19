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
     * {@inheritdoc}
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

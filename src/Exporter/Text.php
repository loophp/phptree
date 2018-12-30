<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;
use drupol\phptree\Node\ValueNodeInterface;

/**
 * Class Text
 */
class Text implements ExporterInterface
{
    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node): string
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
            \sprintf('[%s]', $node->getValue()):
            \sprintf('[%s %s]', $node->getValue(), \implode(' ', $children));
    }
}

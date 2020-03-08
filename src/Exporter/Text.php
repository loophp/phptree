<?php

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use loophp\phptree\Node\NodeInterface;

/**
 * Class Text.
 */
final class Text implements ExporterInterface
{
    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node): string
    {
        $children = [];

        /** @var NodeInterface $child */
        foreach ($node->children() as $child) {
            $children[] = $this->export($child);
        }

        return [] === $children ?
            sprintf('[%s]', $node->label()) :
            sprintf('[%s%s]', $node->label(), implode('', $children));
    }
}

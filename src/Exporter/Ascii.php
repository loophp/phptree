<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;

/**
 * Class Ascii
 */
class Ascii implements ExporterInterface
{
    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node): string
    {
        $tree = new \RecursiveTreeIterator(
            new \RecursiveArrayIterator(
                $this->doExportAsArray($node)
            ),
            \RecursiveTreeIterator::BYPASS_KEY,
            \CachingIterator::CATCH_GET_CHILD,
            \RecursiveTreeIterator::SELF_FIRST
        );

        $tree->setPrefixPart(\RecursiveTreeIterator::PREFIX_LEFT, '');
        $tree->setPrefixPart(\RecursiveTreeIterator::PREFIX_END_HAS_NEXT, '├─');
        $tree->setPrefixPart(\RecursiveTreeIterator::PREFIX_END_LAST, '└─');
        $tree->setPrefixPart(\RecursiveTreeIterator::PREFIX_RIGHT, '');
        $tree->setPrefixPart(\RecursiveTreeIterator::PREFIX_MID_LAST, '  ');
        $tree->setPrefixPart(\RecursiveTreeIterator::PREFIX_MID_HAS_NEXT, '│ ');

        $output = '';

        foreach ($tree as $value) {
            $entry = ('Array' === $entry = $tree->getEntry()) ?
                    '┐':
                    ' ' . $entry;

            $output .= $tree->getPrefix() . $entry . $tree->getPostfix() . PHP_EOL;
        }

        return $output;
    }

    /**
     * Export the tree in an array.
     *
     * @return array
     *   The tree exported into an array.
     */
    private function doExportAsArray(NodeInterface $node): array
    {
        $children = [];
        /** @var ValueNodeInterface $child */
        foreach ($node->children() as $child) {
            $children[] = $this->doExportAsArray($child);
        }

        return [] === $children ?
            [$node->getValue()]:
            [$node->getValue(), $children];
    }
}

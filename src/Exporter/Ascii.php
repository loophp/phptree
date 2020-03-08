<?php

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use CachingIterator;
use loophp\phptree\Node\NodeInterface;
use RecursiveArrayIterator;
use RecursiveTreeIterator;

use const PHP_EOL;

/**
 * Class Ascii.
 */
final class Ascii implements ExporterInterface
{
    /**
     * {@inheritdoc}
     */
    public function export(NodeInterface $node): string
    {
        $exporter = new SimpleArray();

        $tree = new RecursiveTreeIterator(
            new RecursiveArrayIterator(
                $exporter->export($node)
            ),
            RecursiveTreeIterator::SELF_FIRST,
            CachingIterator::CATCH_GET_CHILD,
            RecursiveTreeIterator::SELF_FIRST
        );

        $tree->setPrefixPart(RecursiveTreeIterator::PREFIX_LEFT, '');
        $tree->setPrefixPart(RecursiveTreeIterator::PREFIX_END_HAS_NEXT, '├─');
        $tree->setPrefixPart(RecursiveTreeIterator::PREFIX_END_LAST, '└─');
        $tree->setPrefixPart(RecursiveTreeIterator::PREFIX_RIGHT, '');
        $tree->setPrefixPart(RecursiveTreeIterator::PREFIX_MID_LAST, '  ');
        $tree->setPrefixPart(RecursiveTreeIterator::PREFIX_MID_HAS_NEXT, '│ ');

        $output = '';

        foreach ($tree as $value) {
            $entry = ('Array' === $entry = $tree->getEntry()) ?
                    '┐' :
                    ' ' . $entry;

            $output .= $tree->getPrefix() . $entry . $tree->getPostfix() . PHP_EOL;
        }

        return $output;
    }
}

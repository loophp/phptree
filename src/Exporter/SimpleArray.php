<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use loophp\phptree\Node\NodeInterface;

final class SimpleArray implements ExporterInterface
{
    public function export(NodeInterface $node): array
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

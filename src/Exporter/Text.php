<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use loophp\phptree\Node\NodeInterface;

final class Text implements ExporterInterface
{
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

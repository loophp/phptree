<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Exporter;

use loophp\phptree\Node\NodeInterface;

/**
 * Interface ExporterInterface.
 */
interface ExporterInterface
{
    /**
     * Export a node into something.
     *
     * @param NodeInterface $node
     *   The node
     *
     * @return mixed
     *   The node exported
     */
    public function export(NodeInterface $node);
}

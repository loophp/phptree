<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Importer;

use loophp\phptree\Node\NodeInterface;

/**
 * Interface ImporterInterface.
 */
interface ImporterInterface
{
    /**
     * Import data into a node.
     *
     * @param mixed $data
     *   The data to import
     *
     * @return NodeInterface
     *   The new node
     */
    public function import($data): NodeInterface;
}

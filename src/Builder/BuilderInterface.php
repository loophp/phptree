<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Builder;

use loophp\phptree\Node\NodeInterface;

interface BuilderInterface
{
    /**
     * @param iterable<int, array<int, class-string|callable():(NodeInterface)|mixed>> $nodes
     */
    public static function create(iterable $nodes): ?NodeInterface;
}

<?php

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

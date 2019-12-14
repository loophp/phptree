<?php

declare(strict_types=1);

namespace drupol\phptree\Builder;

use drupol\phptree\Node\NodeInterface;

/**
 * Interface BuilderInterface.
 */
interface BuilderInterface
{
    /**
     * @param iterable<mixed> $nodes
     *
     * @return \drupol\phptree\Node\NodeInterface|null
     */
    public static function create(iterable $nodes): ?NodeInterface;
}

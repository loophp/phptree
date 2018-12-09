<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class NaryNode
 */
interface NaryNodeInterface
{
    /**
     * {@inheritdoc}
     */
    public function capacity(): int;
}

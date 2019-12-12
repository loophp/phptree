<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

/**
 * Interface MerkleNodeInterface.
 */
interface MerkleNodeInterface extends ValueNodeInterface
{
    /**
     * @return \drupol\phptree\Node\MerkleNodeInterface
     */
    public function normalize(): MerkleNodeInterface;
}

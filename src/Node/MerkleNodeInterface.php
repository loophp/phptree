<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Node;

/**
 * Interface MerkleNodeInterface.
 */
interface MerkleNodeInterface extends ValueNodeInterface
{
    public function hash(): string;

    /**
     * @return \loophp\phptree\Node\MerkleNodeInterface
     */
    public function normalize(): MerkleNodeInterface;
}

<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\phptree\Node;

use drupol\phpmerkle\Hasher\DoubleSha256;
use drupol\phpmerkle\Hasher\HasherInterface;
use loophp\phptree\Modifier\FulfillCapacity;
use loophp\phptree\Modifier\ModifierInterface;
use loophp\phptree\Modifier\RemoveNullNode;

class MerkleNode extends ValueNode implements MerkleNodeInterface
{
    private HasherInterface $hasher;

    /**
     * @var ModifierInterface[]
     */
    private $modifiers = [];

    public function __construct(
        mixed $value,
        int $capacity = 2,
        ?HasherInterface $hasher = null
    ) {
        parent::__construct($value, $capacity, null, null);

        $this->hasher = $hasher ?? new DoubleSha256();
        $this->modifiers = [
            new RemoveNullNode(),
            new FulfillCapacity(),
        ];
    }

    public function hash(): string
    {
        return $this->hasher->unpack($this->doHash($this->normalize()));
    }

    public function label(): string
    {
        return $this->isLeaf() ?
            $this->getValue() :
            $this->hash();
    }

    public function normalize(): MerkleNodeInterface
    {
        return array_reduce(
            $this->modifiers,
            static function (MerkleNodeInterface $tree, ModifierInterface $modifier): MerkleNodeInterface {
                return $modifier->modify($tree);
            },
            $this->clone()
        );
    }

    private function doHash(MerkleNodeInterface $node): string
    {
        // If node is a leaf, then compute its hash from its value.
        if ($node->isLeaf()) {
            return $this->hasher->hash($node->getValue());
        }

        $hash = '';
        /** @var MerkleNodeInterface $child */
        foreach ($node->children() as $child) {
            $hash .= $this->doHash($child);
        }

        return $this->hasher->hash($hash);
    }
}

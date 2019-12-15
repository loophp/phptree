<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

use drupol\phpmerkle\Hasher\DoubleSha256;
use drupol\phpmerkle\Hasher\HasherInterface;
use drupol\phptree\Modifier\FulfillCapacity;
use drupol\phptree\Modifier\ModifierInterface;
use drupol\phptree\Modifier\RemoveNullNode;

/**
 * Class MerkleNode.
 */
class MerkleNode extends ValueNode implements MerkleNodeInterface
{
    /**
     * @var \drupol\phpmerkle\Hasher\HasherInterface
     */
    private $hasher;

    /**
     * @var \drupol\phptree\Modifier\ModifierInterface[]
     */
    private $modifiers;

    /**
     * MerkleNode constructor.
     *
     * @param mixed $value
     * @param int $capacity
     * @param \drupol\phpmerkle\Hasher\HasherInterface $hasher
     */
    public function __construct(
        $value,
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

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        if (true === $this->isLeaf()) {
            return parent::getValue();
        }

        return $this->hash();
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    private function doHash(MerkleNodeInterface $node): string
    {
        // If node is a leaf, then compute its hash from its value.
        if (true === $node->isLeaf()) {
            return $this->hasher->hash((string) $node->getValue());
        }

        $hash = '';
        /** @var \drupol\phptree\Node\MerkleNodeInterface $child */
        foreach ($node->children() as $child) {
            $hash .= $this->doHash($child);
        }

        return $this->hasher->hash($hash);
    }

    /**
     * {@inheritdoc}
     */
    private function hash(): string
    {
        return $this->hasher->unpack($this->doHash($this->normalize()));
    }
}

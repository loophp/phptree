<?php

declare(strict_types=1);

namespace drupol\phptree\Node;

use drupol\phpmerkle\Hasher\DoubleSha256;
use drupol\phpmerkle\Hasher\HasherInterface;

/**
 * Class MerkleNode.
 */
class MerkleNode extends ValueNode
{
    /**
     * @var \drupol\phpmerkle\Hasher\HasherInterface
     */
    private $hasher;

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
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        if (true === $this->isLeaf()) {
            return parent::getValue();
        }

        return $this->clone()->hash();
    }

    /**
     * {@inheritdoc}
     */
    private function doHash(): string
    {
        // If node is a leaf, then compute its hash from its value.
        if (true === $this->isLeaf()) {
            $value = $this->getValue();

            if (null === $value) {
                return '';
            }

            return $this->hasher->hash($value);
        }

        // Remove all nodes with null value.
        if (null !== $parent = $this->getParent()) {
            /** @var \drupol\phptree\Node\MerkleNode $node */
            foreach ($parent->all() as $node) {
                if (false === $node->isLeaf()) {
                    continue;
                }

                if (null !== $node->getValue()) {
                    continue;
                }

                $node->getParent()->remove($node);

                return $this->hash();
            }
        }

        // If node with children is not fulfilled, make sure it is complete.
        if ($this->degree() !== $this->capacity()) {
            $children = iterator_to_array($this->children());

            if ([] !== $children) {
                $this->add(current($children)->clone());
            }
        }

        $hash = array_reduce(
            iterator_to_array($this->children()),
            static function ($carry, MerkleNode $node): string {
                return $carry . $node->doHash();
            },
            ''
        );

        return $this->hasher->hash($hash);
    }

    /**
     * {@inheritdoc}
     */
    private function hash(): string
    {
        return $this->hasher->unpack($this->doHash());
    }
}

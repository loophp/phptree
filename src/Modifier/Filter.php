<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;

/**
 * Class Filter.
 */
class Filter implements ModifierInterface
{
    /**
     * @var callable
     */
    private $filter;

    /**
     * Filter constructor.
     *
     * @param callable $filter
     */
    public function __construct(callable $filter)
    {
        $this->filter = $filter;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(NodeInterface $tree): NodeInterface
    {
        /** @var \loophp\phptree\Node\MerkleNode $item */
        foreach ($tree->all() as $item) {
            if (null === $parent = $item->getParent()) {
                continue;
            }

            if (false === (bool) ($this->filter)($item)) {
                continue;
            }

            $parent->remove($item);
            $this->modify($parent);
        }

        return $tree;
    }
}

<?php

declare(strict_types=1);

namespace loophp\phptree\Modifier;

use loophp\phptree\Node\NodeInterface;

/**
 * Class Apply.
 */
class Apply implements ModifierInterface
{
    /**
     * @var callable
     */
    private $apply;

    /**
     * Filter constructor.
     *
     * @param callable $apply
     */
    public function __construct(callable $apply)
    {
        $this->apply = $apply;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(NodeInterface $tree): NodeInterface
    {
        /** @var \loophp\phptree\Node\MerkleNode $item */
        foreach ($tree->all() as $item) {
            ($this->apply)($item);
        }

        return $tree;
    }
}

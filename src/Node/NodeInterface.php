<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Class NodeInterface
 */
interface NodeInterface extends \Countable
{
    /**
     * @return \drupol\phptree\Node\NodeInterface|null
     */
    public function getParent(): ?NodeInterface;

    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     *
     * @return \drupol\phptree\Node\NodeInterface
     */
    public function setParent(NodeInterface $node): NodeInterface;

    /**
     * @param \drupol\phptree\Node\NodeInterface ...$node
     *
     * @return \drupol\phptree\Node\NodeInterface
     */
    public function add(NodeInterface ...$node): NodeInterface;

    /**
     * @param \drupol\phptree\Node\NodeInterface ...$node
     *
     * @return \drupol\phptree\Node\NodeInterface
     */
    public function remove(NodeInterface ...$node): NodeInterface;

    /**
     * @return NodeInterface[]
     */
    public function children(): array;

    /**
     * @return bool
     */
    public function isLeaf(): bool;

    /**
     * @return bool
     */
    public function isRoot(): bool;

    /**
     * @return array
     */
    public function getAncestors(): array;

    /**
     * @return array
     */
    public function getSibblings(): array;

    /**
     * @return int
     */
    public function degree(): int;
}

<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Interface NodeInterface
 */
interface NodeInterface extends \Countable
{
    /**
     * Get the parent node.
     *
     * @return NodeInterface|null
     *   The parent node if any, null otherwise.
     */
    public function getParent(): ?NodeInterface;

    /**
     * Set the parent.
     *
     * @param NodeInterface $node
     *   The parent node.
     *
     * @return NodeInterface
     *   The node.
     */
    public function setParent(NodeInterface $node): NodeInterface;

    /**
     * The node to add.
     *
     * @param NodeInterface ...$node
     *   The node to add.
     *
     * @return NodeInterface
     *   The node.
     */
    public function add(NodeInterface ...$node): NodeInterface;

    /**
     * Remove children.
     *
     * @param NodeInterface ...$node
     *   The node to remove.
     *
     * @return NodeInterface
     *   The node.
     */
    public function remove(NodeInterface ...$node): NodeInterface;

    /**
     * Get the children.
     *
     * @return \drupol\phptree\Node\NodeInterface[]
     *   The children.
     */
    public function children(): array;

    /**
     * Check if the node is a leaf.
     *
     * @return bool
     *   True if it's a leaf, false otherwise.
     */
    public function isLeaf(): bool;

    /**
     * Check if the node is the root node.
     *
     * @return bool
     *   True if it's a root node, false otherwise.
     */
    public function isRoot(): bool;

    /**
     * Get the ancestors of a node.
     *
     * @return NodeInterface[]
     *   The array of ancestors.
     */
    public function getAncestors(): array;

    /**
     * Get the node's sibblings.
     *
     * @return NodeInterface[]
     *   The array of sibblings.
     */
    public function getSibblings(): array;

    /**
     * The number of children a node has.
     *
     * @return int
     *   The amound of children.
     */
    public function degree(): int;
}

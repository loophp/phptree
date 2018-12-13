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
     * @return \Traversable
     *   The array of ancestors.
     */
    public function getAncestors(): \Traversable;

    /**
     * Get the node's sibblings.
     *
     * @return \Traversable
     *   The array of sibblings.
     */
    public function getSibblings(): \Traversable;

    /**
     * The number of children a node has.
     *
     * @return int
     *   The amount of children.
     */
    public function degree(): int;

    /**
     * Get the node depth from the root node.
     *
     * @return int
     *   The depth is the number of nodes before root.
     */
    public function depth(): int;

    /**
     * Get a clone of the object without any children.
     *
     * @param \drupol\phptree\Node\NodeInterface ...$nodes
     *   The children that the clone will have.
     *
     * @return \drupol\phptree\Node\NodeInterface
     *   The new object.
     */
    public function withChildren(NodeInterface ...$nodes): NodeInterface;

    /**
     * Get the last child if any.
     *
     * @return \drupol\phptree\Node\NodeInterface|null
     *   The last child if any, null otherwise.
     */
    public function lastChild(): ?NodeInterface;
}

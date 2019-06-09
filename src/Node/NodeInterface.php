<?php

declare(strict_types = 1);

namespace drupol\phptree\Node;

/**
 * Interface NodeInterface.
 */
interface NodeInterface extends \Countable, \ArrayAccess, \Traversable, \IteratorAggregate
{
    /**
     * The node to add.
     *
     * @param NodeInterface ...$node
     *   The node to add.
     *
     * @return NodeInterface
     *   The node
     */
    public function add(NodeInterface ...$node): NodeInterface;

    /**
     * Get all the nodes of a tree including the parent node itself.
     *
     * @return \drupol\phptree\Node\NodeInterface|\Traversable
     *   The node.
     */
    public function all(): \Traversable;

    /**
     * Get the children.
     *
     * @return \drupol\phptree\Node\NodeInterface|\Traversable
     *   The children
     */
    public function children(): \Traversable;

    /**
     * The amount of children a node has.
     *
     * @return int
     *   The amount of children
     */
    public function degree(): int;

    /**
     * Remove a node (and its subnodes) from a tree.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node to remove.
     *
     * @return null|\drupol\phptree\Node\NodeInterface
     *   The node that has been removed without parent, null otherwise.
     */
    public function delete(NodeInterface $node): ?NodeInterface;

    /**
     * Get the node depth from the root node.
     *
     * @return int
     *   The depth is the number of nodes before root
     */
    public function depth(): int;

    /**
     * Check if a node is find is in the tree.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node to find.
     *
     * @return null|\drupol\phptree\Node\NodeInterface
     *   The node if found, false otherwise.
     */
    public function find(NodeInterface $node): ?NodeInterface;

    /**
     * Get the ancestors of a node.
     *
     * @return \Traversable
     *   The ancestors
     */
    public function getAncestors(): \Traversable;

    /**
     * Get the parent node.
     *
     * @return null|NodeInterface
     *   The parent node if any, null otherwise
     */
    public function getParent(): ?NodeInterface;

    /**
     * Get the node's sibblings.
     *
     * @return \Traversable
     *   The sibblings
     */
    public function getSibblings(): \Traversable;

    /**
     * Get the tree height.
     *
     * @return int
     *   The tree height
     */
    public function height(): int;

    /**
     * Check if the node has children, then it's a leaf.
     *
     * @return bool
     *   True if it has children, false otherwise
     */
    public function isLeaf(): bool;

    /**
     * Check if the node is the root node (Node parent is null).
     *
     * @return bool
     *   True if it's a root node, false otherwise
     */
    public function isRoot(): bool;

    /**
     * Remove children.
     *
     * @param NodeInterface ...$node
     *   The node to remove.
     *
     * @return NodeInterface
     *   The node
     */
    public function remove(NodeInterface ...$node): NodeInterface;

    /**
     * Set the parent.
     *
     * @param null|NodeInterface $node
     *   The parent node
     *
     * @return NodeInterface
     *   The node
     */
    public function setParent(?NodeInterface $node): NodeInterface;

    /**
     * Get a clone of the object with or without children.
     *
     * @param \drupol\phptree\Node\NodeInterface ...$nodes
     *   The children that the clone will have.
     *
     * @return \drupol\phptree\Node\NodeInterface
     *   The new object
     */
    public function withChildren(NodeInterface ...$nodes): NodeInterface;
}

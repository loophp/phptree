<?php

declare(strict_types=1);

namespace loophp\phptree\Node;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * Interface NodeInterface.
 *
 * @template-extends ArrayAccess<int, mixed>
 * @template-extends IteratorAggregate<int, mixed>
 */
interface NodeInterface extends ArrayAccess, Countable, IteratorAggregate
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
     * @return Traversable<\loophp\phptree\Node\NodeInterface>
     *   The node.
     */
    public function all(): Traversable;

    /**
     * Get the children.
     *
     * @return Traversable<\loophp\phptree\Node\NodeInterface>
     *   The children
     */
    public function children(): Traversable;

    /**
     * Clone the tree and all of its children.
     *
     * @return \loophp\phptree\Node\NodeInterface
     *   The tree.
     */
    public function clone(): NodeInterface;

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
     * @param \loophp\phptree\Node\NodeInterface $node
     *   The node to remove.
     *
     * @return \loophp\phptree\Node\NodeInterface|null
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
     * @param \loophp\phptree\Node\NodeInterface $node
     *   The node to find.
     *
     * @return \loophp\phptree\Node\NodeInterface|null
     *   The node if found, false otherwise.
     */
    public function find(NodeInterface $node): ?NodeInterface;

    /**
     * Get the ancestors of a node.
     *
     * @return Traversable<\loophp\phptree\Node\NodeInterface>
     *   The ancestors
     */
    public function getAncestors(): Traversable;

    /**
     * Get the parent node.
     *
     * @return NodeInterface|null
     *   The parent node if any, null otherwise
     */
    public function getParent(): ?NodeInterface;

    /**
     * Get the node's sibblings.
     *
     * @return Traversable<\loophp\phptree\Node\NodeInterface>
     *   The sibblings
     */
    public function getSibblings(): Traversable;

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
     * @return string
     */
    public function label(): string;

    /**
     * @param int $level
     *
     * @return Traversable<\loophp\phptree\Node\NodeInterface>
     */
    public function level(int $level): Traversable;

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
     * Replace a node with another one and return the parent.
     *
     * It may also return null if the replace failed.
     *
     * @param \loophp\phptree\Node\NodeInterface $node
     *   The replacement node.
     *
     * @return \loophp\phptree\Node\NodeInterface|null
     *   The node parent if successful, null otherwise.
     */
    public function replace(NodeInterface $node): ?NodeInterface;

    /**
     * Set the parent.
     *
     * @param NodeInterface|null $node
     *   The parent node
     *
     * @return NodeInterface
     *   The node
     */
    public function setParent(?NodeInterface $node): NodeInterface;

    /**
     * Get a clone of the object with or without children.
     *
     * @param \loophp\phptree\Node\NodeInterface|null ...$nodes
     *   The children that the clone will have.
     *
     * @return \loophp\phptree\Node\NodeInterface
     *   The new object
     */
    public function withChildren(?NodeInterface ...$nodes): NodeInterface;
}

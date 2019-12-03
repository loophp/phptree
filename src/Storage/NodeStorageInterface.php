<?php

declare(strict_types=1);

namespace drupol\phptree\Storage;

use ArrayObject;
use drupol\phptree\Node\NodeInterface;

interface NodeStorageInterface extends StorageInterface
{
    /**
     * Get the children.
     *
     * @return ArrayObject
     */
    public function getChildren();

    /**
     * Get the parent.
     *
     * @return NodeInterface|null
     */
    public function getParent(): ?NodeInterface;

    /**
     * @param NodeInterface|null $parent
     *
     * @return StorageInterface
     */
    public function setParent(?NodeInterface $parent): StorageInterface;
}

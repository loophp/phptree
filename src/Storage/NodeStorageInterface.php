<?php

declare(strict_types = 1);

namespace drupol\phptree\Storage;

use drupol\phptree\Node\NodeInterface;

interface NodeStorageInterface extends StorageInterface
{
    /**
     * Get the children.
     *
     * @return \ArrayObject
     */
    public function getChildren();

    /**
     * Get the parent.
     *
     * @return null|NodeInterface
     */
    public function getParent(): ?NodeInterface;

    /**
     * @param null|NodeInterface $parent
     *
     * @return StorageInterface
     */
    public function setParent(?NodeInterface $parent): StorageInterface;
}

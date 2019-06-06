<?php

declare(strict_types = 1);

namespace drupol\phptree\Storage;

use drupol\phptree\Node\NodeInterface;

/**
 * Class NodeStorage.
 *
 * @internal
 */
final class NodeStorage extends Storage implements NodeStorageInterface
{
    /**
     * NodeStorage constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->set('children', new \ArrayObject());
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren()
    {
        return $this->get('children');
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): ?NodeInterface
    {
        return $this->get('parent');
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(?NodeInterface $parent): StorageInterface
    {
        return $this->set('parent', $parent);
    }
}

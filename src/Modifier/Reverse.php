<?php

declare(strict_types = 1);

namespace drupol\phptree\Modifier;

use drupol\phptree\Node\NodeInterface;

/**
 * Class Reverse
 */
class Reverse implements ModifierInterface
{
    /**
     * {@inheritdoc}
     */
    public function modify(NodeInterface $tree): NodeInterface
    {
        $children = new \ArrayObject();
        
        foreach ($tree->children() as $child) {
            $children->append($this->modify($child));
        }

        $newTree = $tree->withChildren();

        for ($i = $children->count()-1; $i >= 0; $i--) {
            $newTree->add($children[$i]);
        }

        return $newTree;
    }
}

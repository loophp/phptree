<?php

declare(strict_types = 1);

namespace drupol\phptree\Render;

use drupol\phptree\Node\NodeInterface;

/**
 * Interface RendererInterface
 */
interface RendererInterface
{
    /**
     * @param \drupol\phptree\Node\NodeInterface $node
     */
    public function render(NodeInterface $node);
}

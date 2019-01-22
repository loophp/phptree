<?php

declare(strict_types = 1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;

/**
 * Interface ExporterInterface.
 */
interface ExporterInterface
{
    /**
     * Export a node into something.
     *
     * @param NodeInterface $node
     *   The node
     *
     * @return mixed
     *   The node exported
     */
    public function export(NodeInterface $node);
}

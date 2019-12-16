<?php

declare(strict_types=1);

namespace drupol\phptree\Exporter;

use drupol\phptree\Node\NodeInterface;

/**
 * Class AbstractExporter.
 */
abstract class AbstractExporter implements ExporterInterface
{
    /**
     * Get a string representation of the node.
     *
     * @param \drupol\phptree\Node\NodeInterface $node
     *   The node.
     *
     * @return string
     *   The node representation.
     */
    protected function getNodeRepresentation(NodeInterface $node): string
    {
        return $node->label();
    }
}

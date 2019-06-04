<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Node;

use drupol\phptree\Exporter\Text;
use drupol\phptree\Node\NodeInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class NodeObjectBehavior.
 *
 * @method shouldHaveSameGraph(NodeInterface $node)
 * @method shouldHaveSameTextExport(string $export)
 */
abstract class NodeObjectBehavior extends ObjectBehavior
{
    /**
     * {@inheritdoc}
     */
    public function getMatchers(): array
    {
        return [
            'haveSameGraph' => function ($subject, $key) {
                $exporterText = new Text();

                $left = $exporterText->export($subject);
                $right = $exporterText->export($key);

                return $left === $right;
            },
            'haveSameTextExport' => function ($subject, $key) {
                $exporterText = new Text();

                $left = $exporterText->export($subject);

                return $left === $key;
            },
        ];
    }
}

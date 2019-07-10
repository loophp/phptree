<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Node;

use drupol\phptree\Exporter\Graph;
use drupol\phptree\Exporter\Text;
use drupol\phptree\Node\NodeInterface;
use Graphp\GraphViz\GraphViz;
use PhpSpec\ObjectBehavior;

/**
 * Class NodeObjectBehavior.
 *
 * @method shouldHaveSameGraph(NodeInterface $node)
 * @method shouldHaveSameTextExport(string $export)
 * @method shouldNotHaveSameTextExport(string $export)
 * @method shouldHaveSameGraphImage(NodeInterface $node)
 * @method shouldHaveSameGraphImageFile(string $filepath)
 */
abstract class NodeObjectBehavior extends ObjectBehavior
{
    /**
     * {@inheritdoc}
     */
    public function getMatchers(): array
    {
        return [
            'haveSameGraph' => static function ($subject, $key) {
                $exporterText = new Text();

                $left = $exporterText->export($subject);
                $right = $exporterText->export($key);

                return $left === $right;
            },
            'haveSameTextExport' => static function ($subject, $key) {
                $exporterText = new Text();

                $left = $exporterText->export($subject);

                return $left === $key;
            },
            'notHaveSameTextExport' => static function ($subject, $key) {
                $exporterText = new Text();

                $left = $exporterText->export($subject);

                return $left !== $key;
            },
            'haveSameGraphImage' => static function ($subject, $key) {
                $exporter = new Graph();

                $left = $exporter->export($subject);
                $right = $exporter->export($key);

                $left = (new GraphViz())->setFormat('png')->createImageFile($left);
                $right = (new GraphViz())->setFormat('png')->createImageFile($right);

                return \file_get_contents($left) === \file_get_contents($right);
            },
            'haveSameGraphImageFile' => static function ($subject, $key) {
                $left = (new GraphViz())->setFormat('png')->createImageFile($subject);

                return \file_get_contents($left) === \file_get_contents($key);
            },
        ];
    }
}

<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Exporter;

use drupol\phptree\Exporter\Graph;
use drupol\phptree\Importer\Text;
use drupol\phptree\Node\AttributeNode;
use drupol\phptree\Node\ValueNode;
use Graphp\GraphViz\GraphViz;
use PhpSpec\ObjectBehavior;

/**
 * Class GraphSpec.
 *
 * @method shouldHaveSameTextExport(string $filepath)
 */
class GraphSpec extends ObjectBehavior
{
    /**
     * {@inheritdoc}
     */
    public function getMatchers(): array
    {
        return [
            'haveSameTextExport' => function ($left, $right) {
                $importer = new Text();
                $exporter = new Graph();

                $right = $exporter->export($importer->import($right));

                return (new GraphViz())->createImageSrc($left) === (new GraphViz())->createImageSrc($right);
            },
        ];
    }

    public function it_can_generate_a_graph()
    {
        $tree = new AttributeNode(['graphviz.label' => 'root']);
        $child1 = new ValueNode('child1');
        $child2 = new ValueNode('child2');
        $child3 = new ValueNode('child3');
        $child4 = new ValueNode('child4');
        $child1->add($child4);

        $tree
            ->add($child1, $child2, $child3);

        $this
            ->export($tree)
            ->shouldReturnAnInstanceOf(\Fhaculty\Graph\Graph::class);

        $this
            ->export($child1)
            ->shouldReturnAnInstanceOf(\Fhaculty\Graph\Graph::class);

        $this
            ->export($tree)
            ->shouldHaveSameTextExport('[root[child1[child4]][child2][child3]]');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Graph::class);
    }
}

<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\phptree\Exporter;

use Graphp\GraphViz\GraphViz;
use loophp\phptree\Exporter\Graph;
use loophp\phptree\Importer\Text;
use loophp\phptree\Node\AttributeNode;
use loophp\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

/**
 * Class GraphSpec.
 *
 * @method shouldHaveSameTextExport(string $filepath)
 */
class GraphSpec extends ObjectBehavior
{
    public function getMatchers(): array
    {
        return [
            'haveSameTextExport' => static function ($left, $right) {
                $right = (new Graph())->export((new Text())->import($right)[0]);

                return (new GraphViz())->createImageSrc($left) === (new GraphViz())->createImageSrc($right);
            },
        ];
    }

    public function it_can_generate_a_graph(): void
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

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Graph::class);
    }
}

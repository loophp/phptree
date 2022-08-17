<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\loophp\phptree\Node;

use ArrayIterator;
use InvalidArgumentException;
use loophp\phptree\Exporter\Text;
use loophp\phptree\Node\ValueNode;
use OutOfBoundsException;

class ValueNodeSpec extends NodeObjectBehavior
{
    public function it_can_be_cloned(): void
    {
        $this->beConstructedWith(2);

        $node1 = new ValueNode(mt_rand());
        $node2 = new ValueNode(mt_rand());
        $node3 = new ValueNode(mt_rand());
        $node4 = new ValueNode(mt_rand());

        $this
            ->add($node1->add($node2), $node3->add($node4));

        $exporter = new Text();

        $export = $exporter->export($this->getWrappedObject()->clone());

        $this->shouldHaveSameTextExport($export);
    }

    public function it_can_be_manipulated_like_an_array(): void
    {
        $this
            ->beConstructedWith('root', 26);

        $tree = $this->getWrappedObject();

        foreach (range('A', 'Z') as $value) {
            $tree[] = new ValueNode($value, 3);
        }

        foreach ($tree->children() as $key => $child) {
            $tree[$key] = new ValueNode(mb_strtolower($child->getValue()));
        }

        $tree[25] = new ValueNode('Foo');

        $export = '[root[a][b][c][d][e][f][g][h][i][j][k][l][m][n][o][p][q][r][s][t][u][v][w][x][y][Foo]]';
        $this->shouldHaveSameTextExport($export);

        unset($tree[25]);
        $export = '[root[a][b][c][d][e][f][g][h][i][j][k][l][m][n][o][p][q][r][s][t][u][v][w][x][y]]';
        $this->shouldHaveSameTextExport($export);

        $this->shouldThrow(OutOfBoundsException::class)->during('offsetSet', [30, new ValueNode('out')]);
        $this->shouldThrow(OutOfBoundsException::class)->during('offsetSet', [26, new ValueNode('out')]);

        $this->offsetGet(0)->getValue()->shouldReturn('a');

        $this->offsetSet(0, new ValueNode('zero'));
        $this->offsetGet(0)->getValue()->shouldReturn('zero');

        $this->shouldThrow(InvalidArgumentException::class)->during('offsetSet', [0, 'This is not a node']);
        $this->offsetGet(0)->getValue()->shouldReturn('zero');
    }

    public function it_can_be_set_with_a_value(): void
    {
        $this
            ->beConstructedWith('root');

        $this
            ->getValue()
            ->shouldReturn('root');
    }

    public function it_can_draw_the_tree(): void
    {
        $this
            ->beConstructedWith('root', 3);

        foreach (range(0, 30) as $number) {
            $this->add(new ValueNode($number, 2));
        }

        $this
            ->shouldHaveSameGraphImage($this->getWrappedObject());
    }

    public function it_can_have_children(): void
    {
        $this
            ->beConstructedWith('root', 2);

        $tree = new ValueNode('root', 2);

        foreach (range('A', 'Z') as $value) {
            $this[] = new ValueNode($value, 3);
            $tree->add(new ValueNode($value, 3));
        }

        $export = '[root[A[C[I][J][K]][D[L][M][N]][E[O][P][Q]]][B[F[R][S][T]][G[U][V][W]][H[X][Y][Z]]]]';

        $this->shouldHaveSameTextExport($export);
        $this->shouldHaveSameGraph($tree);
    }

    public function it_can_remove(): void
    {
        $this
            ->beConstructedWith('root');

        $node1 = new ValueNode('A');
        $node2 = new ValueNode('B');
        $node3 = new ValueNode('C');

        $this
            ->add($node1, $node2);

        $this->shouldHaveSameTextExport('[root[A][B]]');

        $this
            ->remove($node2);

        $this->shouldHaveSameTextExport('[root[A]]');
        $this
            ->count()
            ->shouldReturn(1);

        $this
            ->remove($node1);
        $this->shouldHaveSameTextExport('[root]');

        $this
            ->remove($node3);

        $this
            ->count()
            ->shouldReturn(0);
    }

    public function it_can_replace_a_node_with_another_one()
    {
        $this
            ->beConstructedWith('root');

        $node1 = new ValueNode('A');
        $node2 = new ValueNode('B');
        $node3 = new ValueNode('C');

        $this
            ->add($node1, $node2, $node3);

        $node4 = new ValueNode('D');

        $this
            ->offsetGet(0)
            ->replace($node4);

        $this->shouldHaveSameTextExport('[root[D][B][C]]');

        $this
            ->replace($node4)
            ->shouldReturn(null);
    }

    public function it_is_initializable(): void
    {
        $this
            ->beConstructedWith('root');

        $this->shouldHaveType(ValueNode::class);

        $this->children()->shouldYield(new ArrayIterator([]));

        $export = '[root]';
        $this->shouldHaveSameTextExport($export);
    }
}

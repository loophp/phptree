<?php

declare(strict_types = 1);

namespace spec\drupol\phptree\Exporter;

use drupol\phptree\Exporter\Ascii;
use drupol\phptree\Node\Node;
use drupol\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class AsciiSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Ascii::class);
    }

    public function it_can_export_to_ascii()
    {
        $tree = new ValueNode('root', 2);

        foreach (\range('A', 'Z') as $key => $value) {
            $nodes[$value] = new ValueNode($value, 2);
        }

        $tree->add(...\array_values($nodes));

        $expected = <<<EOF
├─ root
└─┐
  ├─┐
  │ ├─ A
  │ └─┐
  │   ├─┐
  │   │ ├─ C
  │   │ └─┐
  │   │   ├─┐
  │   │   │ ├─ G
  │   │   │ └─┐
  │   │   │   ├─┐
  │   │   │   │ └─ O
  │   │   │   └─┐
  │   │   │     └─ P
  │   │   └─┐
  │   │     ├─ H
  │   │     └─┐
  │   │       ├─┐
  │   │       │ └─ Q
  │   │       └─┐
  │   │         └─ R
  │   └─┐
  │     ├─ D
  │     └─┐
  │       ├─┐
  │       │ ├─ I
  │       │ └─┐
  │       │   ├─┐
  │       │   │ └─ S
  │       │   └─┐
  │       │     └─ T
  │       └─┐
  │         ├─ J
  │         └─┐
  │           ├─┐
  │           │ └─ U
  │           └─┐
  │             └─ V
  └─┐
    ├─ B
    └─┐
      ├─┐
      │ ├─ E
      │ └─┐
      │   ├─┐
      │   │ ├─ K
      │   │ └─┐
      │   │   ├─┐
      │   │   │ └─ W
      │   │   └─┐
      │   │     └─ X
      │   └─┐
      │     ├─ L
      │     └─┐
      │       ├─┐
      │       │ └─ Y
      │       └─┐
      │         └─ Z
      └─┐
        ├─ F
        └─┐
          ├─┐
          │ └─ M
          └─┐
            └─ N

EOF;

        $this
            ->export($tree)
            ->shouldReturn($expected);
    }

    public function it_can_throw_an_error_when_tree_is_not_a_valuenode()
    {
        $tree = new Node();

        foreach (\range('A', 'Z') as $key => $value) {
            $nodes[$value] = new Node();
        }

        $tree->add(...\array_values($nodes));

        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('export', [$tree]);
    }
}

<?php

declare(strict_types=1);

namespace spec\loophp\phptree\Exporter;

use loophp\phptree\Exporter\Ascii;
use loophp\phptree\Node\ValueNode;
use PhpSpec\ObjectBehavior;

class AsciiSpec extends ObjectBehavior
{
    public function it_can_export_to_ascii(): void
    {
        $tree = new ValueNode('root', 2);

        foreach (range('A', 'Z') as $key => $value) {
            $nodes[$value] = new ValueNode($value, 2);
        }

        $tree->add(...array_values($nodes));

        $expected = <<<'EOF'
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

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(Ascii::class);
    }
}
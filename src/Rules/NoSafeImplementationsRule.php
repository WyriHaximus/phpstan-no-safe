<?php

declare(strict_types=1);

namespace WyriHaximus\PHPStan\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

use function str_replace;
use function str_starts_with;
use function strtolower;
use function substr;

/**
 * This rule checks that functions and classes from `thecodingmachine/safe` are not used in code.
 *
 * @implements Rule<Node\Expr>
 */
final readonly class NoSafeImplementationsRule implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr::class;
    }

    /** @inheritDoc */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($node instanceof Node\Expr\FuncCall && $node->name instanceof Node\Name) {
            $kind = 'Function';
            $name = $node->name->toString();
        } elseif ($node instanceof Node\Expr\New_ && $node->class instanceof Node\Name) {
            $kind = 'Class';
            $name = $node->class->toString();
        } elseif ($node instanceof Node\Expr\StaticCall && $node->class instanceof Node\Name) {
            $kind = 'Class';
            $name = $node->class->toString();
        } elseif ($node instanceof Node\Expr\ClassConstFetch && $node->class instanceof Node\Name) {
            $kind = 'Class';
            $name = $node->class->toString();
        } elseif ($node instanceof Node\Expr\Instanceof_ && $node->class instanceof Node\Name) {
            $kind = 'Class';
            $name = $node->class->toString();
        } else {
            return [];
        }

        if (! str_starts_with($name, 'Safe\\')) {
            return [];
        }

        $bareName = substr($name, 5);

        return [
            RuleErrorBuilder::message(
                $kind . ' "' . $name . '" is not allowed. Use "' . $bareName . '" instead and follow PHPStan\'s warnings.',
            )->identifier(
                'wyrihaximus.no.safe.' . str_replace('_', '.', strtolower($bareName)),
            )->build(),
        ];
    }
}

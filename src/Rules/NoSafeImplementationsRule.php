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
 * This rule checks that functions from `thecodingmachine/safe` are used in code.
 *
 * @implements Rule<Node\Expr\FuncCall>
 */
final readonly class NoSafeImplementationsRule implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\FuncCall::class;
    }

    /** @inheritDoc */
    public function processNode(Node $node, Scope $scope): array
    {
        if (! $node->name instanceof Node\Name) {
            return [];
        }

        $functionName = $node->name->toString();

        if (str_starts_with($functionName, 'Safe\\')) {
            $bareFunctionName = substr($functionName, 5);

            return [
                RuleErrorBuilder::message(
                    'Function "' . $functionName . '" is not allowed. Use "' . $bareFunctionName . '" instead and follow PHPStan\'s warnings.',
                )->identifier(
                    'wyrihaximus.no.safe.' . str_replace('_', '.', strtolower($bareFunctionName)),
                )->build(),
            ];
        }

        return [];
    }
}

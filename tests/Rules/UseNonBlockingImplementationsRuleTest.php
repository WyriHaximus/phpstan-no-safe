<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\PHPStan\Rules;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use WyriHaximus\PHPStan\Rules\NoSafeImplementationsRule;

/** @template-extends RuleTestCase<NoSafeImplementationsRule> */
final class UseNonBlockingImplementationsRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoSafeImplementationsRule();
    }

    #[Test]
    public function good(): void
    {
        $this->analyse([__DIR__ . '/files/good.php'], []);
    }

    /** @return iterable<array<int, string|int>> */
    public static function listAllTheBadFiles(): iterable
    {
        yield 'bad' => [__DIR__ . '/files/bad.php', 7];
        yield 'bad-use-function' => [__DIR__ . '/files/bad-use-function.php', 7];
    }

    #[DataProvider('listAllTheBadFiles')]
    #[Test]
    public function bad(string $file, int $line): void
    {
        $this->analyse([$file], [
            [
                'Function "Safe\json_decode" is not allowed. Use "json_decode" instead and follow PHPStan\'s warnings.',
                $line,
            ],
        ]);
    }
}

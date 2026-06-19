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

    /** @return iterable<array<int, string>> */
    public static function listAllTheBadFiles(): iterable
    {
        yield 'bad' => [__DIR__ . '/files/bad.php'];
        yield 'bad-use-function' => [__DIR__ . '/files/bad-use-function.php'];
    }

    #[DataProvider('listAllTheBadFiles')]
    #[Test]
    public function bad(string $file): void
    {
        $this->analyse([$file], []);
    }
}

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

    /** @return iterable<string, array{0: string, 1: int, 2: string}> */
    public static function listAllTheBadFiles(): iterable
    {
        $classMessage    = 'Class "Safe\DateTimeImmutable" is not allowed. Use "DateTimeImmutable" instead and follow PHPStan\'s warnings.';
        $functionMessage = 'Function "Safe\json_decode" is not allowed. Use "json_decode" instead and follow PHPStan\'s warnings.';

        yield 'bad' => [__DIR__ . '/files/bad.php', 7, $functionMessage];
        yield 'bad-use-function' => [__DIR__ . '/files/bad-use-function.php', 7, $functionMessage];
        yield 'class' => [__DIR__ . '/files/class.php', 7, $classMessage];
        yield 'class-static-call' => [__DIR__ . '/files/class-static-call.php', 7, $classMessage];
        yield 'class-const-fetch' => [__DIR__ . '/files/class-const-fetch.php', 7, $classMessage];
        yield 'class-instanceof' => [__DIR__ . '/files/class-instanceof.php', 7, $classMessage];
    }

    #[DataProvider('listAllTheBadFiles')]
    #[Test]
    public function bad(string $file, int $line, string $message): void
    {
        $this->analyse([$file], [
            [
                $message,
                $line,
            ],
        ]);
    }

    /** @return iterable<string, array{0: string, 1: string}> */
    public static function listAllTheIdentifiers(): iterable
    {
        yield 'function' => [__DIR__ . '/files/bad.php', 'wyrihaximus.no.safe.json.decode'];
        yield 'class' => [__DIR__ . '/files/class.php', 'wyrihaximus.no.safe.datetimeimmutable'];
    }

    #[DataProvider('listAllTheIdentifiers')]
    #[Test]
    public function identifier(string $file, string $expectedIdentifier): void
    {
        $errors = $this->gatherAnalyserErrors([$file]);

        self::assertCount(1, $errors);
        self::assertSame($expectedIdentifier, $errors[0]->getIdentifier());
    }
}

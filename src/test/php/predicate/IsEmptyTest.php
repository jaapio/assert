<?php
declare(strict_types=1);
/**
 * This file is part of bovigo\assert.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace bovigo\assert\predicate;
use bovigo\assert\AssertionFailure;
use PHPUnit\Framework\TestCase;

use function bovigo\assert\{
    assertThat,
    assertEmpty,
    assertFalse,
    assertNotEmpty,
    assertTrue,
    expect
};
/**
 * Tests for bovigo\assert\predicate\IsEmpty.
 *
 * @group  predicate
 */
class IsEmptyTest extends TestCase
{
    /**
     * @return  array<string,array<mixed>>
     */
    public function emptyValues(): array
    {
        return [
            'null'                  => [null],
            'boolean false'         => [false],
            'empty string'          => [''],
            'empty array'           => [[]],
            'integer 0'             => [0],
            'Countable with size 0' => [new IsEmptyCountableExample(0)]
        ];
    }

    /**
     * @param  mixed  $emptyValue
     * @test
     * @dataProvider  emptyValues
     */
    public function evaluatesToTrueIfGivenValueIsEmpty($emptyValue): void
    {
        assertTrue(isEmpty()->test($emptyValue));
    }

    /**
     * @return  array<string,array<mixed>>
     */
    public function nonEmptyValues(): array
    {
        return [
            'boolean true'            => [true],
            'non-empty string'        => ['foo'],
            'non-empty array'         => [[1]],
            'Countable with size > 0' => [new IsEmptyCountableExample(1)]
        ];
    }

    /**
     * @param  mixed  $nonEmptyValue
     * @test
     * @dataProvider  nonEmptyValues
     */
    public function evaluatesToFalseIfGivenValueIsNotEmpty($nonEmptyValue): void
    {
        assertFalse(isEmpty()->test($nonEmptyValue));
    }

    /**
     * @test
     */
    public function stringRepresentation(): void
    {
        assertThat((string) new IsEmpty(), equals('is empty'));
    }

    /**
     * @test
     */
    public function assertionFailureWithStringContainsMeaningfulInformation(): void
    {
        expect(function() { assertEmpty('foo'); })
                ->throws(AssertionFailure::class)
                ->withMessage("Failed asserting that 'foo' is empty.");
    }

    /**
     * @test
     */
    public function assertionFailureWithIntegerContainsMeaningfulInformation(): void
    {
        expect(function() { assertEmpty(1); })
                ->throws(AssertionFailure::class)
                ->withMessage("Failed asserting that 1 is empty.");
    }

    /**
     * @test
     */
    public function assertionFailureWithBooleanContainsMeaningfulInformation(): void
    {
       expect(function() { assertEmpty(true); })
                ->throws(AssertionFailure::class)
               ->withMessage("Failed asserting that true is empty.");
    }

    /**
     * @test
     */
    public function assertionFailureWithArrayContainsMeaningfulInformation(): void
    {
         expect(function() { assertEmpty(['foo']); })
                ->throws(AssertionFailure::class)
                 ->withMessage("Failed asserting that an array is empty.");
    }

    /**
     * @test
     */
    public function assertionFailureWithCountableContainsMeaningfulInformation(): void
    {
        expect(function() { assertEmpty(new IsEmptyCountableExample(1)); })
                ->throws(AssertionFailure::class)
                ->withMessage(
                        "Failed asserting that " . IsEmptyCountableExample::class
                        . " implementing \Countable is empty."
        );
    }

    /**
     * @test
     * @since  1.3.0
     */
    public function aliasAssertNotEmpty(): void
    {
        assertTrue(assertNotEmpty(303));
    }
}

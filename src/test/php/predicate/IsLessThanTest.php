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

use function bovigo\assert\assertFalse;
use function bovigo\assert\assertThat;
use function bovigo\assert\assertTrue;
use function bovigo\assert\expect;
/**
 * Tests for bovigo\assert\predicate\IsLessThan.
 *
 * @group  predicate
 */
class IsLessThanTest extends TestCase
{
    /**
     * @test
     */
    public function evaluatesToTrueIfGivenValueIsSmaller(): void
    {
        assertTrue(isLessThan(3)->test(2));
    }

    /**
     * @test
     */
    public function evaluatesToFalseIfGivenValueIsEqual(): void
    {
        assertFalse(isLessThan(3)->test(3));
    }

    /**
     * @test
     */
    public function evaluatesToFalseIfGivenValueIsGreater(): void
    {
        assertFalse(isLessThan(3)->test(4));
    }

    /**
     * @test
     */
    public function evaluatesToTrueWhenCombinedWithEqualsIfGivenValueIsSmaller(): void
    {
        assertTrue(isLessThanOrEqualTo(3)->test(2));
    }

    /**
     * @test
     */
    public function evaluatesToFalseWhenCombinedWithEqualsIfGivenValueIsEqual(): void
    {
        assertTrue(isLessThanOrEqualTo(3)->test(3));
    }

    /**
     * @test
     */
    public function evaluatesToFalseWhenCombinedWithEqualsIfGivenValueIsGreater(): void
    {
        assertFalse(isLessThanOrEqualTo(3)->test(4));
    }

    /**
     * @test
     */
    public function assertionFailureContainsMeaningfulInformation(): void
    {
        expect(function() { assertThat(3, isLessThan(2)); })
                ->throws(AssertionFailure::class)
                ->withMessage("Failed asserting that 3 is less than 2.");
    }

    /**
     * @test
     */
    public function assertionFailureWhenCombinedWithEqualsContainsMeaningfulInformation(): void
    {
        expect(function() { assertThat(3, isLessThanOrEqualTo(2)); })
                ->throws(AssertionFailure::class)
                ->withMessage(
                        "Failed asserting that 3 is equal to 2 or is less than 2."
        );
    }
}

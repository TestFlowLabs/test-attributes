<?php

declare(strict_types=1);

namespace TestFlowLabs\TestingAttributes;

use Attribute;

/**
 * Marks a production method as being tested by a specific test case.
 *
 * This attribute is used on production code (not test code) to create
 * bidirectional links between production methods and their tests.
 *
 * Usage:
 *
 *     use TestFlowLabs\TestingAttributes\TestedBy;
 *
 *     class UserService
 *     {
 *         #[TestedBy(UserServiceTest::class, 'test_creates_user')]
 *         public function create(string $name): User
 *         {
 *             // ...
 *         }
 *     }
 *
 * For Pest tests, use the test description:
 *
 *     #[TestedBy('Tests\Unit\UserServiceTest', 'it creates a user')]
 */
#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final readonly class TestedBy
{
    public string $testIdentifier;

    /**
     * @param  class-string  $testClass  The fully qualified class name of the test class
     * @param  string|null  $testMethod  The test method name (optional for class-level coverage)
     */
    public function __construct(
        public string $testClass,
        public ?string $testMethod = null,
    ) {
        $this->testIdentifier = $testMethod !== null
            ? $testClass.'::'.$testMethod
            : $testClass;
    }

    /**
     * Check if this is a class-level link (no specific method).
     */
    public function isClassLevel(): bool
    {
        return $this->testMethod === null;
    }

    /**
     * Get the test identifier in the format "TestClass::testMethod".
     */
    public function getTestIdentifier(): string
    {
        return $this->testIdentifier;
    }
}

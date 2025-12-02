<?php

declare(strict_types=1);

namespace TestFlowLabs\TestingAttributes;

use Attribute;

/**
 * Links a test to a production method AND triggers code coverage.
 *
 * This attribute creates a traceability link between a test and the production
 * code it covers, AND includes the method in PHPUnit/Pest code coverage reporting.
 *
 * Usage on PHPUnit test methods:
 *
 *     #[LinksAndCovers(UserService::class, 'create')]
 *     public function testCreatesUser(): void { }
 *
 *     // Multiple methods:
 *     #[LinksAndCovers(UserService::class, 'create')]
 *     #[LinksAndCovers(UserService::class, 'validate')]
 *     public function testCreatesAndValidatesUser(): void { }
 *
 *     // Class-level coverage:
 *     #[LinksAndCovers(UserService::class)]
 *     public function testUserService(): void { }
 */
#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final readonly class LinksAndCovers
{
    public string $methodIdentifier;

    /**
     * @param  class-string  $class  The production class being tested
     * @param  string|null  $method  The method name (optional for class-level coverage)
     */
    public function __construct(
        public string $class,
        public ?string $method = null,
    ) {
        $this->methodIdentifier = $method !== null
            ? $class.'::'.$method
            : $class;
    }

    /**
     * Check if this is a class-level link (no specific method).
     */
    public function isClassLevel(): bool
    {
        return $this->method === null;
    }

    /**
     * Get the formatted method identifier.
     */
    public function getMethodIdentifier(): string
    {
        return $this->methodIdentifier;
    }
}

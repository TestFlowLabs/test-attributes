<?php

declare(strict_types=1);

namespace TestFlowLabs\TestingAttributes;

use Attribute;

/**
 * Links a test to a production method for traceability only (no coverage).
 *
 * This attribute creates a traceability link between a test and the production
 * code it relates to, but does NOT include the method in code coverage reporting.
 *
 * Use this for:
 * - Integration tests where unit tests already provide coverage
 * - E2E tests that exercise multiple methods
 * - Documentation purposes (showing test-to-code relationships)
 *
 * Usage on PHPUnit test methods:
 *
 *     #[Links(UserService::class, 'create')]
 *     public function testCreatesUserIntegration(): void { }
 *
 *     // Multiple methods:
 *     #[Links(UserService::class, 'create')]
 *     #[Links(OrderService::class, 'process')]
 *     public function testFullCheckoutFlow(): void { }
 */
#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final readonly class Links
{
    public string $methodIdentifier;

    /**
     * @param  class-string  $class  The production class being tested
     * @param  string|null  $method  The method name (optional for class-level link)
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

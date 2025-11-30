<?php

declare(strict_types=1);

namespace TestFlowLabs\PestTestAttributes;

use Attribute;

/**
 * Marks a class or method as being tested by a specific test class/case.
 *
 * This attribute enables bidirectional navigation between production code
 * and tests in IDEs that support PHP 8 attributes.
 */
#[Attribute(
    Attribute::TARGET_CLASS |
    Attribute::TARGET_METHOD |
    Attribute::IS_REPEATABLE
)]
final readonly class TestedBy
{
    /**
     * @param  class-string  $test  The test class that tests this code
     * @param  string|null  $name  The specific test name (optional)
     */
    public function __construct(
        public string $test,
        public ?string $name = null,
    ) {}
}

<?php

declare(strict_types=1);

namespace TestFlowLabs\TestingAttributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION | Attribute::IS_REPEATABLE)]
final readonly class Then
{
    public function __construct(
        public string $pattern
    ) {}
}

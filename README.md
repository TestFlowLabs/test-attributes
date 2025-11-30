# Pest Test Attributes

> PHP 8 attributes for Pest PHP testing - BDD steps and coverage linking

[![PHP Version](https://img.shields.io/badge/php-%5E8.1-blue)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

This package provides lightweight PHP 8 attributes for use with Pest PHP testing framework.

## Installation

```bash
composer require testflowlabs/pest-test-attributes
```

## Attributes

### BDD Step Attributes

`#[Given]`, `#[When]`, `#[Then]` attributes for Behavior-Driven Development step definitions.

```php
use TestFlowLabs\PestTestAttributes\Given;
use TestFlowLabs\PestTestAttributes\When;
use TestFlowLabs\PestTestAttributes\Then;

class UserFactory extends Factory
{
    #[Given('a user exists')]
    public function definition(): array
    {
        return ['name' => fake()->name()];
    }
}

class CreateOrder
{
    #[When('I place an order')]
    public function execute(User $user): Order
    {
        return Order::create(['user_id' => $user->id]);
    }
}

class OrderAssertions
{
    #[Then('the order should be confirmed')]
    public function shouldBeConfirmed(Order $order): void
    {
        expect($order->status)->toBe('confirmed');
    }
}
```

#### Multi-Language Support

Use repeatable attributes for the same step in multiple languages:

```php
#[Given('a user exists')]
#[Given('bir kullanici mevcut')]    // Turkish
#[Given('ein Benutzer existiert')]  // German
public function definition(): array
{
    return ['name' => fake()->name()];
}
```

### TestedBy Attribute

`#[TestedBy]` marks production code as being tested by specific test classes, enabling bidirectional navigation.

```php
use TestFlowLabs\PestTestAttributes\TestedBy;
use Tests\Unit\ApplicationTest;

class Application extends Model
{
    #[TestedBy(ApplicationTest::class)]
    public function lastDecision(): HasOne
    {
        return $this->hasOne(Decision::class)->latestOfMany();
    }

    #[TestedBy(ApplicationTest::class, 'approves application when credit score is 700 or above')]
    #[TestedBy(ApplicationTest::class, 'rejects application when credit score is below 700')]
    public function approve(): bool
    {
        return $this->creditScore >= 700;
    }
}
```

#### IDE Benefits

```php
#[TestedBy(ApplicationTest::class)]
//         ↑
//         Ctrl+Click → Navigates to test file
//         Rename class → Automatically updates
//         PHPStan → Validates class exists
```

## Why Separate Package?

This package is designed to be used as a **required** dependency in production code, while testing plugins remain **dev** dependencies.

```json
{
    "require": {
        "testflowlabs/pest-test-attributes": "^1.0"
    },
    "require-dev": {
        "testflowlabs/pest-plugin-bdd": "^1.0",
        "testflowlabs/pest-plugin-test-link": "^1.0"
    }
}
```

This allows you to annotate production code with attributes without pulling in test runners.

## Attribute Reference

| Attribute | Target | Purpose |
|-----------|--------|---------|
| `#[Given('pattern')]` | Method/Function | BDD step - Arrange/Setup |
| `#[When('pattern')]` | Method/Function | BDD step - Act/Execute |
| `#[Then('pattern')]` | Method/Function | BDD step - Assert/Verify |
| `#[TestedBy(Test::class, 'name')]` | Class/Method | Coverage linking |

All attributes are repeatable for flexibility.

## License

MIT License. See [LICENSE](LICENSE) for details.

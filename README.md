# Pest Test Attributes

> PHP 8 attributes for Pest PHP testing

[![PHP Version](https://img.shields.io/badge/php-%5E8.1-blue)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

Lightweight PHP 8 attributes for use with Pest PHP testing plugins.

## Installation

```bash
composer require testflowlabs/pest-test-attributes
```

## Attributes

| Attribute | Target | Purpose | Used By |
|-----------|--------|---------|---------|
| `#[Given]` | Method/Function | BDD step - Arrange | `pest-plugin-bdd` |
| `#[When]` | Method/Function | BDD step - Act | `pest-plugin-bdd` |
| `#[Then]` | Method/Function | BDD step - Assert | `pest-plugin-bdd` |
| `#[TestedBy]` | Class/Method | Coverage linking | `pest-plugin-test-link` |

All attributes are repeatable.

## Why Separate Package?

This package is a **production** dependency, while testing plugins remain **dev** dependencies.

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

This allows annotating production code with attributes without pulling in test runners.

## License

MIT License. See [LICENSE](LICENSE) for details.

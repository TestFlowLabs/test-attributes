# Test Attributes

> PHP 8 attributes for testing - BDD steps and test traceability

[![PHP Version](https://img.shields.io/badge/php-%5E8.3-blue)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

Lightweight PHP 8 attributes for use with testing plugins.

## Installation

```bash
composer require testflowlabs/test-attributes
```

## Attributes

| Attribute | Target | Purpose | Used By |
|-----------|--------|---------|---------|
| `#[Given]` | Method/Function | BDD step - Arrange | `testflowlabs/pest-plugin-bdd` |
| `#[When]` | Method/Function | BDD step - Act | `testflowlabs/pest-plugin-bdd` |
| `#[Then]` | Method/Function | BDD step - Assert | `testflowlabs/pest-plugin-bdd` |
| `#[TestedBy]` | Method | Mark production method as tested by specific test | `testflowlabs/testlink` |
| `#[Links]` | Method | Link test to production code (traceability only) | `testflowlabs/testlink` |
| `#[LinksAndCovers]` | Method | Link test to production code + coverage | `testflowlabs/testlink` |

All attributes are repeatable.

## Why Separate Package?

This package is a **production** dependency, while testing plugins remain **dev** dependencies.

```json
{
    "require": {
        "testflowlabs/test-attributes": "^1.0"
    },
    "require-dev": {
        "testflowlabs/pest-plugin-bdd": "^0.1",
        "testflowlabs/testlink": "^0.1"
    }
}
```

This allows annotating code with attributes without pulling in test runners.

## License

MIT License. See [LICENSE](LICENSE) for details.

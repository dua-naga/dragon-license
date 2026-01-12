# Dragon License

Laravel Package for Dua Naga License Management.

## Installation

Add the package to your `composer.json` repositories:

```json
"repositories": [
    {
        "type": "path",
        "url": "./packages/dragon-license"
    }
]
```

Then require the package:

```bash
composer require dua-naga/dragon-license
```

## Configuration

Set the license server URL in your `.env` file:

```
DRAGON_LICENSE_URL=https://your-license-server.com
```

## Features

- License validation
- Installation wizard
- Database migration
- Environment configuration
- Upgrade management

# Dragon License

Laravel Package for Dua Naga License Management. Provides license validation, installation wizard, and upgrade management for Laravel applications.

## Requirements

- PHP >= 8.1
- Laravel ^11.0

## Installation

### Via Composer (Path Repository)

Add the package to your `composer.json` repositories:

```json
"repositories": [
    {
        "type": "path",
        "url": "../dragon-license",
        "options": {
            "symlink": true
        }
    }
]
```

Then require the package:

```bash
composer require dua-naga/dragon-license:@dev
```

### Via GitHub

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/dua-naga/dragon-license.git"
    }
]
```

```bash
composer require dua-naga/dragon-license:dev-main
```

## Configuration

Publish the config file (optional):

```bash
php artisan vendor:publish --tag=dragon-license-config
```

### Config Options

Edit `config/dragon-license.php`:

```php
return [
    'server_url' => 'https://your-license-server.com',
    'endpoints' => [
        'check' => '/api/license/checking',
        'credential' => '/api/license/get-credential',
        'versions' => '/api/upgrade/versions',
        'download' => '/api/upgrade/download',
    ],
    'business_id' => 'your-business-id',
    'offline_mode' => false,
];
```

## Middleware

The package provides these middleware:

| Middleware | Description |
|------------|-------------|
| `active_session` | Validates license exists and verifies with server |
| `is_license` | Redirects if license already exists |
| `install` | Checks if installation is needed |
| `update` | Checks if update is available |

### Usage in Routes

```php
Route::middleware(['web', 'auth', 'active_session'])
    ->prefix('admin')
    ->group(base_path('routes/admin.php'));
```

## Routes

The package registers these routes:

| Route | Description |
|-------|-------------|
| `/license-key` | License activation page |
| `/license-key/insert-key` | Enter license form |
| `/app-license/update` | Update license page |
| `/install` | Installation wizard |
| `/install/license` | License step |
| `/install/requirements` | Requirements check |
| `/install/permissions` | Folder permissions |
| `/install/environment` | Environment setup |
| `/install/final` | Finish installation |

## Views

Views are loaded from the package automatically. To customize, publish them:

```bash
php artisan vendor:publish --tag=dragon-license-views
```

Views will be published to `resources/views/vendor/dragon-license/`.

## Helper Functions

```php
dragon_license_url();
dragon_check_connection();
```

## Database

The package expects a `licenses` table with these columns:

```php
Schema::create('licenses', function (Blueprint $table) {
    $table->id();
    $table->string('name')->nullable();
    $table->string('email');
    $table->string('purchase');
    $table->string('ip_or_domain')->nullable();
    $table->string('version_name')->nullable();
    $table->integer('version_code')->nullable();
    $table->string('type')->default('online');
    $table->timestamps();
});
```

## License Verification Flow

1. **Offline Mode (`offline_mode: true`)**
   - License is stored locally
   - No server verification required

2. **Online Mode (`offline_mode: false`)**
   - Checks connection to license server
   - Verifies license with server on each request
   - Blocks access if verification fails

## Customization

### License Model

The package uses `App\Models\Admin\License`. Ensure this model exists in your application.

### Business ID

Set your business ID in config to match your license server registration:

```php
'business_id' => 'your-registered-business-id',
```
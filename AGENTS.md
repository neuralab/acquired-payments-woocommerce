# Acquired.com for WooCommerce

## Commands

| Task | Command |
|---|---|
| PHP lint (WPCS) | `composer lint` |
| PHP lint, auto-fix | `composer fix` |
| Static analysis | `composer analyse` |
| Unit tests | `composer test` |
| JS lint | `npm run lint:js` |
| Build JS | `npx mix --production` |
| Translation template | `composer create-pot` |

CI (`.github/workflows/lint-and-test.yml`) runs JS lint, PHP lint and PHP tests on pushes and PRs to `main` and `staging`. PHPStan isn't in CI yet.

## Code layout

- `acquired-com-for-woocommerce.php`: entry file. Defines the `ACFW_*` constants, checks PHP/WooCommerce versions, loads `src/bootstrap.php`.
- `src/bootstrap.php`: PHP-DI container. New services are registered here (`autowire()` or a factory).
- `src/Observers/`: all WordPress/WooCommerce hook registration, one observer per area.
- `src/Services/`: business logic. `src/Api/ApiClient.php`: Guzzle calls to the Acquired API. `src/Api/Response/`: one class per API response type.
- `src/WooCommerce/PaymentGateway.php`: the gateway. `src/WooCommerce/PaymentMethod.php`: block checkout integration.
- `assets/src/js/` is compiled by Laravel Mix into `assets/dist/js/`.

## Conventions

- WordPress Coding Standards (`phpcs.xml`). Every PHP file starts with `declare( strict_types = 1 );`, namespace `AcquiredComForWooCommerce\`.
- Every `src/` class has a matching test in `tests/Unit/` (PHPUnit 11 + Brain Monkey). Add or update the test with the change.
- Inline linter/analyser ignores name the rule only, no reason text: `// @phpstan-ignore if.alwaysFalse`.

## PHPStan

- Config: `phpstan.neon`. Run `composer analyse` at the level set there and fix what it reports. Don't change the level or pass `--level`.
- `stubs/` holds declarations PHPStan can't find on its own, loaded through `scanFiles`. It's excluded from PHPCS.
- Plugin constants defined with a WordPress function call (`plugin_dir_path()` etc.) need a `define()` in `stubs/acfw-constants.php` and an entry in `dynamicConstantNames`. Constants defined with literals don't.
- Optional third-party plugins the code calls into (TeraWallet) get a stub in `stubs/`.

## Dependencies

- Update Composer and npm dependencies within their current major version only. Don't change a constraint to a new major version.
- After `composer update`, run `composer bump` so `composer.json` matches the installed versions.

## Releases

- Files that must not ship go in both `.distignore` (WordPress.org deploy) and the `zip -x` list in `.github/workflows/create-release.yml` (GitHub release zip).
- A version bump touches: the plugin header `Version` and `ACFW_VERSION` in `acquired-com-for-woocommerce.php`, `Stable tag` and the changelog in `readme.txt`, `package.json`, and `CHANGELOG.md`.

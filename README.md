# FilamentPHP v4 Starter

This is a starter kit for your next FilamentPHP v4 project.


## Added Features

1. Hot Reload Enabled by default.
2. Configured default labels using "Title Case".
3. Configured default validation attribute using lower case.
4. Configured default date display format from `config('app.date_format')`.
5. Configured default time display format from `config('app.time_format')`.
6. Configured default datetime display format from `config('app.datetime_format')`.
7. Users CRUD with reset password.
8. Enabled tailwind classes by adding admin theme.css (see [commit](https://github.com/ajcastro/filamentphpv4-starter/commit/3b50df74ec81ca9024cd767762213b46f3186632))
9. Simple Tenancy setup.


See also `App\Providers\AppServiceProvider`.

## Installation

1. Clone repository `git clone git@github.com:ajcastro/filamentphpv4-starter.git project_name`.
2. Run `composer install` and `npm install`.
3. Run `composer update` to update dependencies.
4. Duplicate `.env.example` and set `DB_DATABASE`.
5. Run `php artisan key:generate`.
6. Run `php artisan migrate --seed`.
7. Run `npm run build` for production or `npm run dev` for development.
8. Login to `http://project_name.test/login`. Check `Database\Seeders\DatabaseSeeder`for credentials.

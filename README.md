# Instructions to install.

### Composer
1. Make sure, you have composer installed.
2. Make sure, plugin `fxp/composer-asset-plugin` is installed for your composer.
3. Run the installation via `composer install`.

### VHost
Make sure the root folder points to the `web` sub-directory:
`DocumentRoot "/some/path/to/webroot/web"` and `<Directory "/some/path/to/webroot/web/">`

### ENV
Create `.env` file at the root folder and fill it like to `.env.example file`.
1. Env var `DB_USER`. Store there your MySQL username.
2. Env var `DB_PASS`. Store there your MySQL password.
3. Env var `DB_DSN`. Store there your MySQL DSN.

### Migrations
Run the Yii2 migrations like:
`yii migrate up`


### That's all
Should be working

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

# What is done by task given?
1. Installed WAPM server (Win7).
2. Installed and configured GIT.
3. Installed and configured composer.
4. Created empty Yii2 Basic via composer.
5. Implemented the CRUD functionalty for products, categories and product types using Yii2 models.
6. Implemented the functionality to add image to any product.
7. Implemented the functionality to download the image (from products list page).
8. Added primitive filter for products usin jQuery + select2.
9. Added widget to show random products with "Refresh" button using Ajax + Knockout.js + jQuery + Bootstrap CSS.

# Not done :-(
1. Thumbnails for images.
2. Good CSS-styling.
3. Footer.
4. Support of URL-manager at client-side.
5. A lot of other things.

# Server soft used to complete the task
1. MySQL Community Server 5.7.14.
2. Apache/2.4.23 (Win64) PHP/7.0.10.


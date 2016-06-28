<?php 
define('SLIM_DISPLAY_ERRORS', true);

define('APP_KEY', 'ANY_KEY_HERE_SECURITY');

// paths/folder
define('STORAGE_PATH', __DIR__.'/storage/');

// templates
define('TEMPLATE_URI', '/templates/default/');
define('TEMPLATE_PATH', __DIR__.TEMPLATE_URI);
define('TEMPLATE_CACHE_PATH', STORAGE_PATH.'/cache/templates');

// twig
define('TWIG_DEBUG', false);

// logs
define('LOG_PATH_FILE', __DIR__.'/storage/logs/app.log');

// database
define('DB_MIGRATIONS_PATH', __DIR__.'/database/migrations');
define('DB_SEEDS_PATH', __DIR__.'/database/seeds');

define('DATABASE_PATH_SQLITE', 'database/database.sqlite');

define('DB_AUTOLOAD', false);
define('DB_CONNECTION', 'sqlite');
define('DB_NAME', DATABASE_PATH_SQLITE);
define('DB_HOST', 'localhost');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_PORT', '');
define('DB_CHARSET', 'utf8');
define('DB_COLLATION', 'utf8_unicode_ci');
define('DB_PREFIX', '');

// PHPActiveRecords
define('PAR_MODEL_PATH', __DIR__.'/src/Models');
define('PAR_DEFAULT_CONN', 'default');
<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// Register flash messages
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// Register Twig View helper
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig(TEMPLATE_PATH, [
        'cache' => TEMPLATE_CACHE_PATH,
        'debug' => TWIG_DEBUG
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
    $view->addExtension(new App\TwigExtension($c['router'], $basePath));

    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// database
if (defined('DB_AUTOLOAD') && DB_AUTOLOAD === true) {
    
    $connections = array();

    if (DB_CONNECTION=='sqlite'){
        $connections['default'] = 'sqlite://'.DB_NAME;
    } else {
        $connections['default'] = sprintf('%s://%s:%s@%s/%s', DB_CONNECTION, DB_USER, DB_PASS, DB_HOST, DB_NAME);
    }

    $connections['production'] = $connections['default'];
    $connections['development'] = 'sqlite://'.DB_NAME;
    //dump($connections);

    $cfg = ActiveRecord\Config::instance();
    $cfg->set_model_directory(PAR_MODEL_PATH);
    $cfg->set_connections($connections);

    # default connection is now production
    $cfg->set_default_connection(PAR_DEFAULT_CONN);

}
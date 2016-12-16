<?php
/**
 * Application Settings
 */

$session_lifetime = 86400 * 1;

$config = [
    // Application name
    'name' => 'AzuraCore',

    // Subfolder for the application (if applicable)
    'base_uri' => '/',

    // Base of the static URL.
    'static_uri' => '/static/',

    'phpSettings' => [
        'display_startup_errors' => 0,
        'display_errors' => 0,
        'log_errors' => 1,
        'error_log' => APP_INCLUDE_TEMP . '/php_errors.log',
        'error_reporting' => E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT,
        'session' => [
            'use_only_cookies' => 1,
            'gc_maxlifetime' => $session_lifetime,
            'gc_probability' => 1,
            'gc_divisor' => 100,
            'cookie_lifetime' => $session_lifetime,
            'hash_function' => 'sha512',
            'hash_bits_per_character' => 4,
        ],
    ],

    'pluginpaths' => [
        'DF\Application\Resource\\' => 'DF/Application/Resource',
    ],

    'autoload' => [
        'psr0' => [
            'Entity' => APP_INCLUDE_MODELS,
        ],
        'psr4' => [
            '\\Proxy\\' => APP_INCLUDE_TEMP . '/proxies',
        ],
    ],

    /* RESOURCES: Doctrine ORM Layer */
    'doctrine' => [
        'autoGenerateProxies' => (APP_APPLICATION_ENV == "development"),
        'proxyNamespace' => 'Proxy',
        'proxyPath' => APP_INCLUDE_TEMP . '/proxies',
        'modelPath' => APP_INCLUDE_MODELS,
    ],
];

/**
 * Development mode changes.
 */

if (APP_APPLICATION_ENV != 'production')
{
    $config['phpSettings']['display_startup_errors'] = 1;
    $config['phpSettings']['display_errors'] = 1;

    // Update if your local configuration differs.
    $config['base_url'] = '//localhost:8080';

    unset($config['api_url']);
    unset($config['upload_url']);
}

return $config;

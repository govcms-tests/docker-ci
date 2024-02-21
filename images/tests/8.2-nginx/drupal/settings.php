<?php

// Database settings
if (getenv('MARIADB_HOST')) {
  $databases['default']['default'] = [
    'database' => getenv('MARIADB_DATABASE') ?: 'drupal',
    'username' => getenv('MARIADB_USER') ?: 'drupal',
    'password' => getenv('MARIADB_PASSWORD') ?: 'drupal',
    'host' => getenv('MARIADB_HOST') ?: 'mariadb',
    'port' => '3306',
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
  ];
} else {
  $databases['default']['default'] = array (
    'database' => 'sites/default/files/.ht.sqlite',
    'namespace' => 'Drupal\\sqlite\\Driver\\Database\\sqlite',
    'driver' => 'sqlite',
    'autoload' => 'core/modules/sqlite/src/Driver/Database/sqlite/',
  );
}

// Salt for one-time login links, cancel links, form tokens, etc.
$settings['hash_salt'] = hash('sha256', getenv('GOVCMS_VERSION'));

// Private file path
$settings['file_private_path'] = 'sites/default/files/private';

// Location of the site configuration files.
$settings['config_sync_directory'] = 'sites/default/files/sync';

// Trusted host configuration.
$settings['trusted_host_patterns'] = ['.*'];

// The directories that will be ignored by Drupal's file API.
$settings['file_scan_ignore_directories'] = [
    'node_modules',
    'bower_components',
];

// Load local development override configuration, if available.
if (file_exists($app_root . '/' . $site_path . '/local.settings.php')) {
    include $app_root . '/' . $site_path . '/local.settings.php';
}

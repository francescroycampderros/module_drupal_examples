In settings.php...:

$databases['default']['default'] = array (
  'database'  => 'drupal8-database-name',
  'username'  => 'drupal8-database-username',
  'password'  => 'drupal8-database-password',
  'host'      => 'drupal8-database-server',
  'port'      => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver'    => 'mysql',
);
$databases['migrate']['default'] = array (
  'database'  => 'source-database-name',
  'username'  => 'source-database-username',
  'password'  => 'source-database-password',
  'host'      => 'source-database-server',
  'port'      => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver'    => 'mysql',
);

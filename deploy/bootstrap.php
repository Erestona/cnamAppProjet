<?php
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;
	date_default_timezone_set('America/Lima');
	require_once "vendor/autoload.php";
	$isDevMode = true;
	$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);
	$conn = array(
	'host' => 'dpg-cm23hi7qd2ns73d8dusg-a.frankfurt-postgres.render.com',

	'driver' => 'pdo_pgsql',
	'user' => 'bddtpweb_user',
	'password' => 'F20ZRrsg2Fjp0vy6PWv1SgL7Hrz9dmWI',
	'dbname' => 'bddtpweb',
	'port' => '5432'
	);

	$entityManager = EntityManager::create($conn, $config);

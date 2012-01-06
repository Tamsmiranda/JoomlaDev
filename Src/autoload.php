<?php
	// Src/autoload.php
	define( 'DS', DIRECTORY_SEPARATOR );
	require_once __DIR__.'/../vendor/Symfony/Component/ClassLoader/UniversalClassLoader.php';

	$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
	$loader->registerNamespaces(array(
		'Symfony' => __DIR__.'/../Vendor',
		'PSS'     => __DIR__
	));
	$loader->register();
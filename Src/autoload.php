<?php
	// Src/autoload.php
	define( 'DS', DIRECTORY_SEPARATOR );
	require_once __DIR__.'..'.DS.'Vendor'.DS'Symfony'.DS.'Component'.DS.'ClassLoader'.DS.'UniversalClassLoader.php';

	$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
	$loader->registerNamespaces(array(
		'Symfony' => __DIR__.'/../Vendor',
		'PSS'     => __DIR__
	));
	$loader->register();
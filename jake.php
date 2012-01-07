<?php
	// console.php
	require_once __DIR__.'/Src/autoload.php';
	define('DS', DIRECTORY_SEPARATOR);

	use Symfony\Component\Console as Console;

	$application = new Console\Application('Jake', '0.0.1');
	$application->add(new PSS\Command\ReverseCommand('reverse'));
	$application->add(new PSS\Command\HelloWorldCommand('hello-world'));
	$application->run();
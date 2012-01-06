<?php
	// console.php
	require_once __DIR__.'/Src/autoload.php';

	use Symfony\Component\Console as Console;

	$application = new Console\Application('Jake', '0.0.1');
	$application->run();
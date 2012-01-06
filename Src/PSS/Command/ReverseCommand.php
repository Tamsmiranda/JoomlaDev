<?php
	// Src/Jake/Command/Reverse.php
	namespace PSS\Command;

	use Symfony\Component\Console as Console;

	class ReverseCommand extends Console\Command\Command
	{
		protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
		{
			$output->writeln('Hello World!');
		}
	}
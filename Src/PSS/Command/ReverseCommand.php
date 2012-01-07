<?php
	// Src/Jake/Command/Reverse.php
	namespace PSS\Command;

	use Symfony\Component\Console as Console;

	class ReverseCommand extends Console\Command\Command
	{
		public function __construct($name = null)
		{
			parent::__construct($name);

			//$this->setDescription('Outputs welcome message');
			//$this->setHelp('Outputs welcome message.');
			$this->addArgument('name', Console\Input\InputArgument::REQUIRED, 'Component, Module, Plugin or Template name');
			$this->addArgument('source', Console\Input\InputArgument::REQUIRED, 'Joomla path');
			$this->addOption('component', 'c', Console\Input\InputOption::VALUE_NONE, 'Component Mode');
			$this->addOption('module', 'm', Console\Input\InputOption::VALUE_NONE, 'Module Mode');
			$this->addOption('plugin', 'p', Console\Input\InputOption::VALUE_NONE, 'Plugin Mode');
			$this->addOption('template', 't', Console\Input\InputOption::VALUE_NONE, 'Template Mode');
			//$this->addOption('more', 'm', Console\Input\InputOption::VALUE_NONE, 'Tell me more');
		}
		
		protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
		{
			$name = $input->getArgument('name');
			$source = $input->getArgument('source');
			$output->writeln(sprintf('Hello %s!', $name));
			$this->copy_r($source, 'C:\Users\Miranda\Documents\Projetos\JoomlaDev\asdasd');
			$output->writeln('Hello World!');
		}
		
		function copy_r( $path, $dest )
		{
			if( is_dir($path) )
			{
				@mkdir( $dest );
				$objects = scandir($path);
				if( sizeof($objects) > 0 )
				{
					foreach( $objects as $file )
					{
						if( $file == "." || $file == ".." )
							continue;
						// go on
						if( is_dir( $path.DS.$file ) )
						{
							$this->copy_r( $path.DS.$file, $dest.DS.$file );
						}
						else
						{
							copy( $path.DS.$file, $dest.DS.$file );
						}
					}
				}
				return true;
			}
			elseif( is_file($path) )
			{
				return copy($path, $dest);
			}
			else
			{
				return false;
			}
		}
	}
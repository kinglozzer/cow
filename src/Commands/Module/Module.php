<?php

namespace SilverStripe\Cow\Commands\Module;

use SilverStripe\Cow\Commands\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Abstract base command for all module commands
 *
 * @author dmooyman
 */
abstract class Module extends Command {
	
	protected function configure() {
		parent::configure();
		$this->addArgument(
			'modules',
			InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
			'Optional list of modules to filter (separate by space)'
		);
		$this->addOption('directory', 'd', InputOption::VALUE_REQUIRED, 'Module directory');
	}

	/**
	 * Get the directory the project is, or will be in
	 *
	 * @return string
	 */
	protected function getInputDirectory() {
		$directory = $this->input->getOption('directory');
		if(!$directory) {
			$directory = getcwd();
		}
		return $directory;
	}

	/**
	 * Gets the list of module names to filter by (or empty if all modules)
	 *
	 * @return array
	 */
	protected function getInputModules() {
		return $this->input->getArgument('modules') ?: array();
	}
}

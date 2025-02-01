<?php

/**
 * @package     Joomla.Site
 * @subpackage  Module.Boilerplate
 *
 * @link        https://www.joomla.org
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;

return new class () implements ServiceProviderInterface {

	public function register(Container $container)
	{
		$container->registerServiceProvider(new ModuleDispatcherFactory('\\Joomla\\Module\\Boilerplate'));
		$container->registerServiceProvider(new HelperFactory('\\Joomla\\Module\\Boilerplate\\Site\\Helper'));

		$container->registerServiceProvider(new Module());
	}
};

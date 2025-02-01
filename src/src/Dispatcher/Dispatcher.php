<?php

/**
 * @package     Joomla.Site
 * @subpackage  Module.Boilerplate
 *
 * @link        https://www.joomla.org
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Module\Boilerplate\Site\Dispatcher;

use Joomla\Registry\Registry;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
	use HelperFactoryAwareTrait;

	protected function getLayoutData(): array
	{
		$params = new Registry($this->module->params);
		$data = parent::getLayoutData();

		/** @var \Joomla\Module\Boilerplate\Site\Helper\BoilerplateHelper $helper */
		$helper = $this->getHelperFactory()->getHelper('BoilerplateHelper');

		$data['msg'] = $helper->getMsg($data['params'], $this->getApplication());
		$data['items'] = $helper->getExampleItems($data['params'], $this->getApplication());

		return $data;
	}
}

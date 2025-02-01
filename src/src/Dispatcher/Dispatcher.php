<?php

/**
 * @package     Joomla.Site
 * @subpackage  Module.Boilerplate
 *
 * @link        https://www.joomla.org
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Module\Boilerplate\Site\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
	use HelperFactoryAwareTrait;

	protected function getLayoutData(): array
	{
		$data = parent::getLayoutData();

		$data['msg'] = $this->getHelperFactory()->getHelper('BoilerplateHelper')->getMsg($data['params'], $this->getApplication());
		$data['items'] = $this->getHelperFactory()->getHelper('BoilerplateHelper')->getExampleItems($data['params'], $this->getApplication());

		return $data;
	}
}

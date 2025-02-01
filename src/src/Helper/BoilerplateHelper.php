<?php

/**
 * @package     Joomla.Site
 * @subpackage  Module.Boilerplate
 *
 * @link        https://www.joomla.org
 * @license     GNU General Public License version 2 or later; see LICENSE
 */


namespace Joomla\Module\Boilerplate\Site\Helper;

use Joomla\Registry\Registry;
use Joomla\CMS\Application\CMSApplicationInterface;

class BoilerplateHelper
{
	public function getMsg(Registry $params, CMSApplicationInterface $app): string
	{
		$message = $params->get('msg', 'Hello World!');
		return $message;
	}

	public function getExampleItems(Registry $params, CMSApplicationInterface $app): array
	{
		$itemboxFormMap = (array) $params->get('itembox-form');
		return $itemboxFormMap;
	}
}

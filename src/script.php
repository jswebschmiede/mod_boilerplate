<?php

/**
 * @package     Joomla.Site
 * @subpackage  Module.Boilerplate
 *
 * @link        https://www.joomla.org
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Installer\InstallerAdapter;
use Joomla\CMS\Installer\InstallerScriptInterface;

return new class () implements InstallerScriptInterface {

	private string $minimumJoomla = '5.0.0';
	private string $minimumPhp = '8.0.0';

	public function install(InstallerAdapter $adapter): bool
	{
		echo "mod_boilerplate install<br>";
		return true;
	}

	public function update(InstallerAdapter $adapter): bool
	{

		echo "mod_boilerplate update<br>";
		return true;
	}

	public function uninstall(InstallerAdapter $adapter): bool
	{
		echo "mod_boilerplate uninstall<br>";
		return true;
	}

	public function preflight(string $type, InstallerAdapter $adapter): bool
	{
		echo "mod_boilerplate preflight<br>";

		if (version_compare(PHP_VERSION, $this->minimumPhp, '<')) {
			Factory::getApplication()->enqueueMessage(sprintf(Text::_('JLIB_INSTALLER_MINIMUM_PHP'), $this->minimumPhp), 'error');
			return false;
		}

		if (version_compare(JVERSION, $this->minimumJoomla, '<')) {
			Factory::getApplication()->enqueueMessage(sprintf(Text::_('JLIB_INSTALLER_MINIMUM_JOOMLA'), $this->minimumJoomla), 'error');
			return false;
		}

		return true;
	}

	public function postflight(string $type, InstallerAdapter $adapter): bool
	{
		echo "mod_boilerplate postflight<br>";
		return true;
	}
};
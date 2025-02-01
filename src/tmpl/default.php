<?php

/**
 * @package     Joomla.Site
 * @subpackage  Module.Boilerplate
 *
 * @link        https://www.joomla.org
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

$modId = 'mod-boilerplate' . $module->id;

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('mod_boilerplate');
$wa->useScript('module.boilerplate.site');
$wa->useStyle('module.boilerplate.site');
?>

<div id="<?php echo $modId; ?>" class="mod-boilerplate boilerplate">
	<?php echo $msg; ?>

	<?php if (!empty($items)): ?>
		<div>
			<?php foreach ($items as $item): ?>
				<figure>
					<?php echo HTMLHelper::image($item->itemboxImage, $item->itemboxTitle, ['class' => 'image']) ?>
				</figure>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
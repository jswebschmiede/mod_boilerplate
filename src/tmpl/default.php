<?php

/**
 * @package     Joomla.Site
 * @subpackage  Module.Example
 *
 * @link        https://www.joomla.org
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

$modId = 'mod-example' . $module->id;
?>


<div id="<?php echo $modId; ?>" class="mod-example example">
	<?php echo $msg; ?>

	<?php if (!empty($items)) : ?>
		<div>
			<?php foreach ($items as $item) : ?>
				<figure>
					<?php echo HTMLHelper::image($item->itemboxImage, $item->itemboxTitle, ['class' => 'image']) ?>
				</figure>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div>
		<?php echo HTMLHelper::link('/', 'title'); ?>
	</div>
</div>
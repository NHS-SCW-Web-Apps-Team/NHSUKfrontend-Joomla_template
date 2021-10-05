<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure', 0)); ?>" method="post" id="login-form" class="form-inline justify-content-end nhsuk-width-container">
	<div class="input-group input-group-sm">
		<?php if ($params->get('greeting', 1)) : ?>
			
			<div class="login-greeting input-group-prepend"><div class="input-group-text">
			<?php if (!$params->get('name', 0)) : ?>
				<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name'), ENT_COMPAT, 'UTF-8')); ?>
			<?php else : ?>
				<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username'), ENT_COMPAT, 'UTF-8')); ?>
			<?php endif; ?>
			</div></div>
			<div class="input-group-append">
		<?php else: ?>
			<div class="input-group">
		<?php endif; ?>

	<!--	<div class="input-group-append"> -->
			<?php if ($params->get('profilelink', 0)) : ?>
				<a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>" role="button" class="btn btn-sm btn-primary" >
				<span class="fa fa-user-circle-o"></span> <?php echo JText::_('MOD_LOGIN_PROFILE'); ?></a>
			<?php endif; ?>

			<button type="submit" name="Submit" class="btn btn-sm btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" ><span class="fa fa-sign-out-alt"></span><?php echo JText::_('JLOGOUT'); ?></button>
		
		</div>	
	</div>	
	<div class="d-none">
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

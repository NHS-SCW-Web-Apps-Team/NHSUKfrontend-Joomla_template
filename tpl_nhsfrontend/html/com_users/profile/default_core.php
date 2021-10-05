<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="nhsuk-form-group" style="clear:both;">
        <label class="nhsuk-label nhsuk-label--m" for="name"><?php echo JText::_('COM_USERS_PROFILE_NAME_LABEL'); ?></label>
        <p><?php echo $this->escape($this->data->name); ?></p>
      </div>

<div class="nhsuk-form-group"  style="clear:both;">
        <label class="nhsuk-label nhsuk-label--m" for="username"><?php echo JText::_('COM_USERS_PROFILE_USERNAME_LABEL'); ?>
</label>
        <p><?php echo $this->escape($this->data->username); ?></p>
      </div>

<div class="nhsuk-form-group" style="clear:both;">
        <label class="nhsuk-label nhsuk-label--m" for="registeredDate"><?php echo JText::_('COM_USERS_PROFILE_REGISTERED_DATE_LABEL'); ?></label>
        <p><?php echo JHtml::_('date', $this->data->registerDate, JText::_('DATE_FORMAT_LC1')); ?></p>
      </div>

<div class="nhsuk-form-group" style="clear:both;">
        <label class="nhsuk-label nhsuk-label--m" for="lastVisitedDate"><?php echo JText::_('COM_USERS_PROFILE_LAST_VISITED_DATE_LABEL'); ?></label>
        <?php if ($this->data->lastvisitDate != $this->db->getNullDate()) : ?>
			<p>
				<?php echo JHtml::_('date', $this->data->lastvisitDate, JText::_('DATE_FORMAT_LC1')); ?>
			</p>
		<?php else : ?>
			<p>
				<?php echo JText::_('COM_USERS_PROFILE_NEVER_VISITED'); ?>
			</p>
		<?php endif; ?>

      </div>



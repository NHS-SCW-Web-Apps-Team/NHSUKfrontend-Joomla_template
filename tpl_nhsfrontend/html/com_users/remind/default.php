<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

	$doc = JFactory::getDocument();
	$style = '.nhsuk-label.star {display:none}';
	$style .= '.control-label > .nhsuk-label {font-weight:bold}'; 
	$doc->addStyleDeclaration($style);
	
?>
<div class="remind<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<form id="user-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=remind.remind'); ?>" method="post" class="form-validate form-horizontal well nhsuk-grid-column-two-thirds nhsuk-u-padding-left-0">
		<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<fieldset class="nhsuk-fieldset">
				<?php if (isset($fieldset->label)) : ?>
					<p><?php echo JText::_($fieldset->label); ?></p>
				<?php endif; ?>
				<?php echo $this->form->renderFieldset($fieldset->name); ?>
			</fieldset>
		<?php endforeach; ?>
		<div class="control-group">
			<div class="controls">
				<!--<button type="submit" class="btn btn-primary validate">-->
          		<button type="submit" class="nhsuk-button">
					<?php echo JText::_('JSUBMIT'); ?>
				</button>
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>

<script>
              
  jQuery("#jform_email-lbl").removeClass("hasPopover")
  //jQuery("span.star").removeClass("nhsuk-label")        
</script>

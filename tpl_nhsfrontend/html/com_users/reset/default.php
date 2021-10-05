<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\Factory;


JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');

//$cookieacceptedcookievalue = Factory::getApplication()->input->cookie->get('plg_system_eprivacy',null);
$cookieacceptedcookievalue = Factory::getApplication()->input->cookie->get('allow_nonessential_cookies',null);

	$doc = JFactory::getDocument();
	$style = '.nhsuk-label.star {display:none}';
	$style .= '.control-label > .nhsuk-label {font-weight:bold}'; 
	$doc->addStyleDeclaration($style);
	
?>

 <?php   if($cookieacceptedcookievalue!="yes"):   ?>
 <div class="nhsuk-warning-callout">  <h3 class="nhsuk-warning-callout__label">
    <span role="text">
      <span class="nhsuk-u-visually-hidden">Warning: </span>
      Warning
    </span>
  </h3>
  <p>To be able to reset your password you will need to accept cookies</p>
</div>
 <?php   endif;   ?>
   
   
<div class="reset<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<form id="user-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=reset.request'); ?>" method="post" class="form-validate form-horizontal well nhsuk-grid-column-two-thirds nhsuk-u-padding-left-0" >
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
				<button type="submit" class="btn btn-primary nhsuk-button nhsuk-u-margin-top-4 validate">
					<?php echo JText::_('JSUBMIT'); ?>
				</button>
			</div>
		</div>
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
          
<script>
              
  jQuery("#jform_email-lbl").removeClass("hasPopover")
  // jQuery("span.star").removeClass("nhsuk-label")        
</script>

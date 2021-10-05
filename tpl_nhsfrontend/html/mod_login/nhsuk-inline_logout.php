<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;
JHtml::_('behavior.keepalive');

 if (!$params->get('name', 0)) : 
			   $hiname= TEXT::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name'), ENT_COMPAT, 'UTF-8')); 
			 else : 
				 $hiname= TEXT::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username'), ENT_COMPAT, 'UTF-8'));
	endif; 

?>
<div class="nhsuk-width-container" >
  <div class="nhsuk-grid-row">
    <div class="nhsuk-grid-column-one-half">
      <div class="nhsuk-back-link nhsuk-u-margin-top-4 nhsuk-u-margin-bottom-0">
    <a class="nhsuk-back-link__link" href="#" onclick="history.back();">
    <svg class="nhsuk-icon nhsuk-icon__chevron-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M8.5 12c0-.3.1-.5.3-.7l5-5c.4-.4 1-.4 1.4 0s.4 1 0 1.4L10.9 12l4.3 4.3c.4.4.4 1 0 1.4s-1 .4-1.4 0l-5-5c-.2-.2-.3-.4-.3-.7z"></path>
    </svg>
    Go back</a>
  </div>
  
    </div>
    <div class="nhsuk-grid-column-one-half">
      <div class="nhsuk-login-link nhsuk-u-margin-top-4 nhsuk-u-margin-bottom-0">
        <form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure', 0)); ?>" method="post" id="login-form" class="form-inline justify-content-end nhsuk-width-container">

        Hi&nbsp;<a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>"> <?php echo $hiname ; ?> </a>&nbsp; | 
        
        &nbsp;<button class="nhsuk-link" href="#">Sign out</button>
        <div class="d-none">
      		<input type="hidden" name="option" value="com_users" />
      		<input type="hidden" name="task" value="user.logout" />
      		<input type="hidden" name="return" value="<?php echo $return; ?>" />
      		<?php echo JHtml::_('form.token'); ?>
      	</div>
        
        </form>
      </div>
    </div>
  </div>
</div>
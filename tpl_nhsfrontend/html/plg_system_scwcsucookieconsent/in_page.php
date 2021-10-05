<?php
/**
 * @package SP Cookie Consent
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('_JEXEC') or die();

$mainframe =JFactory::getApplication();
$cookie = $this->app->input->cookie;
if($cookie->get('decision_made') != 'yes'){
    $showoptions = "block";
    $showChangeButton = "none";
}else{
    $showoptions = "none";
    $showChangeButton = "block";
}

?>

<div class="plg_spcookieconsent">
    <div class="plg_spcookieconsent_change" style="display:flex;">
        <button class="nhsuk-button plg_spcookieconsent_agreed" style="margin-right:5px; display:<?php echo $showoptions;?>" id="in_page_accept_non_essential" href="#" tabindex="2">I'm OK with analytics cookies</button>
        <button class="nhsuk-button plg_spcookieconsent_declined" style="display:<?php echo $showoptions;?>" id="in_page_decline_non_essential" href="#" tabindex="3">Do not use analytics cookies</button>
        <button class="nhsuk-button plg_system_eprivacy_reconsider" style="display:<?php echo $showChangeButton;?>">Change cookie settings</button>
    </div>
</div>
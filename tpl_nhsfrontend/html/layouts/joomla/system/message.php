<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$msgList = $displayData['msgList'];
//print_r($msgList);

 $errormsgs=array();
 $warningmsgs=array();
 $successmsgs=array();
 $defaultmsgs=array();
 foreach ($msgList as $type => $msgs) : 
 	//print_r($type);
 	// use this to create different lists for Warnings vs Errors
	// e.g. if $type==info/notice/warning/error etc 

	switch($type){
		case 'notice':
		case 'warning':
		case 'error':
			$errormsgs[]=$msgs ;
		break;
		case 'nhsuk-warning-callout':
			$warningcalloutmsgs[]=$msgs;
		break;
		default:
			$defaultmsgs=$msgs ;	
			/*
			if (!empty($msgs)) :
				foreach ($msgs as $msg) :
					//echo "<div class=\"nhsuk-u-padding-3 nhsuk-u-margin-2 nhsuk-u-font-weight-bold \"style=\"background-color:#00703c; color:#ffffff;\" >".$msg."</div>" ;
					echo "<div class=\"nhsuk-inset-text\"><span class=\"nhsuk-u-visually-hidden\">Information: </span>";
					echo "<p>".$msg."</p></div>";
				 endforeach; 
			endif;
			*/
		}
	
 endforeach;

?>
<div id="system-message-container">
	
<!-- Messages start -->	
	<?php 
		if (is_array($defaultmsgs) && !empty($defaultmsgs)) :
			foreach ($defaultmsgs as $msg) :
			//print_r($msg);
						//echo "<div class=\"nhsuk-u-padding-3 nhsuk-u-margin-2 nhsuk-u-font-weight-bold \"style=\"background-color:#00703c; color:#ffffff;\" >".$msg."</div>" ;
						echo "<div class=\"nhsuk-inset-text\"><span class=\"nhsuk-u-visually-hidden\">Information: </span>";
						echo "<p>".$msg."</p></div>";
			endforeach;
		endif ; 
		?> 
	
<!-- Messages end -->	

<!-- Errors Messages Start -->	
	<? if (is_array($errormsgs) && !empty($errormsgs)) : ?>
		<div class="nhsuk-error-summary" aria-labelledby="error-summary-title" role="alert" tabindex="-1">
		  <h2 class="nhsuk-error-summary__title" id="error-summary-title">
		    There is a problem
		  </h2>
		  <div class="nhsuk-error-summary__body">
		   
		    <ul class="nhsuk-list nhsuk-error-summary__list">
			<?php foreach ($errormsgs as $msgs) : ?>	
				<?php if (!empty($msgs)) : ?>
				<?php foreach ($msgs as $msg) : ?>
			      <li><?php echo $msg; ?></li>
				  <?php endforeach; ?>
				<?php endif; ?>
			  <?php endforeach; ?>
		    </ul>
		  </div>
		</div>
	<?php endif; ?>
<!-- Error Messages end-->

<!-- Warnings Start -->
	<? if (isset($warningcalloutmsgs) && is_array($warningcalloutmsgs) && !empty($warningcalloutmsgs)) : ?>
		<div class="nhsuk-warning-callout">
	  <h3 class="nhsuk-warning-callout__label">
	    <span role="text">
	      <span class="nhsuk-u-visually-hidden">Important: </span>
	      Important
	    </span>
	  </h3>
	  <?php foreach ($warningcalloutmsgs as $type => $msgs) : ?>	
			<?php if (!empty($msgs)) : ?>
			<?php foreach ($msgs as $msg) : ?>
		      <p><?php echo $msg; ?></p>
			  <?php endforeach; ?>
			<?php endif; ?>
		  <?php endforeach; ?>
	</div>
	<?php endif; ?>
	
<!-- Warnings End -->

</div>
<?php
/**
 * @version    SVN: <svn_id>
 * @package    Com_Tjlms
 * @copyright  Copyright (C) 2005 - 2014. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * Shika is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access.
defined('_JEXEC') or die;
?>

<div class="recommendThisCourse">

	<?php
		$dispatcher = JDispatcher::getInstance();
		JPluginHelper::importPlugin('content');
		$result =$dispatcher->trigger('recommendCourse',array('com_tjlms.course',$this->course_id,$this->course_info->title));
		if(!empty($result))
		echo $result[0];
	?>
</div>

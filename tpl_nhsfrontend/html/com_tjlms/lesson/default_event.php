<?php
/**
 * @package    LMS_Shika
 * @copyright  Copyright (C) 2009 -2010 Techjoomla, Tekdi Web Solutions . All rights reserved.
 * @license    GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link       http://www.techjoomla.com
 */
// No direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.pane');

$config = array();
$config['lesson_typedata'] = $this->lesson_typedata;

$lessonId = $this->lesson_id;

// Trigger all sub format  video plugins method that renders the video player
$dispatcher = JDispatcher::getInstance();
JPluginHelper::importPlugin('tjevent',  $this->pluginToTrigger);
$result = $dispatcher->trigger($this->pluginToTrigger . 'renderPluginHTML', array($config, $lessonId));

echo $result[0];

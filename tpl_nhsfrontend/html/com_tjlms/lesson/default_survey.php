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
$config['lesson_data'] = $this->lesson_data;
$config['lesson_typedata'] = $this->lesson_typedata;

// Trigger all sub format  video plugins method that renders the video player
$dispatcher = JDispatcher::getInstance();
JPluginHelper::importPlugin('tjsurvey',  $this->pluginToTrigger);
$result = $dispatcher->trigger('renderPluginHTML', array($config));

echo $result[0];

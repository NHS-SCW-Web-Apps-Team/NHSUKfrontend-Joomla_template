<?php
/**
 * @package Tjlms
 * @copyright Copyright (C) 2009 -2010 Techjoomla, Tekdi Web Solutions . All rights reserved.
 * @license GNU GPLv2 <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @link     http://www.techjoomla.com
 */
defined('_JEXEC') or die('Restricted access');
include_once JPATH_ROOT.DS.'administrator/components/com_tjlms/js_defines.php';

$lang = JFactory::getLanguage();
$lang->load('com_tmt', JPATH_SITE);

$doc = JFactory::getDocument();
$doc->addStyleSheet( JUri::root(true) . '/components/com_tmt/assets/css/tmt.css');

$ol_user=JFactory::getUser();

// Get Quiz resume Yes no
$TjlmsCoursesHelper = new TjlmsCoursesHelper;
$quizResumeAllowd = $TjlmsCoursesHelper->getQuizResumeAllowd($this->lesson_id);

$attempt = $this->attempt;

// If Quiz resume is no
/*if ($quizResumeAllowd == 0)
{
	if ($this->allowedAttepmts > 0)
	{
		if ($this->attemptsdonebyuser < $this->allowedAttepmts)
		{
			$attempt = $this->attemptsdonebyuser + 1;
		}
		else
		{
			$attempt = -1;
		}
	}
	else
	{
		$attempt = $this->attemptsdonebyuser + 1;
	}
}*/

$params = JComponentHelper::getParams('com_tjlms');
$this->quiz_articleId = $params->get('quiz_articleId', '0', 'INT');
$this->item =  new stdClass;
$this->item = $this->lesson_typedata->quiz;
$this->item->total_marks = $this->lesson->total_marks;
$this->item->passing_marks = $this->lesson->passing_marks;
$this->item->resume = $this->lesson->resume;
$this->item->lesson_id = $this->lesson->id;
$this->item->attemptData = $this->lastattempttracking_data;
$this->item->courseId = $this->course_id;
?>

<div class="<?php echo COM_TJLMS_WRAPPER_DIV; ?>">
	<div id="contentarea" class="container-fluid">
<?php
		$tjlmshelperObj	=	new comtjlmsHelper();
		$fileFormat = $tjlmshelperObj->getViewpath('com_tmt','testpremise','default','SITE','SITE');
		ob_start();
		include($fileFormat);
		$html = ob_get_contents();
		ob_end_clean();
		echo $html;
?>
	</div>
</div>



